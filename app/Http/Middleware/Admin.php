<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()){
            return redirect()->route('loginAdmin');
        }
        if (auth()->user()->is_admin == 0) {
            return redirect()->route('loginAdmin');
        }

        return $next($request);
    }
}
