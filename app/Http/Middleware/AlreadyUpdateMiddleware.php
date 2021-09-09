<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AlreadyUpdateMiddleware
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
        if(!is_null(Auth::user()) && Auth::user()->info->province_code === '*') {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
