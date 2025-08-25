<?php

namespace App\Http\Controllers\User;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Payment;
use App\Models\Report;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\UserPaymentMethod;
use App\Models\Website;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class UserController extends Controller
{
    public function index(Request $request){
        return redirect()->route('user.dashboard');
    }
    public function dashboard(Request $request)
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
        $items = $model->searchByQuery($request, ['user_id' => auth()->id()]);

        $websites = (new Website())->searchByQuery(null, ['user_id' => auth()->id()]);
        $zoneWebsites = (new ZoneWebsite())->searchByQuery(null, ['user_id' => auth()->id()]);

        return view('user.report.index', compact('items','zoneWebsites','websites'));
    }

    public function wallet(Request $request)
    {
        $model = new Payment();
        $items = $model->searchByQuery($request,['user_id' => auth()->id()]);

        $revenue = Report::where(['user_id'=> auth()->id(), 'report_status_id'=> 2])->whereDate('date', '>=', Carbon::today()->startOfMonth())->whereDate('date', '>=', Carbon::today()->endOfMonth())->sum('p_revenue');
        $deduction = Report::where(['user_id'=> auth()->id(), 'report_status_id'=> 2])->whereDate('date', '>=', Carbon::today()->startOfMonth())->whereDate('date', '>=', Carbon::today()->endOfMonth())->sum('deduction');

        $userPaymentMethod = UserPaymentMethod::where(['user_id' => auth()->id(), 'is_default' => true])->first();
        $pendingPayment = [
            'id' => 0,
            'date' => Carbon::today()->year . "-" . Carbon::today()->month,
            'user_id' => auth()->id(),
            'user_payment_method_id' => optional($userPaymentMethod)->payment_method_id,
            'earning' => $revenue,
            'deduction' => $deduction,
            'total' => $revenue - $deduction,
            'payment_status_id' => 1,
        ];
        return view('user.wallet.index', compact('items','pendingPayment'));

    }

    public function exportReport(Request $request)
    {
        return Excel::download(new ModelExport(new Report(), $request, ['user_id' => auth()->id()]), 'reports_' . Carbon::now()->toDateTimeString() . '.xlsx');

    }

}
