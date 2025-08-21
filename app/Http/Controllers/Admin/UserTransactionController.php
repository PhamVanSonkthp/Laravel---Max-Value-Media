<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Models\UserTransaction;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class UserTransactionController extends Controller
{
    use BaseControllerTrait;

    public function __construct(UserTransaction $model)
    {
        $this->initBaseModel($model);
        $this->title = "Giao dịch khách";
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $query = $this->model->searchByQuery($request, [], null, null, true);


        $query = $query->select('user_transactions.*');

        if (isset($request->type_money) && $request->type_money == 2) {
            $query = $query->where('amount', '>=', 0);
        }

        if (isset($request->type_money) && $request->type_money == 3) {
            $query = $query->where('amount', '<', 0);
        }

        $items = $query->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());
        $total = 0;
        $deposit = 0;
        $deduction = 0;
        foreach ($items as $item) {
            $total = $total + $item->amount;
            if ($item->amount > 0) {
                $deposit = $deposit + $item->amount;
            }
            if ($item->amount < 0) {
                $deduction = $deduction + $item->amount;
            }
        }
        return view('administrator.' . $this->prefixView . '.index', compact('items',  'total', 'deposit', 'deduction'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create()
    {
        return view('administrator.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('administrator.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.edit', ['id' => $id]);
    }

    public function delete(Request $request, $id)
    {
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }

    public function restore(Request $request, $id)
    {
        $this->model->withTrashed()->findOrFail($id)->restore();
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function audit(Request $request, $id)
    {
        $auditModel = new Audit();
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\UserTransaction'], null, null, true);

        $items = $items->latest()->get();
        $content = [
            'message' => 'success',
            'code' => 200,
            'html' => View::make('administrator.components.modal_audit', compact('items'))->render(),
        ];

        return response()->json($content);
    }

    public function sort(Request $request)
    {

        Helper::sortTwoModel($this->model, $request->old_id, $request->new_id);

        return response()->json([
            'message' => 'sorted'
        ]);
    }
}
