<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Microsoft\Graph\Graph;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
	/**
	 * Redirect (OAuth2 client login)
	 * ('admin' web guard)
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function redirect(Request $request)
	{
		return Socialite::driver('azure')->redirect();
	}

	/**
	 * Status check (OAuth2 client login)
	 * ('admin' web guard)
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function check(Request $request)
	{
		$admin = Auth::guard('admin')->user();

		if (Auth::guard('web')->check()) {
			if (! empty($admin->id)) {
				activity('admin')
					->performedOn(Auth::guard('web')->user())
					->causedBy($admin)
					->event('deimpersonated')
					->log('Admin #:causer.id (:causer.email) deimpersonated from User #:subject.id (:subject.email)');
			}

			Auth::guard('web')->logout();
		}

		if (empty($admin->id)) return Socialite::driver('azure')->redirect();
		else return redirect()->route('admin.dashboard');
	}

	/**
	 * Callback (OAuth2 client login)
	 * ('admin' web guard)
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function callback(Request $request)
	{
		$oauth2User = Socialite::driver('azure')->user();

		/** User unknown : create */
		$admin = Admin::firstOrCreate([
			'email' => $oauth2User->email,
		], [
			'name' => $oauth2User->user['givenName'].' '.$oauth2User->user['surname'],
			'first_name' => $oauth2User->user['givenName'],
			'last_name' => $oauth2User->user['surname'],
			'job_title' => $oauth2User->user['jobTitle'],
			'email' => $oauth2User->email//,
			//'password' => bcrypt('password'),
			// 'oauth2_id' => $oauth2User->id,
			// 'oauth2_token' => $oauth2User->token,
			// 'oauth2_refresh_token' => $oauth2User->refreshToken,
		]);

		$graph = new Graph();
		$graph->setAccessToken($oauth2User->token);

		// Récupère tous les groupes AD auxquels appartiens l'utilisateur
		$groupsAzureAd = $graph->createRequest('GET', '/me/memberOf')
			->setReturnType(\Microsoft\Graph\Model\Group::class)
			->execute();

		// Récupère la config tableau des groupes Microsoft Azure AD
		$backOfficeGroups = config('back-office.groups');

		foreach($groupsAzureAd->values as $groupAzureAd) {
			foreach($backOfficeGroups as $backOfficeGroup) {
				if($groupAzureAd->id == $backOfficeGroup['id']) $admin->assignRole($backOfficeGroup['role']);
			}
		}

		Auth::guard('admin')->login($admin, $remember = true);

		activity('admin')
			->performedOn($admin)
			->causedBy($admin)
			->event('login')
			->withProperties($oauth2User)
			->log('Admin #:subject.id (:subject.email) logged in');

		return redirect()->route('admin.dashboard');
	}

	public function logAsUser(User $user)
	{
		Auth::guard('web')->login($user);

		activity('admin')
			->performedOn($user)
			->causedBy(Auth::guard('admin')->user())
			->event('impersonated')
			->log('Admin #:causer.id (:causer.email) impersonated as User #:subject.id (:subject.email)');

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
		activity('admin')
			->performedOn(Auth::guard('admin')->user())
			->causedBy(Auth::guard('admin')->user())
			->event('logout')
			->log('Admin #:subject.id (:subject.email) logged out');

		Auth::guard('admin')->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route('home');
	}
}
