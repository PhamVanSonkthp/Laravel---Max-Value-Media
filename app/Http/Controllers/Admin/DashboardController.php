<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedWebsiteMail;
use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneWebsite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use function auth;
use function view;

class DashboardController extends Controller
{
    public function index( Request $request)
    {
        if (auth()->check()) {

            $totalUser = User::where('is_admin', 0)->whereNotNull('email_verified_at')->count();
            $totalWebsite = Website::count();
            $totalZone = ZoneWebsite::count();
            $totalZonePending = ZoneWebsite::where('zone_status_id', 1)->count();

            $modelSummary = new Report();
            $sumary = $modelSummary->searchByQuery($request, ['report_type_id' => 1,'from' => Carbon::today()->toDateString(),'to' => Carbon::today()->toDateString()], null, null, true);

            $sumary->selectRaw('SUM(d_request) as d_request, SUM(d_impression) as d_impression, SUM(d_impression_us_uk) as d_impression_us_uk, AVG(d_ecpm) as d_ecpm, SUM(d_revenue) as d_revenue, AVG(count) as count, AVG(share) as share, SUM(p_impression) as p_impression, AVG(p_ecpm) as p_ecpm, SUM(p_revenue) as p_revenue, SUM(profit) as profit, SUM(sale_percent) as sale_percent, SUM(system_percent) as system_percent, SUM(salary) as salary, SUM(deduction) as deduction, SUM(net_profit) as net_profit');
            $sumary = $sumary->first();

            $modelAdserverSummary = new Report();
            $adServerSumary = $modelAdserverSummary->searchByQuery($request, ['report_type_id' => 2,'from' => Carbon::today()->toDateString(),'to' => Carbon::today()->toDateString()], null, null, true);
            $adServerSumary->selectRaw('SUM(d_request) as d_request');
            $adServerSumary = $adServerSumary->first();

            $sumary->d_request = 0;
            $sumary->d_request += $adServerSumary->d_request;

            return view('administrator.dashboard.index', compact('totalUser','totalWebsite','totalZone','totalZonePending','sumary'));
        }
        return redirect()->to('/admin');
    }
}
