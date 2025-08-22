<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Report;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            if (optional(auth()->user())->is_admin == 1) {
                return redirect()->route('administrator.dashboard.index');
            }
        }

        $revenueNow = Report::where(['user_id' => auth()->id(), 'date' => Carbon::today()->toDateString()])->sum('p_revenue');
        $revenueYesterday = Report::where(['user_id' => auth()->id(), 'date' => Carbon::yesterday()->toDateString()])->sum('p_revenue');

        $revenueThisMonth = Report::where(['user_id' => auth()->id()])
            ->whereDate('date', '>=', Carbon::today()->startOfMonth()->toDateString())
            ->whereDate('date', '<=', Carbon::today()->endOfMonth()->toDateString())
            ->sum('p_revenue');

        $revenueTotal = Report::where(['user_id' => auth()->id()])->sum('p_revenue');
        return view('user.home.index', compact('revenueNow','revenueYesterday','revenueThisMonth','revenueTotal'));
    }

    public function website(Request $request)
    {
        $websiteModel = new Website();
        $items = $websiteModel->searchByQuery($request, ['user_id' => auth()->id()]);

        return view('user.website.index', compact('items'));

    }

    public function report(Request $request)
    {
        $model = new Report();
        $items = $model->searchByQuery($request);

        $websites = (new Website())->searchByQuery(null, ['user_id' => auth()->id()]);
        $zoneWebsites = (new ZoneWebsite())->searchByQuery(null, ['user_id' => auth()->id()]);

        return view('user.report.index', compact('items','zoneWebsites','websites'));

    }

    public function exportReport(Request $request)
    {
        return Excel::download(new ModelExport(new Report(), $request, ['user_id' => auth()->id()]), 'reports_' . Carbon::now()->toDateTimeString() . '.xlsx');

    }

}
