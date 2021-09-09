<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UpdateProfileMiddleware
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
        if(!is_null(Auth::user()->info) && Auth::user()->info->province_code === '*') {
            return redirect(route('user.update.profile'));
        } else {
            return $next($request);
        }
    }
}
