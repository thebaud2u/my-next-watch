<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array<int, string>
	 */
	protected $except = [
		'https://job.tema-transport-logistique.com/api/synch-last-posts',
		'/api/synch-last-posts',
		'synchLastPosts',
		'/back-office/faqs/upload',
		'swyp/*',
	];
}
