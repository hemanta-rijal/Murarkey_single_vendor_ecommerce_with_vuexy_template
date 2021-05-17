<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!role_match($roles)) {
            return abort(403, 'Unauthorized.');
        }

        return $next($request);

    }
}
