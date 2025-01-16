<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
	/**
	 * Login
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function login()
	{
		$this->check();

		return view('admin.login');
	}

	public function authenticate(Request $request)
	{
		$admin = Admin::where('email', $request->input('email'))
			->first();

		if($admin) {
			if(Hash::check($request->input('password'), $admin->password)) {
				$request->session()->regenerate();
				Auth::guard('admin')->login($admin);

				return redirect()->route('admin.dashboard');
			}
		}

		return back()->withErrors([
			'email' => 'The provided credentials do not match our records',
		])->onlyInput('email');
	}

	/**
	 * Status check
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function check()
	{
		if(Auth::guard('web')->check()) Auth::guard('web')->logout();

		if(Auth::guard('admin')->check()) return redirect()->route('admin.dashboard');
		else return redirect()->route('admin.login');
	}

	public function logAsUser(User $user)
	{
		Auth::guard('web')->login($user);

		return redirect()->route('home');
	}

	/**
	 * Logout
	 * ('admin' web guard)
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route('home');
	}
}
