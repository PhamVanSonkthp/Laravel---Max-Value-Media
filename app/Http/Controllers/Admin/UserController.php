<?php

namespace App\Http\Controllers\Admin;

use App\Components\Balance;
use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Role;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\UserType;
use App\Models\Website;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class UserController extends Controller
{
    use BaseControllerTrait;

    public function __construct(User $model, Role $role)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = true;
        $this->isMultipleImages = false;
        $this->shareBaseModel($model);
        $this->role = $role;
        $userTypes = UserType::all();
        $userStatuses = UserStatus::all();
        View::share('userTypes', $userTypes);
        View::share('userStatuses', $userStatuses);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request, ['is_admin' => 0], null,null,true);
        if ($request->is_verify == 1){
            $items = $items->whereNotNull('email_verified_at');
        }
        if ($request->is_verify == 2){
            $items = $items->whereNull('email_verified_at');
        }
        if ($request->is_balance == 1){
            $items = $items->where('amount', ">", 0);
        }
        if ($request->website_id){
            $items = $items->select('users.*')->join('websites', 'websites.user_id', '=', 'users.id')
                ->where('websites.id', $request->website_id);
        }
        if ($request->status_website_id){
            if (empty($request->website_id)){
                $items = $items->select('users.*')->join('websites', 'websites.user_id', '=', 'users.id')
                    ->where('websites.id', $request->website_id);
            }
            $items = $items->where('status_website_id',$request->status_website_id);
        }

        $items = $items->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        $managers = (new User())->where(['is_admin' => 1])->get();
        $users = (new User())->where('is_admin', 0)->get();
        $websites = (new Website())->get();
        $userStatus = (new UserStatus())->get();
        $statusWebsite = (new StatusWebsite())->get();
        $isBalances = [new Balance(1,"Yes")];
        $isVerifies = [new Balance(1,"Yes"), new Balance(2,"No")];

        return view('administrator.' . $this->prefixView . '.index', compact('items','managers','users','websites','userStatus','statusWebsite','isBalances','isVerifies'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('administrator.' . $this->prefixView . '.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
        ]);
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.' . $this->prefixView . '.index');
    }

    public function edit($id)
    {
        $item = $this->model->findById($id);
        return view('administrator.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|unique:users,phone,'.$id,
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.index');
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
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\User'], null, null, true);

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
