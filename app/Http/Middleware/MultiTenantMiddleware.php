<?php

namespace App\Http\Middleware;

use Closure;

class MultiTenantMiddleware
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
        if (!app('tenant')) {
            abort(404);
        }

        return $next($request);
    }
}
