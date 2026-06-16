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
				{{ __('Confirm password') }}
			</x-front.form-part-title>

			<div class="mb-4 text-sm text-jobboard-deepblue">
				{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
			</div>

			<div class="mt-10" style="padding:0 0 0 40px;">
				<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
					<form method="POST" action="{{ route('password.confirm') }}">
						@csrf

						<!-- Password -->
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="password" :value="__('Password')" :required="true" />
							</div>

							<x-front.text-input type="password" name="password" id="password" :value="old('Password')" required placeholder="{{ __('Password of your account') }}" :class="'mt-1 block bg-white w-full'" />

							@error('password')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="flex justify-end mt-4">
							<x-front.primary-button :class="'ml-4'">
								{{ __('Confirm') }}
							</x-front.primary-button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>

