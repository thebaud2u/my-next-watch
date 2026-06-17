<x-app-layout>
	@push('seo')
		<title>{{ env('APP_NAME') }}</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<x-front.form-part-title>
				{{ __('Forgot my password') }}
			</x-front.form-part-title>

			<div class="mb-4 text-sm text-mnw-deepblue">
				{{ __('Forgot your password ? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one') }}.
			</div>

			<!-- Session Status -->
			<x-auth.auth-session-status class="mb-4" :status="session('status')" />

			<div class="mt-10" style="padding:0 0 0 40px;">
				<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
					<form method="POST" action="{{ route('password.email') }}">
						@csrf

						<!-- Email Address -->
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="email" :value="__('Email')" :required="true" />
							</div>

							<x-front.text-input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="{{ __('Account\'s email address') }}" :class="'mt-1 block bg-white w-full'" />

							@error('email')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="flex items-center justify-end mt-4">
							<x-front.primary-button :class="'ml-4'">
								{{ __('Reset my password') }}
							</x-front.primary-button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>


