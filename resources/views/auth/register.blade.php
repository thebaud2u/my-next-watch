<x-app-layout>
	@push('seo')
		<title>Se créer un compte sur Eleveurs-online.com</title>

		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
	@endpush

	<div class="w-full bg-jobboard-cream">
		<div class="flex xlsm:flex-row flex-col max-xlsm:items-center gap-y-10 justify-between max-w-[1200px] flex-wrap xlsm:mx-auto mb-10">
			<div class="flex flex-col w-full md:w-[750px]">
				<div class="flex flex-col bg-white rounded-xl px-8 py-10 text-jobboard-deepblue">
					@switch($role)
						@case('eleveur')
							<h1 class="mb-1 text-2xl lg:text-[40px] font-bold text-jobboard-deepblue leading-none">
								{{ __('Register as a breeder') }}
							</h1>

							<p class="font-bold text-base mt-2">{{ __('Are you a dog or cat breeder or a stud dog owner?') }}</p>
							<p class="font-medium text-base">{{ __('Inscrivez vous gratuitement, rejoignez la communauté :') }}</p>

							@break
						@case('adoptant')
							<h1 class="mb-1 text-2xl lg:text-[40px] font-bold text-jobboard-deepblue leading-none">
								{{ __('Register as an adopter') }}
							</h1>

							<p class="font-bold text-base mt-2">{{ __('Vous êtes propriétaire de chiens ou chats ou vous souhaitez devenir propriétaire ?') }}</p>
							<p class="font-medium text-base">{{ __('Inscrivez vous gratuitement, rejoignez la communauté :') }}</p>

							@break
						@case('professionnel')
							<h1 class="mb-1 text-2xl lg:text-[40px] font-bold text-jobboard-deepblue leading-none">
								{{ __('Register as a professional') }}
							</h1>

							<p class="font-bold text-base mt-2">{{ __('Are you a groomer, pet sitter, salesperson, trainer, boarder, or wellness professional?') }}</p>
							<p class="font-medium text-base">{{ __('List your business in our product & service directory and be visible to the entire community:') }}</p>

							@break

						@default
							<h1 class="mb-1 text-2xl lg:text-[40px] font-bold text-jobboard-deepblue leading-none">
								{{ __('Register') }}
							</h1>

							<p class="font-bold text-base mt-2">{{ __('Vous êtes propriétaire de chiens ou chats ou vous souhaitez devenir propriétaire ?') }}</p>
							<p class="font-medium text-base">{{ __('Inscrivez vous gratuitement, rejoignez la communauté :') }}</p>
					@endswitch

					<div class="mt-8">
						<form method="POST" action="{{ route('register.store') }}">
							@csrf

							<input type="hidden" name="role" value="{{ $role }}">

							<div class="grid gap-x-20 gap-y-4 grid-cols-1 mt-5">
							@switch($role)
								@case('eleveur')
									<div class="flex items-center gap-x-2 font-medium text-sm">
										<input type="checkbox" name="check-role" id="check-role" checked class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">
										<label for="check-role">
											Je confirme m'inscrire en tant qu'éleveur professionnel ou particulier.
										</label>
									</div>

									@error('check-role')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror

									<div class="flex gap-x-8 gap-y-4 flex-wrap text-xs font-medium">
										<div>
											{{ __('You are professional') }} ? <a href="{{ route('register', ['role' => 'professionnel']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
										<div>
											{{ __('You are adopter') }} ? <a href="{{ route('register', ['role' => 'adoptant']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
									</div>
									@break
								@case('adoptant')
									<div class="flex items-center gap-x-2 font-medium text-sm">
										<input type="checkbox" name="check-role" id="check-role" checked class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">
										<label for="check-role">
											Je confirme m'inscrire en tant qu'adoptant ou propriétaire d'animaux.
										</label>
									</div>

									@error('check-role')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror

									<div class="flex gap-x-8 gap-y-4 flex-wrap text-xs font-medium">
										<div>
											{{ __('You are breeder') }} ? <a href="{{ route('register', ['role' => 'eleveur']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
										<div>
											{{ __('You are professional') }} ? <a href="{{ route('register', ['role' => 'professionnel']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
									</div>
									@break
								@case('professionnel')
									<div class="flex items-center gap-x-2 font-medium text-sm">
										<input type="checkbox" name="check-role" id="check-role" checked class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">
										<label for="check-role">
											Je confirme m'inscrire en tant que professionnel.
										</label>
									</div>

									@error('check-role')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror

									<div class="flex gap-x-8 gap-y-4 flex-wrap text-xs font-medium">
										<div>
											{{ __('You are breeder') }} ? <a href="{{ route('register', ['role' => 'eleveur']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
										<div>
											{{ __('You are adopter') }} ? <a href="{{ route('register', ['role' => 'adoptant']) }}" class="font-bold underline">Inscrivez-vous ici</a>
										</div>
									</div>
									@break
								@endswitch

								<hr class="w-full border border-jobboard-greige">

								<!-- Gender -->
								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="gender" :value="__('Gender')" :required="true" />
									</div>

									<div class="flex flex-row my-2">
										<div class="pr-5">
											<input type="radio" id="gender_mrs" name="gender" value="Mrs" {{ old('gender') === 'Mrs' ? 'checked' : '' }} class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
											<label for="gender_mrs" class="text-base inline-block">
												{{ __('Miss') }}
											</label>
										</div>

										<div class="pr-5">
											<input type="radio" id="gender_mr" name="gender" value="Mr" {{ old('gender') === 'Mr' ? 'checked' : '' }} class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
											<label for="gender_mr" class="text-base inline-block">
												{{ __('Mister') }}
											</label>
										</div>
									</div>

									@error('gender')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror
								</div>

								<!-- Firstname -->
								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="firstname" :value="__('Firstname')" :required="true" />
									</div>

									<x-front.text-input name="firstname" id="firstname" :value="old('firstname')" required placeholder="{{ __('Firstname') }}" :class="'mt-1 block bg-white w-full'" />

									@error('firstname')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror
								</div>

								<!-- Lastname -->
								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="lastname" :value="__('Lastname')" :required="true" />
									</div>

									<x-front.text-input name="lastname" id="lastname" :value="old('lastname')" required placeholder="{{ __('Lastname') }}" :class="'mt-1 block bg-white w-full'" />

									@error('lastname')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror
								</div>

								<!-- Email Address -->
								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="email" :value="__('Email')" :required="true" />
									</div>

									<x-front.text-input type="email" name="email" id="email" :value="old('email')" required placeholder="{{ __('Account\'s email address') }}" :class="'mt-1 block bg-white w-full'" />

									@error('email')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror
								</div>

								<!-- Password -->
								<div x-data="{
									password: '',
									isTyping: false,
									hasUppercase: false,
									hasLowercase: false,
									hasSpecialChar: false,
									hasNumber: false,
									hasValidLength: false,
									validatePassword() {
										this.isTyping = this.password.length > 0;
										if (this.isTyping) {
											this.hasUppercase = /[A-Z]/.test(this.password);
											this.hasLowercase = /[a-z]/.test(this.password);
											this.hasSpecialChar = /[!@#$%^&*(),.?]/.test(this.password);
											this.hasNumber = /[0-9]/.test(this.password);
											this.hasValidLength = this.password.length >= 8 && this.password.length <= 16;
										} else {
											this.hasUppercase = false;
											this.hasLowercase = false;
											this.hasSpecialChar = false;
											this.hasNumber = false;
											this.hasValidLength = false;
										}
									}
								}" @input.debounce="validatePassword()">
									<div>
										<div class="flex flex-row pl-4">
											<x-front.input-label for="password" :value="__('Password')" :required="true" />
										</div>

										<x-front.text-input type="password" name="password" id="password" required placeholder="{{ __('Account\'s password') }}" :class="'mt-1 block bg-white w-full'" x-model="password" />

										@error('password')
											<span class="error text-danger-700 text-sm">
												{{ $message }}
											</span>
										@enderror
									</div>

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

								<!-- Confirmation password -->
								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="password_confirmation" :value="__('Confirm password')" :required="true" />
									</div>

									<x-front.text-input type="password" name="password_confirmation" id="password_confirmation" required placeholder="{{ __('Confirm password') }}" :class="'mt-1 block bg-white w-full'" />

									@error('password_confirmation')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row pl-4">
										<x-front.input-label for="country" :value="__('Country')" :required="true" />
									</div>

									<div class="flex flex-row my-2">
										<div class="pr-5">
											<input type="radio" id="country_fr" name="country" value="FR" {{ old('country') === 'FR' ? 'checked' : '' }} class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
											<label for="country_fr" class="text-base inline-block">
												{{ __('France') }}
											</label>
										</div>

										<div class="pr-5">
											<input type="radio" id="country_be" name="country" value="BE" {{ old('country') === 'BE' ? 'checked' : '' }} class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
											<label for="country_be" class="text-base inline-block">
												{{ __('Belgium') }}
											</label>
										</div>
									</div>

									@error('country')
										<span class="error text-danger-700 text-sm">
											{{ $message }}
										</span>
									@enderror
								</div>

								<hr class="bg-jobboard-greige border-0 my-6 h-[2px] w-full">

								{{-- CGU --}}
								<label class="flex flex-row items-center gap-x-2 cursor-pointer font-medium text-sm" for="cgu">
									<input type="checkbox" name="cgu" id="cgu" class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">
									{{ __('I accept the general conditions of use of the site.') }}
									<span class="text-jobboard-violet">*</span>
								</label>

								@error('cgu')
									<span class="error text-danger-700 text-sm">
										{{ $message }}
									</span>
								@enderror

								<!-- Opt in -->
								<h3 class="font-bold text-jobboard-deepblue">
									{{ __('Newsletter inscription') }}
								</h3>

								<x-front.input-label for="optin_newsletter" :class="'cursor-pointer'">
									<input type="checkbox" name="optin_newsletter" id="optin_newsletter" @checked(is_null(old('optin_newsletter')) ? true : old('optin_newsletter')) class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">

									{{ __('I subscribe to the monthly newsletter of :siteName', ['siteName' => env('APP_NAME')]) }}
								</x-front.input-label>

								<x-front.input-label for="optin_receive_info" :class="'cursor-pointer'">
									<input type="checkbox" name="optin_receive_info" id="optin_receive_info" @checked(is_null(old('optin_receive_info')) ? true : old('optin_receive_info')) class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">

									{{ __('I would like to receive information from :siteName and their publishers', ['siteName' => env('APP_NAME')]) }}
								</x-front.input-label>

								<x-front.input-label for="optin_receive_deals" :class="'cursor-pointer'">
									<input type="checkbox" name="optin_receive_deals" id="optin_receive_deals" @checked(is_null(old('optin_receive_deals')) ? true : old('optin_receive_deals')) class="rounded border-jobboard-deepblue text-jobboard-deepblue focus:ring-jobboard-deepblue">

									{{ __('I would like to receive good deals from :siteName partners' ['siteName' => env('APP_NAME')]) }}
								</x-front.input-label>
							</div>

							<div class="flex flex-col items-center gap-y-3 mt-6 w-full">
								<x-front.primary-button :class="'w-full justify-center'">
									{{ __('I register') }}

									<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</x-front.primary-button>

								<a href="{{ route('login') }}" class="underline text-sm text-jobboard-deepblue hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
									{{ __('Already registered') }} ?
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="flex flex-col gap-y-10 mb-10 px-4">
				@if($role != 'adoptant')
					<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-white text-jobboard-deepblue rounded-xl p-6">
						<h3 class= "font-bold text-[28px]">
							{{ __('You are adopter') }} ?
						</h3>

						<p class="text-base font-medium mt-2">
							{{ __('Do you own dogs or cats or do you want to become one?') }}
						</p>

						<div class="w-full mt-4 flex justify-center">
							<a href="{{ route('register', ['role' => 'adoptant']) }}" class="w-fit flex justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-cream hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream text-sm p-3 max-s:w-full font-bold">
								{{ __('I register') }}

								<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
					</div>
				@endif

				@if($role != 'eleveur')
					<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-jobboard-violet text-jobboard-deepblue rounded-xl p-6">
						<h3 class="font-bold text-[28px]">
							{{ __('You are breeder') }} ?
						</h3>

						<p class="text-base font-medium mt-2">
							Portées, étalons ou adultes retraités, diffusez vos annonces !
						</p>

						<div class="w-full mt-4 flex justify-center">
							<a href="{{ route('register', ['role' => 'eleveur']) }}" class="w-fit flex justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-deepblue hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream hover:text-jobboard-cream text-sm p-3 max-s:w-full font-bold">
								{{ __('I register') }}

								<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
					</div>
				@endif

				@if($role != 'professionnel')
					<div class="flex flex-col justify-between w-full md:w-[750px] xlsm:w-[400px] bg-jobboard-orange text-jobboard-deepblue rounded-xl p-6">
						<h3 class= "font-bold text-[28px]">
							{{ __('You are professional') }} ?
						</h3>

						<p class="text-base font-medium mt-2">
							{{ __('Groomers, trainers, pet sitters, trainers, boarding, well-being...') }}
						</p>

						<div class="w-full mt-4 flex justify-center">
							<a href="{{ route('register', ['role' => 'professionnel']) }}" class="w-fit flex justify-center items-center gap-x-2 bg-jobboard-deepblue hover:bg-jobboard-deepbluehover border border-jobboard-deepblue hover:border-jobboard-deepbluehover rounded-full text-jobboard-cream text-sm p-3 max-s:w-full font-bold">
								{{ __('I register') }}

								<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.36231 1.5L7.81685 6.5L2.3623 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div class="w-full bg-jobboard-orange px-2 py-8">
		<div class="flex flex-col items-center">
			<h3 class="text-jobboard-deepblue font-semibold text-center text-[25px] md:text-[28px] mb-8">
				{{ __('Be part of our community') }}
			</h3>

			<div class="flex flex-row justify-center flex-wrap gap-x-10 gap-y-8">
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4 w-[282px]">
					<svg class="w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z" stroke="currentColor" stroke-width="2" />
						<path d="M33.637 44.7499L40.5467 29C41.9211 29 43.2392 29.5531 44.2111 30.5377C45.1829 31.5222 45.7289 32.8576 45.7289 34.25V41.2499H55.5061C56.0068 41.2442 56.5029 41.3488 56.9598 41.5566C57.4167 41.7643 57.8236 42.0702 58.1522 42.4531C58.4808 42.8359 58.7234 43.2866 58.863 43.7738C59.0026 44.2611 59.036 44.7733 58.9609 45.2749L56.5771 61.0248C56.4521 61.8594 56.0337 62.6201 55.3988 63.1668C54.7639 63.7135 53.9554 64.0093 53.1222 63.9998H33.637M33.637 44.7499V63.9998M33.637 44.7499H28.4548C27.5385 44.7499 26.6598 45.1186 26.0119 45.775C25.364 46.4314 25 47.3216 25 48.2499V60.4998C25 61.4281 25.364 62.3183 26.0119 62.9747C26.6598 63.631 27.5385 63.9998 28.4548 63.9998H33.637" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[255px]">
							<strong>Identité & SIRET</strong> vérifiés des éleveurs
						</p>
					</div>
				</div>

				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4 w-[282px]">
					<svg class="w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z" stroke="currentColor" stroke-width="2" />
						<path d="M37.9559 59.9036C37.9559 62.1628 39.7765 64 42.0153 64C44.2542 64 46.0748 62.1628 46.0748 59.9036M55.7802 57.6692L53.9473 54.9755C52.8279 53.337 52.2251 51.3881 52.2251 49.3896V45.1442C52.2251 40.4023 49.0514 36.4053 44.7336 35.2012V32.7558C44.7336 31.2289 43.5157 30 42.0026 30C40.4896 30 39.2717 31.2289 39.2717 32.7558V35.2012C34.9539 36.4053 31.7802 40.4023 31.7802 45.1442V49.3896C31.7802 51.3881 31.1774 53.337 30.058 54.9755L28.2251 57.6692C27.6469 58.5133 28.2497 59.6678 29.2707 59.6678H54.7346C55.7556 59.6678 56.3461 58.5133 55.7802 57.6692Z" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[255px]">
							<strong>Numéro de portée LOF/LOOF</strong> vérifié
						</p>
					</div>
				</div>

				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4 w-[282px]">
					<svg class="w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z" stroke="currentColor" stroke-width="2" />
						<path d="M35.3917 49.628H32.3946L26.472 55.3594H25.7295V49.6305H23.9228C22.8796 49.6272 21.8803 49.2097 21.1447 48.4697C20.4091 47.7297 19.9974 46.7277 20 45.6842V32.9464C19.9987 32.4294 20.0992 31.9173 20.2958 31.4392C20.4923 30.9611 20.7811 30.5264 21.1456 30.16C21.5101 29.7935 21.9432 29.5025 22.4201 29.3034C22.8971 29.1044 23.4085 29.0013 23.9253 29H40.7896C41.8328 29.0033 42.8321 29.4208 43.5677 30.1608C44.3033 30.9009 44.715 31.9028 44.7124 32.9464V35.7365M50.6029 59.2711H42.2178C41.7002 59.2708 41.1877 59.1683 40.7098 58.9696C40.2318 58.7708 39.7978 58.4797 39.4324 58.1129C39.0671 57.7461 38.7777 57.3108 38.5809 56.8319C38.384 56.353 38.2835 55.84 38.2851 55.3222V42.5869C38.2838 42.07 38.3843 41.5579 38.5809 41.0798C38.7774 40.6017 39.0662 40.167 39.4307 39.8005C39.7952 39.4341 40.2283 39.143 40.7052 38.944C41.1822 38.745 41.6936 38.6419 42.2104 38.6406H59.0747C59.5915 38.6419 60.1029 38.745 60.5799 38.944C61.0568 39.143 61.4899 39.4341 61.8544 39.8005C62.2189 40.167 62.5077 40.6017 62.7042 41.0798C62.9008 41.5579 63.0013 42.07 63 42.5869V55.3222C63.0016 55.8394 62.9013 56.3518 62.7049 56.8302C62.5085 57.3086 62.2198 57.7435 61.8553 58.1103C61.4907 58.477 61.0576 58.7682 60.5805 58.9674C60.1033 59.1666 59.5917 59.2698 59.0747 59.2711H57.2581V65H56.5156L50.6029 59.2711Z" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linejoin="round" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[255px]">
							<strong>Numéros de puces iCad</strong> vérifié
						</p>
					</div>
				</div>

				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4 w-[282px]">
					<svg class="w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z" stroke="currentColor" stroke-width="2" />
						<path d="M52.7059 31.3043H56V66H28V31.3043H31.2941M34.5882 42.8696H49.4118M34.5882 51.1304H49.4118M37.8824 28H46.1176C47.9294 28 49.4118 29.487 49.4118 31.3043V34.6087H34.5882V31.3043C34.5882 29.487 36.0706 28 37.8824 28Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[255px]">
							<strong>Certificat de formation</strong> vérifié
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>

