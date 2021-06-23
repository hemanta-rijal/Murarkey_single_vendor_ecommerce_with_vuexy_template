<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class jwtMiddleware
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
        try {
            $expirey = 5;
            auth()->setTTL($expirey);
            // auth()->factory()->setTTL($expirey);
            // JWTAuth::factory()->setTTL($expirey);
            // $user = JWTAuth::parseToken()->authenticate();
            $user = auth()->user();
            if ($user) {
                return $next($request);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            } else {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return response()->json(['status' => 'Authorization Token not found']);

    }
}
