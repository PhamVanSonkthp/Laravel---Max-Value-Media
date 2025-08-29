<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneWebsite;
use function auth;
use function view;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {

            if (auth()->user()->is_admin != 0){
                return redirect()->route('administrator.dashboard.index');
            }

            $totalUser = User::where('is_admin', 0)->count();
            $totalWebsite = Website::count();
            $totalZone = ZoneWebsite::count();
            $totalZonePending = ZoneWebsite::where('zone_status_id', 1)->count();

            return view('administrator.dashboard.index', compact('totalUser','totalWebsite','totalZone','totalZonePending'));
        }
        return redirect()->to('/admin');
    }
}
