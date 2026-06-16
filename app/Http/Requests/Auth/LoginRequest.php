<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Hash, RateLimiter};
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Enums\ContactTypes;

use App\Models\{Contact, User};

class LoginRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'email' => ['required', 'string'],
			'password' => ['required', 'string'],
		];
	}

	/**
	 * Attempt to authenticate the request's credentials.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function authenticate(): void
	{
		$this->ensureIsNotRateLimited();

		$credentials = $this->only('email', 'password');
		$email = strtolower($credentials['email']);
		$user = User::where('email', $email)
			->orWhere('code', $credentials['email'])
			->first();

		if(!$user || ($user->code !== $credentials['email'] && $user->email !== $email) || ! Hash::check($credentials['password'], $user->password)) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'email' => trans('auth.failed'),
			]);
		}

		if($user->hasVerifiedEmail()) {
			Auth::login($user, $this->boolean('remember'));

			RateLimiter::clear($this->throttleKey());

			$user->forceFill(['last_logon' => now()])->save();

			$unloggedApplications = Contact::where('email', $user->email)
				->where('type', ContactTypes::Application)
				->get();

			if($unloggedApplications->isNotEmpty()) {
				foreach($unloggedApplications as $unloggedApplication) {
					$values = new Collection();
					$values->put('message', $unloggedApplication->message)
						->put('archive', collect(['asking' => false, 'answerer' => false]));

					$newResponse = new Response;
					$newResponse->model()->associate($unloggedApplication->model);
					$newResponse->from()->associate($user);
					$newResponse->to()->associate($unloggedApplication->model->user);
					$newResponse->values = $values;
					$newResponse->save();

					$unloggedApplication->delete();
				}
			}
		}
		else {
			throw ValidationException::withMessages([
				'email' => __('Please confirm your email address by clicking on the link sent to you'),
			]);
		}
	}

	/**
	 * Ensure the login request is not rate limited.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function ensureIsNotRateLimited(): void
	{
		if(!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
			return;
		}

		event(new Lockout($this));

		$seconds = RateLimiter::availableIn($this->throttleKey());

		throw ValidationException::withMessages([
			'email' => trans('auth.throttle', [
				'seconds' => $seconds,
				'minutes' => ceil($seconds / 60),
			]),
		]);
	}

	/**
	 * Get the rate limiting throttle key for the request.
	 */
	public function throttleKey(): string
	{
		return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
	}
}
