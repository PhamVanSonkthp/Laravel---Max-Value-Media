<?php

namespace App\Http\Controllers\Admin;

use App\Models\StatusWebsite;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\ZoneStatus;
use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Helper;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use function redirect;
use function view;

class WebsiteController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Website $model)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = false;
        $this->isMultipleImages = true;
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request);
        $statusWebsites = StatusWebsite::all();
        $zoneStatuses = ZoneStatus::all();
        return view('administrator.' . $this->prefixView . '.index', compact('items', 'statusWebsites','zoneStatuses'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(Request $request)
    {
        return view('administrator.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $item = $this->model->storeByQuery($request);
        return redirect()->route('administrator.' . $this->prefixView . '.index');
    }

    public function edit(Request $request, $id)
    {
        $item = $this->model->find($id);
        return view('administrator.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
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
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\Website'], null, null, true);

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
