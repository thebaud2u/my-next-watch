<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowIpMiddleware
{
    public $allowIps = ['whitelist-ip-1', 'whitelist-ip-2', '127.0.0.1', '192.168.16.2', '212.95.72.204', '91.170.22.65'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->ip(), $this->allowIps)) {
            abort(403, "Your IP address (".$request->ip().") is not allowed to access this url.");
        }
        
        return $next($request);
    }
}
