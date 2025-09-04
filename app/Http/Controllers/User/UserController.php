<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Payment;
use App\Models\Report;
use App\Models\ReportByDevice;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\UserPaymentMethod;
use App\Models\Website;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\WebsiteTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('user.dashboard');
    }

    public function dashboard(Request $request)
    {
        if (auth()->check()) {
            if (optional(auth()->user())->is_admin != 0) {
                return redirect()->route('administrator.dashboard.index');
            }
        }

        $revenueNow = Report::where(['report_type_id' => 1, 'user_id' => auth()->id(), 'date' => Carbon::today()->toDateString()])->sum('p_revenue');
        $revenueYesterday = Report::where(['report_type_id' => 1, 'user_id' => auth()->id(), 'date' => Carbon::yesterday()->toDateString()])->sum('p_revenue');

        $revenueThisMonth = Report::where(['report_type_id' => 1, 'user_id' => auth()->id()])
            ->whereDate('date', '>=', Carbon::today()->startOfMonth()->toDateString())
            ->whereDate('date', '<=', Carbon::today()->endOfMonth()->toDateString())
            ->sum('p_revenue');

        $revenueLastMonth = Report::where(['report_type_id' => 1, 'user_id' => auth()->id()])
            ->whereDate('date', '>=', Carbon::today()->subMonth()->startOfMonth()->toDateString())
            ->whereDate('date', '<=', Carbon::today()->subMonth()->endOfMonth()->toDateString())
            ->sum('p_revenue');

        $siteCharts = [];

        $from = Carbon::today()->subDays(7);
        $to = Carbon::today();


        $sites = Website::where('user_id', auth()->id())->get();

        $dateRanger = Helper::daysBetweenTwoDates($from, $to);
        for ($i = 0; $i <= $dateRanger; $i++) {
            $row = [
                'period' => $from->copy()->addDays($i)->format('M-d-Y'),
            ];

            foreach ($sites as $site) {
                $row[$site->name] = WebsiteTrait::revenue($site->id, $from->copy()->addDays($i)->toDateString(), $from->copy()->addDays($i + 1)->toDateString());
            }

            $siteCharts[] = $row;
        }

        $performanceSites = Website::where('user_id', auth()->id())->get()->toArray();

        foreach ($performanceSites as &$performanceSite){
            $performanceSite['page_view'] = WebsiteTrait::pageView($performanceSite['id'], $from, $to);
            $performanceSite['impressions'] = WebsiteTrait::impressions($performanceSite['id'], $from, $to);
            $performanceSite['revenue'] = WebsiteTrait::revenue($performanceSite['id'], $from, $to);
        }
        unset($performanceSite);

        $trafficByContries = [];
        $trafficByDevices = [];
        $trafficByReferrers = [];

        foreach (Website::where(['user_id' => auth()->id()])->get() as $item){
            foreach (WebsiteTrait::reports($item->id, 2, $from->toDateString(), $to->toDateString()) as $report) {
                $reportByCountries = $report->reportByCountries;
                foreach ($reportByCountries as $reportByCountry) {
                    $reportByCountryGeoID = current(array_filter($trafficByContries, fn($tmp) => $tmp->national_id == $reportByCountry->national_id));
                    if (!$reportByCountryGeoID) {
                        $trafficByContries[] = $reportByCountry;
                    } else {
                        $reportByCountryGeoID['requests'] += $reportByCountry['requests'];
                        $reportByCountryGeoID['requests_empty'] += $reportByCountry['requests_empty'];
                        $reportByCountryGeoID['impressions'] += $reportByCountry['impressions'];
                        $reportByCountryGeoID['impressions_unique'] += $reportByCountry['impressions_unique'];
                    }
                }

                $reportByDevices = $report->reportByDevices;
                foreach ($reportByDevices as $reportByDevice) {
                    $reportByDeviceID = current(array_filter($trafficByDevices, fn($tmp) => $tmp->device_id == $reportByDevice->device_id));
                    if (!$reportByDeviceID) {
                        $trafficByDevices[] = $reportByDevice;
                    } else {
                        $reportByDeviceID['requests'] += $reportByDevice['requests'];
                        $reportByDeviceID['requests_empty'] += $reportByDevice['requests_empty'];
                        $reportByDeviceID['impressions'] += $reportByDevice['impressions'];
                        $reportByDeviceID['impressions_unique'] += $reportByDevice['impressions_unique'];
                    }
                }

                $reportByReferrers = $report->reportByReferrers;
                foreach ($reportByReferrers as $reportByReferrer) {
                    $reportByReferrerID = current(array_filter($trafficByReferrers, fn($tmp) => $tmp->referrer_id == $reportByReferrer->referrer_id));
                    if (!$reportByReferrerID) {
                        $trafficByReferrers[] = $reportByReferrer;
                    } else {
                        $reportByReferrerID['requests'] += $reportByReferrer['requests'];
                        $reportByReferrerID['requests_empty'] += $reportByReferrer['requests_empty'];
                        $reportByReferrerID['impressions'] += $reportByReferrer['impressions'];
                        $reportByReferrerID['impressions_unique'] += $reportByReferrer['impressions_unique'];
                    }
                }
            }
        }

        usort($performanceSites, function ($a, $b) {
            return $b['impressions'] <=> $a['impressions'];
        });

        if (count($trafficByContries) > 10){
            $trafficByContries = array_slice($trafficByContries, 0, 10);
        }

        if (count($trafficByDevices) > 10){
            $trafficByDevices = array_slice($trafficByDevices, 0, 10);
        }

        if (count($trafficByReferrers) > 10){
            $trafficByReferrers = array_slice($trafficByReferrers, 0, 10);
        }

        $colors = [
            "#ff3c3c",
            "#3d8b1c",
            "#1c4ddb",
            "#e68a00",
            "#6b1cdb",
            "#0099cc",
            "#00cc9c",
            "#0033cc",
            "#60acc6",
            "#064155",
        ];
        $jsonDrawMaps = [];
        $jsonColorMaps = [];

        foreach ($trafficByContries as $index => $trafficByContry){
            $jsonDrawMaps[] = [optional($trafficByContry->national)->name, $index,Formatter::formatNumber($trafficByContry['requests'] / max(1, array_sum(array_column($trafficByContries, "requests"))) * 100, 2) . '%'];
            $jsonColorMaps[] = $colors[$index];
        }

        $jsonDrawChartDevices = [];
        $jsonColorChartDevices = ["#4b8bff", '#6abf4b','#ffb84b','#e68a00','#6b1cdb','#0099cc','#00cc9c','#0033cc','#60acc6','#064155'];
        $jsonDrawChartDevices[] = ["Device", "Users"];
        foreach ($trafficByDevices as $trafficByDevice){
            $jsonDrawChartDevices[] = [
                optional($trafficByDevice->device)->name,
                $trafficByDevice->requests
            ];
        }

        return view('user.home.index', compact('revenueNow', 'revenueYesterday', 'revenueThisMonth', 'revenueLastMonth','siteCharts','sites','performanceSites','trafficByContries','jsonDrawMaps','jsonColorMaps','trafficByDevices','jsonDrawChartDevices','jsonColorChartDevices','trafficByReferrers'));
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
        $items = $model->searchByQuery($request, ['report_type_id' => 1, 'user_id' => auth()->id()]);

        $modelSumary = new Report();
        $summary = $modelSumary->searchByQuery($request, ['report_type_id' => 1, 'user_id' => auth()->id()], null, null, true);
        $summary = $summary->selectRaw('SUM(p_impression) as p_impression, AVG(p_ecpm) as p_ecpm, SUM(p_revenue) as p_revenue')->first();

        $websites = (new Website())->searchByQuery(null, ['user_id' => auth()->id()]);
        $zoneWebsites = (new ZoneWebsite())->searchByQuery(null, ['user_id' => auth()->id()]);

        return view('user.report.index', compact('items', 'zoneWebsites', 'websites', 'summary'));
    }

    public function wallet(Request $request)
    {
        $model = new Payment();
        $items = $model->searchByQuery($request, ['user_id' => auth()->id()]);

        $summary = Payment::where('user_id', auth()->id())
            ->selectRaw('SUM(earning) as earning, SUM(deduction) as deduction, SUM(invalid) as invalid')
            ->first();

        $withdraw = Payment::where(['user_id' => auth()->id(), 'payment_status_id' => 2])->sum('total');

        $userPaymentMethod = UserPaymentMethod::where(['user_id' => auth()->id(), 'is_default' => true])->first();

        if (empty($userPaymentMethod)) {

            $userPaymentMethod = UserPaymentMethod::firstOrCreate([
                'user_id' => auth()->id(),
                'payment_method_id' => 1,
            ], [
                'user_id' => auth()->id(),
                'payment_method_id' => 1,
                'is_default' => true,
            ]);
        }

        return view('user.wallet.index', compact('items', 'summary', 'withdraw', 'userPaymentMethod'));

    }

    public function exportReport(Request $request)
    {
        return Excel::download(new ModelExport(new Report(), $request, ['user_id' => auth()->id()]), 'reports_' . Carbon::now()->toDateTimeString() . '.xlsx');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

}
