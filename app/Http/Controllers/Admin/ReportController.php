<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Jobs\QueueCreateReport;
use App\Jobs\QueueImportReport;
use App\Models\Demand;
use App\Models\ExportReport;
use App\Models\Formatter;
use App\Models\ImportReport;
use App\Models\Permission;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\Website;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Helper;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use function redirect;
use function view;

class ReportController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Report $model)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = false;
        $this->isMultipleImages = true;
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $modelSummary = new Report();
        $sumary = $modelSummary->searchByQuery($request, ['report_type_id' => 1], null, null, true);

        $sumary->selectRaw('SUM(d_request) as d_request, SUM(d_impression) as d_impression, SUM(d_impression_us_uk) as d_impression_us_uk, AVG(d_ecpm) as d_ecpm, SUM(d_revenue) as d_revenue, AVG(count) as count, AVG(share) as share, SUM(p_impression) as p_impression, AVG(p_ecpm) as p_ecpm, SUM(p_revenue) as p_revenue, SUM(profit) as profit, SUM(sale_percent) as sale_percent, SUM(system_percent) as system_percent, SUM(salary) as salary, SUM(deduction) as deduction, SUM(net_profit) as net_profit');
        $sumary = $sumary->first();

        $modelAdserverSummary = new Report();
        $adServerSumary = $modelAdserverSummary->searchByQuery($request, ['report_type_id' => 2], null, null, true);
        $adServerSumary->selectRaw('SUM(d_request) as d_request');
        $adServerSumary = $adServerSumary->first();

        $sumary->d_request = 0;
        $sumary->d_request += $adServerSumary->d_request;

        $items = $this->model->searchByQuery($request, ['report_type_id' => 1], null, null, true);

        $items = $items->orderBy('date', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        $demands = (new Demand())->get();

        $zones = [];

        if ($request->website_id) {
            $zones = $this->model->where('website_id', $request->website_id);

            if ($request->from) {
                $zones = $zones->whereDate('date', '>=', $request->from);
            }
            if ($request->to) {
                $zones = $zones->whereDate('date', '<=', $request->to);
            }
            if ($request->demand_id) {
                $zones = $zones->where('demand_id', $request->demand_id);
            }

            $zones = $zones->get();
        }

        $modelColums = [];

        $tempModelColums = Helper::getAllColumsOfTable($this->model);

        foreach ($tempModelColums as $modelColum) {

            $CheckKeyCodes = [];

            // get permission report from database
            $permissionReports = Permission::where('parent_id', 61)->get();
            foreach ($permissionReports as $permissionReport) {
                $keyCode = str_replace("reports_list_", "", $permissionReport->key_code);

                $CheckKeyCodes[] = [
                    'key_code' => $permissionReport->key_code,
                    'column' => $keyCode,
                ];
            }

            $keyExist = collect($CheckKeyCodes)->firstWhere('column', $modelColum);


            if ($keyExist && auth()->user()->can("reports-list-" . $keyExist['column'])) {
                $modelColums[] = $keyExist['column'];
            }

        }

        $showColums = [];


        if ($request->show_colums) {
            $showColums = explode(',', $request->show_colums);
        }


        $modelColums = Helper::getAllColumsOfTable($this->model);

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'sumary', 'zones', 'demands', 'modelColums', 'showColums'));
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
        $filePath = $this->prefixView . "_" . Carbon::now()->toDateString() . "_" . Carbon::now()->timestamp . ".xlsx";

        $exportReport = ExportReport::create([
            'name' => "Report " . Carbon::now()->toDateTimeString() . ".xlsx",
            'path' => '/app/' . $filePath,
        ]);

        $request->merge([
            'report_type_id' => 1
        ]);;

        QueueCreateReport::dispatch($filePath, $request->all(), $exportReport);

        return response()->json([
            'message' => 'Export started! You will find the file at: storage/app/' . $filePath
        ]);
    }

    public function downloadExport(Request $request)
    {
        $exportReport = ExportReport::findOrFail($request->id);
        $filePath = storage_path($exportReport->path);

        return response()->download($filePath, $exportReport->name);
    }

    public function import(Request $request)
    {
        $file = request()->file('import_file');

        $path = storage_path() . '/app/' . $file->store('tmp');

        $importReport = ImportReport::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        QueueImportReport::dispatch($path, $importReport);

        return response()->json([
            'message' => 'Import started!'
        ]);
    }

    public function audit(Request $request, $id)
    {
        $auditModel = new Audit();
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\Report'], null, null, true);

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
