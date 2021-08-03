<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()) {
            if ($request->user()->role !== 'admin') {
                return back();
            }
        } else {
            return back();
        }
        
        return $next($request);
    }
}
