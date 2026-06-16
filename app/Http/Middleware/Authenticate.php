<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
	public function handle($request, \Closure $next, ...$guards)
	{
		$this->guards = $guards;

		return parent::handle($request, $next, ...$guards);
	}

	protected function redirectTo($request)
	{
		if(!$request->expectsJson()) {
			$guard = $this->guards[0] ?? null;

			$redirectBase = match ($guard) {
				'admin' => route('admin.index'),
				'web', null => route('login'),
				default => route('login'),
			};

			return $redirectBase;
		}
	}
}