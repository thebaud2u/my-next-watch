<x-app-layout>
	@push('seo')
		<title>Se connecter au site Eleveurs-online.com</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<div class="w-full bg-jobboard-cream">
		<div class="flex flex-col items-center xlsm:items-start xlsm:flex-row max-w-[1200px] xlsm:justify-between w-full bg-jobboard-cream mx-auto py-8 md:py-10 max-sm:px-6">
			<div class="w-full mb-6 px-8 py-10 bg-white max-w-[750px] rounded-xl flex flex-col gap-y-8">
				<!-- Session Status -->
				<x-auth.auth-session-status class="mb-4" :status="session('status')" />
					<script>
						@if(session('gtm'))
							window.dataLayer = window.dataLayer || [];
							window.dataLayer.push(@json(session('gtm')));
						@endif
					</script>
				
				<div class="flex flex-col gap-y-4">
					<h1 class="mb-1 text-2xl lg:text-[40px] font-bold text-jobboard-deepblue leading-none">
						{{ __('Log in') }}
					</h1>

					@if((isset($errors) && $errors->any()) || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="flex justify-center mb-4">
							<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
								@include('components.front.alerts')
							</div>
						</div>
					@endif
				</div>


				<form method="POST" action="{{ route('login') }}">
					@csrf

					<!-- Email Address -->
					<div>
						<div class="flex flex-row pl-4">
							<x-front.input-label for="email" :value="__('Email')" :required="true" />
						</div>

						<x-front.text-input name="email" id="email" value="{{ old('email') }}" required
							placeholder="{{ __('Account\'s email address') }}" :class="'mt-1 block bg-white w-full'" />

						@error('email')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<!-- Password -->
					<div class="mt-2">
						<div class="flex flex-row pl-4">
							<x-front.input-label for="password" :value="__('Password')" :required="true" />
						</div>

						<x-front.text-input type="password" name="password" id="password" required
							placeholder="{{ __('Account\'s password') }}" :class="'mt-1 block bg-white w-full'" />

						@error('password')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<hr class="my-4">

					<!-- Remember Me -->
					<div class="mt-2">
						<label for="remember_me" class="inline-flex items-center">
							<input id="remember_me" type="checkbox"
								class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue"
								name="remember">
							<span class="ms-2 text-sm text-jobboard-deepblue">{{ __('Remember me') }}</span>
						</label>
					</div>

					<div class="flex flex-col justify-center mt-4 w-full">
						<div class="w-full">
							<x-front.primary-button :class="'w-full justify-center gap-2'">
								{{ __('I log in') }}
							</x-front.primary-button>

							<svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.86231 1L7.31685 6L1.8623 11" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>

						@if(Route::has('password.request'))
							<a href="{{ route('password.request') }}"
								class="text-sm text-jobboard-deepblue font-bold flex items-center gap-x-2">
								{{ __('Forgot your password') }}

								<svg width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.4917 1L5.85534 5L1.4917 9" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						@endif
					</div>
				</form>
			</div>

			{{-- <div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md bg-white">
				<a href="{{ route('register') }}"
					class="underline text-sm text-jobboard-deepblue hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					{{ __('Don\'t have an account') }} ?
				</a>
			</div> --}}
			<div class="flex flex-col gap-y-10 xlsm:max-w-[400px]">
				<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-white text-jobboard-deepblue rounded-xl p-6">
					<h2 class="font-bold text-[30px]">
						{{ __('You don\'t have any account yet') }} ?
					</h2>
					<div class="w-full mt-4">
						<a href="{{ route('register', ['role' => 'adoptant']) }}" class="w-fit flex max-sm:justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-cream hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream font-bold text-sm p-3 max-s:w-full">
							{{ __('I register') }}

							<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					</div>
				</div>

				<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-jobboard-violet text-jobboard-deepblue rounded-xl p-6">
					<h2 class="font-bold text-[30px]">
						{{ __('You are breeder') }} ?
					</h2>
					<p class="text-base font-medium hidden s:block">Portées, étalons ou adultes retraités, diffusez vos annonces !</p>
					<div class="w-full mt-4">
						<a href="{{ route('register', ['role' => 'eleveur']) }}" class="w-fit flex max-sm:justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-deepblue hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream hover:text-jobboard-cream font-bold text-sm p-3 max-s:w-full">
							{{ __('I register') }}

							<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					</div>
				</div>

				<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-jobboard-orange text-jobboard-deepblue rounded-xl p-6">
					<h2 class="font-bold text-[30px]">
						{{ __('You are professional') }} ?
					</h2>
					<p class="text-base font-medium hidden s:block">
						{{ __('Groomers, trainers, pet sitters, trainers, boarding, well-being...') }}
					</p>
					<div class="w-full mt-4">
						<a href="{{ route('register', ['role' => 'professionnel']) }}" class="w-fit flex max-sm:justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-deepblue hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream font-bold text-sm p-3 max-s:w-full">
							{{ __('I register') }}

							<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
