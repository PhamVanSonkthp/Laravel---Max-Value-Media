<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\Website;
use App\Models\ZoneStatus;
use Illuminate\Http\Request;
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
        return view('user.home.index');
    }

    public function website(Request $request)
    {
        $websiteModel = new Website();
        $items = $websiteModel->searchByQuery($request, ['user_id' => auth()->id()]);

        return view('user.website.index', compact('items'));

    }

}
