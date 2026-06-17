@extends('admin.layouts.app')

@section('body')
	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200 bg-white">
		<!-- Session Status -->
		<x-auth.auth-session-status class="mb-4" :status="session('status')" />

		<x-front.form-part-title>
			{{ __('Login') }}
		</x-front.form-part-title>

		<div class="mt-10" style="padding:0 0 0 40px;">
			<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
				<form method="POST" action="{{ route('admin.login') }}">
					@csrf

					<!-- Email Address -->
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="email" :value="__('Email')" :required="true" />
						</div>

						<x-front.text-input name="email" id="email" value="{{ old('email') }}" required placeholder="{{ __('Account\'s email address') }}" :class="'mt-1 block bg-white w-full'" />

						@error('email')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<!-- Password -->
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="password" :value="__('Password')" :required="true" />
						</div>

						<x-front.text-input type="password" name="password" id="password" required placeholder="{{ __('Account\'s password') }}" :class="'mt-1 block bg-white w-full'" />

						@error('password')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<!-- Remember Me -->
					<div>
						<label for="remember_me" class="inline-flex items-center">
							<input id="remember_me" type="checkbox" class="rounded border-mnw-deepblue text-mnw-deepblue focus:ring-mnw-deepblue" name="remember">
							<span class="ms-2 text-sm text-mnw-deepblue">{{ __('Remember me') }}</span>
						</label>
					</div>

					<div class="flex items-center justify-end mt-4">
						<x-front.primary-button :class="'ml-4'">
							{{ __('Log in') }}
						</x-front.primary-button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
