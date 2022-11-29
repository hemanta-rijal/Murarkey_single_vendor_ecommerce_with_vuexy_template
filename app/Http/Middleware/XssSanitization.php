<?php

namespace App\Http\Middleware;

use Closure;


use Illuminate\Http\Request;

class XssSanitization
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
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
            });
        $request->merge($input);
        return $next($request);
    }
}
