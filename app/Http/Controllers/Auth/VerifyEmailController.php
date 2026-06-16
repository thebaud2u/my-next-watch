<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class VerifyEmailController extends Controller
{
	/**
	 * Mark the user's email address as verified.
	 */
	public function __invoke(Request $request): RedirectResponse
	{
		$user = User::findOrFail($request->route('id'));

		if(!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
			abort(403);
		}

		if($user->markEmailAsVerified()) event(new Verified($user));

		return redirect()->route('login')->withSuccess(__('You have successfully verified your email address, please log in'));
	}
}
