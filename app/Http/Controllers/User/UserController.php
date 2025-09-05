<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Payment;
use App\Models\Report;
use App\Models\ReportByDevice;
use App\Models\SingleImage;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\UserPaymentMethod;
use App\Models\Website;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\StorageImageTrait;
use App\Traits\WebsiteTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        if ($request->f == "This Month"){
            $from = Carbon::today()->startOfMonth();
            $to = Carbon::today();
        }else if ($request->f == "Last Month"){
            $from = Carbon::today()->subMonth()->startOfMonth();
            $to = Carbon::today()->subMonth()->endOfMonth();
        }else if ($request->f == "Custom" && $request->c_f && $request->c_t){
            $from = Carbon::parse($request->c_f);
            $to = Carbon::parse($request->c_t);
        }

        $sites = Website::where('user_id', auth()->id())->get();

        $dateRanger = Helper::daysBetweenTwoDates($from, $to);
        for ($i = 0; $i <= $dateRanger; $i++) {
            $row = [
                'period' => $from->copy()->addDays($i)->format('M-d-Y'),
            ];

            foreach ($sites as $index => $site) {
                if ($index >= 10) break;
                $row[$site->name] = WebsiteTrait::revenue($site->id, $from->copy()->addDays($i)->toDateString(), $from->copy()->addDays($i)->toDateString());
            }

            $siteCharts[] = $row;
        }

