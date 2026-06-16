<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAnyGuard
{
	public function handle($request, Closure $next)
	{
		if(Auth::guard('admin')->check()) {
			Auth::shouldUse('admin'); // pour que Auth::user() retourne l'admin
			return $next($request);
		}

		if(Auth::guard('web')->check()) {
			Auth::shouldUse('web'); // pour que Auth::user() retourne le user
			return $next($request);
		}

		abort(401); // ou redirect('/login')
	}
}