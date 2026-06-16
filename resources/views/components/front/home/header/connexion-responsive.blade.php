<div class="flex flex-col
@if(Route::is('home.breeder') || Route::is('home.pro'))
	bg-jobboard-deepblue text-jobboard-cream @else bg-jobboard-cream text-jobboard-deepblue @endif h-screen overflow-y-auto overscroll-contain">
	<form method="POST" action="{{ route('login') }}">
		@csrf
		<!-- Email Address -->
		<div>
			<div class="flex flex-row pl-4">
				<x-front.input-label for="email" :value="__('Email')" :required="true" :class="(Route::is('home.breeder') || Route::is('home.pro')) ? '!text-jobboard-cream' : ''" />
			</div>

			<x-front.text-input name="email" id="email" value="{{ old('email') }}" required
				placeholder="{{ __('Email') }}" :class="'mt-1 block bg-white w-full rounded-xl'" />

			@error('email')
				<span class="error text-danger-700">
					{{ $message }}
				</span>
			@enderror
		</div>

		<!-- Password -->
		<div class="mt-2">
			<div class="flex flex-row pl-4">
				<x-front.input-label for="password" :value="__('Password')" :required="true" :class="(Route::is('home.breeder') || Route::is('home.pro')) ? '!text-jobboard-cream' : ''" />
			</div>

			<x-front.text-input type="password" name="password" id="password" required
				placeholder="{{ __('Your password') }}" :class="'mt-1 block bg-white w-full rounded-xl'" />

			@error('password')
				<span class="error text-danger-700">
					{{ $message }}
				</span>
			@enderror
		</div>

		<!-- Remember Me -->
		<div class="mt-2">
			<label for="remember_me" class="inline-flex items-center">
				<input id="remember_me" type="checkbox"
					class="rounded @if(Route::is('home.breeder') || Route::is('home.pro')) border-jobboard-cream text-jobboard-cream @else border-jobboard-deepblue text-jobboard-deepblue @endif focus:ring-transparent bg-transparent"
					name="remember">
				<span class="ms-2 font-medium text-sm">{{ __('Remember me') }}</span>
			</label>
		</div>

		<div class="flex flex-col justify-center mt-4 w-full gap-2">
			<div class="w-full">
				<x-front.primary-button :class="((Route::is('home.breeder') || Route::is('home.pro')) ? '!bg-jobboard-cream !text-jobboard-deepblue ' : '') . 'w-full justify-center gap-2'">
					{{ __('Log in') }}
				</x-front.primary-button>
			</div>

			@if(Route::has('password.request'))
				<a href="{{ route('password.request') }}"
					class="text-sm font-bold flex items-center justify-center gap-x-2">
					{{ __('Forgot your password') }}

					<svg width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.4917 1L5.85534 5L1.4917 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
			@endif
		</div>
	</form>

	<hr class="my-4">

	<div class="flex flex-col items-center w-full gap-3">
		<div class="font-medium text-base w-full text-center">
			{{ __('You don\'t have any account yet') }}
		</div>

		<x-front.primary-button :class="((Route::is('home.breeder') || Route::is('home.pro')) ? '!bg-jobboard-cream !text-jobboard-deepblue ' : '') . 'w-full justify-center'" x-on:click="window.location.href='{{ route('register') }}'">
			{{ __('Register') }}
		</x-front.primary-button>
	</div>

	<hr class="my-4">

	<x-front.header.header-button x-on:click="window.location.href='{{ route('home.breeder') }}'">
			{{ __('Breeders space') }}
		</x-front.header.header-button>

	<hr class="my-4">

	<x-front.header.picto-link :href="route('newsletter.index')" :textColor="Route::is('home.breeder') || Route::is('home.pro') ? 'text-jobboard-cream' : 'text-jobboard-deepblue'" :class="'!flex !flex-row !justify-center !items-center !gap-2'">
		<svg class="w-[28px] h-[27px] @if(request()->is('professionnels*')) text-jobboard-orange @elseif(request()->is('eleveurs*')) text-jobboard-violet @else text-jobboard-deepblue @endif" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.1115 13.3943C7.91089 16.6041 6.51764 4.80311 13.6001 3.75452C14.3363 3.64552 15.0939 3.67769 15.7977 3.92032C18.1734 4.73928 19.3093 7.38448 18.0825 9.92734C17.9238 10.2563 17.7156 10.5608 17.4438 10.8045C16.2814 11.8476 15.1687 11.1278 15.4578 9.58309L15.9756 6.50644C14.2045 5.65829 11.9585 6.86933 12.052 10.0569C12.0617 10.3869 12.1788 10.7132 12.4105 10.948C13.2397 11.7884 14.7962 11.1387 15.508 9.2842M22.9268 6.94514L26.9663 10.1306M26.9663 10.1306V26H1.03381V10.1306M26.9663 10.1306L16.9643 18.2684M1.03381 10.1306L5.0733 6.94514M1.03381 10.1306L11.0356 18.2684M26.8678 25.7674L14 16.3293L1.17074 25.7347M22.9268 13.4321V0.999989H5.07331V13.3592" stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" />
		</svg>

		{{ __('Newsletter') }}
	</x-front.header.picto-link>
</div>