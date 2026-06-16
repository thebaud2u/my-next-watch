<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
	public function index(): View|RedirectResponse
	{
		if(!Auth::guard('admin')->check()) return view('admin.index');
		else return redirect()->intended(route('admin.dashboard'));
	}

	public function store(Request $request): RedirectResponse
	{
		$rules = [
			'email' => 'required',
			'password' => 'required'
		];

		$messages = [
			'email.required' => 'Votre adresse email est obligatoire',
			'password.required' => 'Votre mot de passe est obligatoire'
		];

		$credentials = $request->validate($rules, $messages);

		$remember = $request->filled('remember');

		if(Auth::guard('admin')->attempt($credentials, $remember)) {
			$request->session()->regenerate();

			return redirect()->intended(route('admin.dashboard'));
		}

		return redirect(route('admin.index'))->withErrors(['email' => 'Les informations fournies ne correspondent pas.']);
	}

	public function logAsUser(User $user)
	{
		Auth::guard('web')->login($user);

		if($user->hasRole('applicant')) $route = 'home';
		elseif($user->hasRole('recruiter')) $route = 'home.recruiter';

		return redirect()->route($route);
	}

	public function signOutAsUser()
	{
		Auth::guard('web')->logout();

		return redirect()->route('admin.dashboard');
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
