<?php

namespace App\Http\Middleware;

use Closure;

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
        if (optional($request->user())->is_admin == 0) {
            optional($request->user())->logout();
            return redirect()->route('loginAdmin');
        }

        return $next($request);
    }
}
