<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

use App\Services\BrevoService;
use App\Services\StripeService;

use App\Models\{Country, Professionnal, Role, User};

class RegisteredUserController extends Controller
{
	protected $brevoService;

	/**
	 * Display the registration view.
	 */
	public function create(Request $request): View
	{
		return view('auth.register', [
			'role' => $request->query('role', 'breeder')
		]);
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request, FigoService $figoService): RedirectResponse
	{
		$rules = [
			'gender' => ['required'],
			'firstname' => ['required', 'string', 'min:2', 'max:125'],
			'lastname' => ['required', 'string', 'min:2', 'max:125'],
			'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
			'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
			'country' => ['required'],
			'cgu' => ['required'],
			'check-role' => ['required'],
		];

		$messages = [
			'gender.required' => __(':element is mandatory', ['element' => __('The gender')]),
			'firstname.required' => __(':element is mandatory', ['element' => __('The firstname')]),
			'firstname.string' => __('There can\'t be any numerals in your :element', ['element' => __('firstname')]),
			'firstname.min' => __('Your :element must be :x caracters minimum', ['element' => __('firstname'), 'x' => 2]),
			'firstname.max' => __('Your :element must be :x caracters maximum', ['element' => __('firstname'), 'x' => 125]),
			'lastname.required' => __(':element is mandatory', ['element' => __('The lastname')]),
			'lastname.string' => __('There can\'t be any numerals in your :element', ['element' => __('lastname')]),
			'lastname.min' => __('Your :element must be :x caracters minimum', ['element' => __('lastname'), 'x' => 2]),
			'lastname.max' => __('Your :element must be :x caracters maximum', ['element' => __('lastname'), 'x' => 125]),
			'email.required' => __(':element is mandatory', ['element' => __('The email')]),
			'email.email' => __(':element is expected', ['element' => __('An email')]),
			'email.lowercase' => __('Your :element must be in lowercase', ['element' => __('email')]),
			'email.max' => __('Your :element must be :x caracters maximum', ['element' => __('email'), 'x' => 255]),
			'email.unique' => __('An account already exists with this email'),
			'password.required' => __(':element is mandatory', ['element' => __('The password')]),
			'password.confirmed' => __('Both password don\'t match'),
			'password.min' => __('The password must contain at least :min characters', ['min' => 8]),
			'country.required' => __(':element is mandatory', ['element' => __('The country')]),
			'cgu.required' => __('You must accept the terms of use'),
			'check-role.required' => __('You must check this'),
		];

		$request->validate($rules, $messages);

		$roleName = 'applicant';

		if($request->role == 'candidat') $roleName = 'applicant';
		elseif($request->role == 'recruteur') $roleName = 'recruiter';

		$role = Role::where('name', $roleName)
			->first();

		if($role) {
			$user = new User;
			$user->gender = $request->gender;
			$user->name = $request->firstname.' '.$request->lastname;
			$user->firstname = $request->firstname;
			$user->lastname = $request->lastname;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();

			$user->assignRole($role);

			if($user->hasRole('recruiter')) {
				$stripe = new StripeService;

				$customer_id = $stripe->createCustomer($user);
			}

			$user->initValues();

			$optins = [
				'optin_newsletter',
				'optin_receive_info',
				'optin_receive_deals'
			];

			$optinValues = collect($optins)->mapWithKeys(function ($key) use ($request) {
				return [$key => $request->filled($key) ? 1 : 0];
			});

			$user->updateValue('optins', $optinValues->toArray());
			$user->save();

			$country = Country::where('iso_code', $request->country)
				->first();

			if($country) {
				$user->address()->create([
					'country_id' => $country->id
				]);
			}

			try {
				$this->brevoService = new BrevoService;
				$attributes= [];
				$suffix = '';

				if($user->hasRole('recruiter')) $suffix = 'RECRUTEUR';
				else $suffix = 'CANDIDAT';

				if(!is_null($request->optin_newsletter)) {
					$attributes['OPTIN_NL_'.$suffix] = 1;
				}
				if(!is_null($request->optin_receive_info)) {
					$attributes['OPTIN_MARKETING_'.$suffix] = 1;
				}
				if(!is_null($request->optin_receive_deals)) {
					$attributes['OPTIN_PARTENAIRE_'.$suffix] = 1;
				}

				$result = $this->brevoService->addContactToList(
					$request->email,
					[9],
					$attributes
				);
			} catch (Exception $e) {
				Log::error('erreur création optin');
			}

			event(new Registered($user));

			if($user->hasRole('recruiter')) $userRole = 'recruteur';
			else $userRole = 'candidat';

			return redirect()
				->route('login')
				->withSuccess(__('Please confirm your email address by clicking on the link sent to you'))
				->with('gtm', [
					'event'     => 'sign_up',
					'user_type' => $userRole,
					'opt_in'    => $request->has('optin_figo') ? 'yes' : 'no'
				]);
		}
		else return redirect(route('register'))->withError(__('The given role doesn\'t exist'));
	}
}
