<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\QueueGAMCreateAdUnit;
use App\Models\AdScoreZone;
use App\Models\Formatter;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Helper;
use App\Traits\BaseControllerTrait;
use App\Exports\ModelExport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use function redirect;
use function view;

class WebsiteController extends Controller
{
    use BaseControllerTrait, UserTrait;

    public function __construct(Website $model)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = false;
        $this->isMultipleImages = true;
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {

        $items = $this->model->searchByQuery($request, [], null, null, true);

        if ($request->zone_website_id) {
            $items = $this->websiteJoinZone($items, $request->zone_website_id);
        }

        if ($request->zone_status_id) {
            if (empty($request->zone_website_id)) {
                $items = $this->websiteJoinZone($items, $request->zone_website_id, false);
            }
            $items = $items->where('zone_websites.zone_status_id', $request->zone_status_id);
        }

        if ($request->manager_id) {
            $items = $items->select('websites.*')->join('users', 'users.id', '=', 'websites.user_id')->where('users.manager_id', $request->manager_id);
        }

        $items = $items->with(['zoneWebsites','zoneWebsites.zoneStatus','statusWebsite','user','adsStatusWebsite', 'user.manager','cs']);
        $items = $items->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        $statusWebsites = StatusWebsite::all();
        $zoneStatuses = ZoneStatus::all();

        $managers = $this->managers();
        $cses = $this->cses();

        return view('administrator.' . $this->prefixView . '.index', compact('items', 'statusWebsites', 'zoneStatuses', 'managers','cses'));
    }

    private function websiteJoinZone($query, $zone_website_id, $is_where = true)
    {
        $query = $query->select('websites.*')
            ->join('zone_websites', 'zone_websites.website_id', '=', 'websites.id');
        if ($is_where) {
            $query = $query->where('zone_websites.id', $zone_website_id);
        }
        return $query;
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
