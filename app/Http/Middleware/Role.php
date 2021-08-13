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
        $user = Auth::guard('admin')->user();
        // dd($user->permissions);
        $route_name = \Request::route()->getName();
        // dd($route_name);
        // $permission_slug = explode('.', $route_name)[1] . '-' . explode('.', $route_name)[2];
        $rel_perms = explode(',', implode(',', $user->permissions->pluck('routes')->toArray()));
        // dd(in_array($route_name, $rel_perms));
        // dd($rel_perms);
        // dd(implode(',', $rel_perms));
        if (!in_array($route_name, $rel_perms)) {
            // $permission = Permission::where('slug', $permission_slug)->first();
            // dd($permission);
            // dd($permission_slug, explode(',', $permission->routes));
            // if (!in_array($permission_slug, $explode(',', $permission->routes)))

            // return $next($request);
            // {
            abort(403);
            // }

        }
        // $roles = null;
        // $permission = null;
        // if (!role_match($roles)) {
        //     return abort(403, 'Unauthorized.');
        // }
        // if ($permission !== null && !$request->user()->can($permission)) {
        //     abort(404);
        // }
        return $next($request);
    }
}
