<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class LoginController extends Controller
{
	public function index(User $user)
	{
		return view('front.connect');
	}

	/**
	 * Full logout
	 * Destroy an authenticated session.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout(Request $request)
	{
		/** App logout */
		Auth::guard('web')->logout();

		/** Admin logout */
		if (! empty(Auth::guard('admin')->user()->id)) Auth::guard('admin')->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		/** Redirect */
		return redirect()->route('home');
	}
}