//        if (count($siteCharts) > 3){
//            // 1. Calculate total sum for each site
//            $totals = [];
//            foreach ($siteCharts as $row) {
//                foreach ($row as $site => $value) {
//                    if ($site === "period") continue;
//                    $totals[$site] = ($totals[$site] ?? 0) + $value;
//                }
//            }
//
//// 2. Sort totals descending
//            arsort($totals);
//
//// 3. Pick top 3 sites
//            $topSites = array_slice(array_keys($totals), 0, 3, true);
//
//// 4. Rebuild dataset with top 3 + "other"
//            $result = [];
//            foreach ($siteCharts as $row) {
//                $newRow = ["period" => $row["period"]];
//                $otherTotal = 0;
//                foreach ($row as $site => $value) {
//                    if ($site === "period") continue;
//                    if (in_array($site, $topSites)) {
//                        $newRow[$site] = $value;
//                    } else {
//                        $otherTotal += $value;
//                    }
//                }
//                $newRow["other"] = $otherTotal;
//                $result[] = $newRow;
//            }
//
//            $siteCharts = $result;
//        }




        $totals = [];
        foreach ($siteCharts as $row) {
            foreach ($row as $k => $v) {
                if ($k === 'period' || $k === 'total') continue;
                $totals[$k] = ($totals[$k] ?? 0) + (float)$v;
            }
        }

        arsort($totals);
        $sitePriority = array_keys($totals);

        $result = [];
        foreach ($siteCharts as $row) {
            $newRow = [];
            foreach ($sitePriority as $site) {
                // if site exists in original row, include it (otherwise 0)
                $newRow[$site] = array_key_exists($site, $row) ? $row[$site] : 0;
            }
            // keep 'total' if present in original row (optional)
            if (array_key_exists('total', $row)) {
                $newRow['total'] = $row['total'];
            }
            // finally append period at the end as requested
            $newRow['period'] = $row['period'];

            $result[] = $newRow;
        }

        $siteCharts = $result;


        $performanceSites = Website::where('user_id', auth()->id())->get()->toArray();

        foreach ($performanceSites as &$performanceSite) {
            $performanceSite['page_view'] = WebsiteTrait::pageView($performanceSite['id'], $from, $to);
            $performanceSite['impressions'] = WebsiteTrait::impressions($performanceSite['id'], $from, $to);
            $performanceSite['revenue'] = WebsiteTrait::revenue($performanceSite['id'], $from, $to);
        }
        unset($performanceSite);

        $trafficByContries = [];
        $trafficByDevices = [];
        $trafficByReferrers = [];

        foreach (Website::where(['user_id' => auth()->id()])->get() as $item) {
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

        if (count($trafficByContries) > 10) {
            $trafficByContries = array_slice($trafficByContries, 0, 10);
        }

        if (count($trafficByDevices) > 10) {
            $trafficByDevices = array_slice($trafficByDevices, 0, 10);
        }

        if (count($trafficByReferrers) > 10) {
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

        foreach ($trafficByContries as $index => $trafficByContry) {
            $jsonDrawMaps[] = [optional($trafficByContry->national)->name, $index, Formatter::formatNumber($trafficByContry['requests'] / max(1, array_sum(array_column($trafficByContries, "requests"))) * 100, 2) . '%'];
            $jsonColorMaps[] = $colors[$index];
        }

        $jsonDrawChartDevices = [];
        $jsonColorChartDevices = ["#4b8bff", '#6abf4b', '#ffb84b', '#e68a00', '#6b1cdb', '#0099cc', '#00cc9c', '#0033cc', '#60acc6', '#064155'];
        $jsonDrawChartDevices[] = ["Device", "Users"];
        foreach ($trafficByDevices as $trafficByDevice) {
            $jsonDrawChartDevices[] = [
                optional($trafficByDevice->device)->name,
                $trafficByDevice->requests
            ];
        }

        return view('user.home.index', compact('revenueNow', 'revenueYesterday', 'revenueThisMonth', 'revenueLastMonth', 'siteCharts', 'sites', 'performanceSites', 'trafficByContries', 'jsonDrawMaps', 'jsonColorMaps', 'trafficByDevices', 'jsonDrawChartDevices', 'jsonColorChartDevices', 'trafficByReferrers'));
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
        $items = $model->searchByQuery($request, ['report_type_id' => 1, 'user_id' => auth()->id()], null, null, true);

        $searchWebsiteIDs = [];
        if ($request->website_ids) {
            $searchWebsiteIDs = explode(",", $request->website_ids);
            $items = $items->whereIn('website_id', $searchWebsiteIDs);
        }
        $items = $items->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest(optional($request)->limit))->appends(request()->query());

        $modelSumary = new Report();
        $summary = $modelSumary->searchByQuery($request, ['report_type_id' => 1, 'user_id' => auth()->id()], null, null, true);
        $summary = $summary->selectRaw('SUM(p_impression) as p_impression, AVG(p_ecpm) as p_ecpm, SUM(p_revenue) as p_revenue')->first();

        $websites = (new Website())->searchByQuery(null, ['user_id' => auth()->id()]);
        $zoneWebsites = (new ZoneWebsite())->searchByQuery(null, ['user_id' => auth()->id()]);

        return view('user.report.index', compact('items', 'zoneWebsites', 'websites', 'summary', 'searchWebsiteIDs'));
    }

    public function profile(Request $request)
    {
        return view('user.profile.index');
    }

    public function updateProfile(Request $request)
    {

        if ($request->image) {
            $item = SingleImage::firstOrCreate([
                'relate_id' => auth()->id(),
                'table' => 'users',
            ], [
                'relate_id' => auth()->id(),
                'table' => 'users',
                'image_path' => 'waiting_update',
                'image_name' => 'waiting_update',
                'is_public' => $request->is_public ?? 1,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $item->id);

            $item->update([
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ]);
            $item->refresh();
        }

        if ($request->current_password){
            if (!$request->new_password){
                return back()->with('new_password', 'Password can not empty');
            }
            if (!$request->new_password_confirm){
                session()->flash('new_password_confirm', 'Password confirm can not empty');
            }

            if ($request->new_password != $request->new_password_confirm){
                session()->flash('new_password_confirm', 'Not match');
            }

            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->with('current_password', 'Your current password does not match our records.');
            }

            auth()->user()->password = Formatter::hash($request->current_password);
            auth()->user()->save();
        }
        return back()->with('success', 'Changed!');
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
