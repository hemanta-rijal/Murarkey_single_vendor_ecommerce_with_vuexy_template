<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // working code
        $user = Auth::guard('admin')->user();
        $route_name = \Request::route()->getName();
        $rel_perms = explode(',', implode(',', $user->permissions->pluck('routes')->toArray()));

        if (!in_array($route_name, $rel_perms)) {
            // abort(403); //uncomment to work properly
        }
        return $next($request);
    }
}
