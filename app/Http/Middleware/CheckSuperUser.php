<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperUser
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
        if ($request->user()->nivel != 'Admin') {
            abort(503);
        }
        return $next($request);
    }
}
