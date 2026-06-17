<x-space-layout>
	@push('seo')
		<title>{{ __('My space') }}</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, ', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<x-slot name="side_menu">
		@include('components.front.space.profile.side-menu')
	</x-slot>

	<div class="flex-1">
		<div class="w-full p-6 border border-mnw-greige rounded-md mt-8 mb-6">
			<x-front.space-title>
				{{ __('Change password') }}
			</x-front.space-title>

			<div class="mt-10" style="padding:0 0 0 40px;">
				<form method="POST" action="{{ route('space.profile.settings.update-password') }}">
					@csrf

					<div class="grid gap-x-20 gap-y-4 grid-cols-1 mt-5" x-data="{
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
						<!-- Current password -->
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="current_password" :value="__('Current password')" :required="true" :class="'pl-4'"/>
							</div>

							<x-front.text-input type="password" name="current_password" id="current_password" required placeholder="{{ __('Current password of your account') }}" :class="'mt-1 block bg-white w-full'" />

							@error('current_password')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<!-- New password -->
						<div @input.debounce="validatePassword()">
							<div class="flex flex-row">
								<x-front.input-label for="new_password" :value="__('New password')" :required="true" :class="'pl-4'"/>
							</div>

							<x-front.text-input type="password" name="new_password" id="new_password" :value="old('new_password')" required placeholder="{{ __('New password of your account') }}" :class="'mt-1 block bg-white w-full'" x-model="newPassword" />

							@error('new_password')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<div class="pl-4 mt-2">
								<div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && hasUppercase, 'text-red-500': isTyping && !hasUppercase }">
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
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && hasLowercase, 'text-red-500': isTyping && !hasLowercase }">
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
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && hasSpecialChar, 'text-red-500': isTyping && !hasSpecialChar }">
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
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && hasNumber, 'text-red-500': isTyping && !hasNumber }">
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
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && hasValidLength, 'text-red-500': isTyping && !hasValidLength }">
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

						<!-- Confirm new password -->
						<div @input.debounce="confirmationPassword()">
							<div class="flex flex-row">
								<x-front.input-label for="new_password_confirmation" :value="__('New password confirmation')" :required="true" :class="'pl-4'"/>
							</div>

							<x-front.text-input type="password" name="new_password_confirmation" id="new_password_confirmation" :value="old('new_password_confirmation')" required placeholder="{{ __('New password confirmation') }}" :class="'mt-1 block bg-white w-full'" x-model="confirmPassword" />

							@error('new_password_confirmation')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<div class="pl-4 mt-2">
								<div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
									<div class="flex items-center gap-x-2 text-sm font-medium w-fit" :class="{ 'text-mnw-deepblue': !isTyping, 'text-green-500': isTyping && isSame, 'text-red-500': isTyping && !isSame }">
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
					</div>

					<div class="flex items-center justify-end mt-4">
						<x-front.primary-button :class="'ml-4'">
							{{ __('Change my password') }}
						</x-front.primary-button>
					</div>
				</form>
			</div>
		</div>
	</div>
</x-space-layout>
