<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function view;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        if (auth()->check()) {
//            if (optional(auth()->user())->is_admin == 0) {
//                return view('administrator.login.index');
//            }
//            return redirect()->route('administrator.dashboard.index');
//        }
//
//        return view('administrator.login.index');

        return view('user.home.index');
    }
}
