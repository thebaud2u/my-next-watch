<x-app-layout>
	@push('seo')
		<title>{{ env('APP_NAME') }}</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<div class="mb-4 text-sm text-jobboard-deepblue">
				{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
			</div>

			@if(session('status') == 'verification-link-sent')
				<div class="mb-4 font-medium text-sm text-green-600">
					{{ __('A new verification link has been sent to the email address you provided during registration.') }}
				</div>
			@endif

			<div class="mt-4 flex items-center justify-between">
				<form method="POST" action="{{ route('verification.send') }}">
					@csrf

					<div>
						<x-front.primary-button :class="'ml-4'">
							{{ __('Resend Verification Email') }}
						</x-front.primary-button>
					</div>
				</form>

				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<button type="submit" class="underline text-sm text-jobboard-deepblue hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						{{ __('Log Out') }}
					</button>
				</form>
			</div>
		</div>
	</div>
</x-app-layout>


