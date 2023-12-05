<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status'=>'token is invalid']);
            }
            elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status'=>'token is Expired']);
            }
            else  {
                return response()->json(['status'=>'authorization token not Fund']);
            }
        };

        return $next($request);
    }
}
