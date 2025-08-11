<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Models\Demand;
use App\Models\Formatter;
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
        $sumary = $this->model->searchByQuery($request, [], null, null, true);
        $sumary->selectRaw('SUM(d_request) as d_request, SUM(d_impression) as d_impression, AVG(d_ecpm) as d_ecpm, SUM(d_revenue) as d_revenue, AVG(count) as count, AVG(share) as share, SUM(p_impression) as p_impression, AVG(p_ecpm) as p_ecpm, SUM(p_revenue) as p_revenue, SUM(profit) as profit, SUM(sale_percent) as sale_percent, SUM(system_percent) as system_percent, SUM(salary) as salary, SUM(deduction) as deduction, SUM(net_profit) as net_profit');
        $sumary = $sumary->first();

        $items = $this->model->searchByQuery($request, [], null, null, true);

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
                $zones = $zones->whereDate('demand_id', $request->demand_id);
            }

            $zones = $zones->get();
        }

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'sumary', 'zones', 'demands'));
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
        return Excel::download(new ReportExport($this->model, $request), $this->prefixView . "_" . Carbon::today()->toDateString() . '.xlsx');
    }

    public function import(Request $request)
    {
        set_time_limit(36000);

        $path = storage_path() . '/app/' . request()->file('import_file')->store('tmp');

        if (empty($path)) {
            return back();
        }


        $reader = ReaderEntityFactory::createReaderFromFile($path);

        $reader->open($path);


        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $index => $row) {
                // do stuff with the row

                if ($index < 2) {
                    continue;
                }
                $cells = $row->getCells();


                $id = trim($cells[0]->getValue());

                $count = trim($cells[11]->getValue());
                $share = trim($cells[12]->getValue());

                $report = Report::find($id);
                if ($report) {
                    $report->count = $count;
                    $report->share = $share;
                    $report->save();
                    $report->touch();
                }
            }
        }

        return response()->json('ok');
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
