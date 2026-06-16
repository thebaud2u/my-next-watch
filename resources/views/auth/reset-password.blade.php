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
				{{ __('Password reset') }}
			</x-front.form-part-title>

			<div class="mt-10" style="padding:0 0 0 40px;">
				<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
					<form method="POST" action="{{ route('password.store') }}" x-data="{
						newPassword: '',
						isTyping: false,
						hasUppercase: false,
						hasLowercase: false,
						hasSpecialChar: false,
						hasNumber: false,
						hasValidLength: false,
						confirmPassword: '',
						isTypingConfirmPassword: false,
						isSame: false,
						validatePassword() {
							this.isTyping = this.newPassword.length > 0;
							if (this.isTyping) {
								this.hasUppercase = /[A-Z]/.test(this.newPassword);
								this.hasLowercase = /[a-z]/.test(this.newPassword);
								this.hasSpecialChar = /[!@#$%^&*(),.?]/.test(this.newPassword);
								this.hasNumber = /[0-9]/.test(this.newPassword);
								this.hasValidLength = this.newPassword.length >= 8 && this.newPassword.length <= 16;
							} else {
								this.hasUppercase = false;
								this.hasLowercase = false;
								this.hasSpecialChar = false;
								this.hasNumber = false;
								this.hasValidLength = false;
							}
						},
						confirmationPassword() {
							this.isTypingConfirmPassword = this.confirmPassword.length > 0;
							if (this.isTypingConfirmPassword) {
								this.isSame = this.newPassword === this.confirmPassword;
							} else {
								this.isSame = false;
							}
						}
					}">
						@csrf

						<!-- Password Reset Token -->
						<input type="hidden" name="token" value="{{ $request->route('token') }}">

						<!-- Email Address -->
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="email" :value="__('Email')" :required="true" />
							</div>

							<x-front.text-input type="email" name="email" id="email" :value="old('email', $request->email)" required placeholder="{{ __('Email address of your account') }}" :class="'mt-1 block bg-white w-full'" />

							@error('email')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<!-- Password -->
						<div @input.debounce="validatePassword()">
							<div class="flex flex-row">
								<x-front.input-label for="password" :value="__('Password')" :required="true" />
							</div>

							<x-front.text-input type="password" name="password" id="password" :value="old('password')" required placeholder="{{ __('Account\'s password') }}" :class="'mt-1 block bg-white w-full'" x-model="newPassword" />

							@error('password')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<div class="pl-4 mt-2">
								<div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && hasUppercase, 'text-red-500': isTyping && !hasUppercase }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="hasUppercase || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !hasUppercase">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('1 uppercase') }}
									</div>
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && hasLowercase, 'text-red-500': isTyping && !hasLowercase }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="hasLowercase || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !hasLowercase">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('1 lowercase') }}
									</div>
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && hasSpecialChar, 'text-red-500': isTyping && !hasSpecialChar }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="hasSpecialChar || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !hasSpecialChar">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('1 special character') }}
									</div>
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && hasNumber, 'text-red-500': isTyping && !hasNumber }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="hasNumber || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !hasNumber">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('1 digit') }}
									</div>
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && hasValidLength, 'text-red-500': isTyping && !hasValidLength }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="hasValidLength || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !hasValidLength">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('Between 8 to 16 character') }}
									</div>
								</div>
							</div>
						</div>

						<!-- Confirm Password -->
						<div @input.debounce="confirmationPassword()">
							<div class="flex flex-row">
								<x-front.input-label for="password_confirmation" :value="__('Confirm password')" :required="true" />
							</div>

							<x-front.text-input type="password" name="password_confirmation" id="password_confirmation" :value="old('password_confirmation')" required placeholder="{{ __('Confirm password') }}" :class="'mt-1 block bg-white w-full'" x-model="confirmPassword" />

							@error('password_confirmation')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<div class="pl-4 mt-2">
								<div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-jobboard-deepblue': !isTyping, 'text-green-500': isTyping && isSame, 'text-red-500': isTyping && !isSame }">
										<svg class="shrink-0" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isSame || !isTyping">
											<path d="M4.81818 6.82728L6.06726 8.13636L9.18182 4.86364M13 6.5C13 9.81371 10.3137 12.5 7 12.5C3.68629 12.5 1 9.81371 1 6.5C1 3.18629 3.68629 0.5 7 0.5C10.3137 0.5 13 3.18629 13 6.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<svg class="shrink-0" width="14" height="13" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="isTyping && !isSame">
											<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 17.7352L18.0227 9.68979" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9.97729 9.68979L18.0227 17.7352" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('Password confirmed') }}
									</div>
								</div>
							</div>
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
	</div>
</x-app-layout>

