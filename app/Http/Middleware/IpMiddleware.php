<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ip() != env('ALLOWED_REQUEST_IP')) {
            return response('This ip is not allowed','401');
        }

        return $next($request);
    }
}
