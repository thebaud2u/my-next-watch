<div>
	<div class="flex flex-col py-5 px-4 lg:px-6">
		<a href="{{ route('space.posts.change-offer', ['post' => $post]) }}" title="{{ __('Edit this post') }}" class="flex justify-end">
			<x-front.secondary-button>
				{{ __('Edit offer type') }}
			</x-front.secondary-button>
		</a>

		<div class="mt-4">
			<div id="anchor" class="relative overflow-hidden w-fit mx-auto flex flex-row font-semibold">
				<div class="absolute top-4 w-full border-t-2 border-opacity-50 border-annonces-blue"></div>
				@foreach($steps as $k => $step)
					<div class="flex-none order-1 z-10 w-8 h-8 {{ ($k > 0) ? 'ml-6' : '' }}">
						@if(($k + 1) == $active)
							<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-annonces-lightblue border-annonces-blue text-annonces-blue">{{ $k + 1 }}</span>
						@elseif(($k + 1) > $active)
							<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-gray-200 border-white text-gray-400">{{ $k + 1 }}</span>
						@else
							<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-annonces-blue border-white text-white" wire:click="goto({{ $k + 1 }})">{{ $k + 1 }}</button>
						@endif
					</div>
				@endforeach
			</div>
		</div>

		<div wire:key="error">
			{{-- Flash message --}}
			@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
				<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
					@include('components.front.home.alert-message')
				</div>
			@endif
		</div>

		@if($active == 1)
			<div>
				<div class="mt-6">
					<x-front.form-part-title>
						{{ __('Your web post') }}
					</x-front.form-part-title>

					<div wire:key="component-{{ $post->thematic->slug }}">
						@include('components.front.space.posts.'.$post->thematic->slug.'-form')
					</div>

					<div class="mt-10" style="padding:0 0 0 40px;">
						<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
							<div>
								<div class="flex flex-row">
									<x-front.input-label for="post.values_web.contact_last_name" :value="__('Lastname of the advertiser')" :required="true" />
								</div>

								<x-front.text-input name="post.values_web.contact_last_name" wire:model="post.values_web.contact_last_name" placeholder="{{ __('Lastname of the advertiser') }}" :class="'mt-1 block bg-white w-full'" />

								@error('post.values_web.contact_last_name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<div class="flex flex-row">
									<x-front.input-label for="post.values_web.contact_first_name" :value="__('Firstname of the advertiser')" :required="true" />
								</div>

								<x-front.text-input name="post.values_web.contact_first_name" wire:model="post.values_web.contact_first_name" placeholder="{{ __('Firstname of the advertiser') }}" :class="'mt-1 block bg-white w-full'" />

								@error('post.values_web.contact_first_name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<div class="flex flex-row">
									<x-front.input-label for="post.values_web.contact_email" :value="__('Notification email')" :required="true" />
								</div>

								<x-front.text-input type="email" name="post.values_web.contact_email" wire:model="post.values_web.contact_email" placeholder="{{ __('Notification email') }}" :class="'mt-1 block bg-white w-full'" />

								@error('post.values_web.contact_email')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<div class="flex flex-row">
									<x-front.input-label for="post.values_web.contact_telephone" :value="__('Phone number')" :required="true" />
								</div>

								<x-front.text-input type="tel" name="post.values_web.contact_telephone" wire:model="post.values_web.contact_telephone" placeholder="{{ __('Phone number') }}" :class="'mt-1 block bg-white w-full'" />

								@error('post.values_web.contact_telephone')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror

								<div class="mt-2">
									<input type="checkbox" name="post.values_web.display_phone_number" value="on" wire:model="post.values_web.display_phone_number" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<x-front.input-label for="post.values_web.display_phone_number" :value="__('Display the phone number')" :class="'ml-2 inline-block font-normal'"/>
								</div>
							</div>

							<div class="flex justify-end sm:mt-0 mt-4">
								<a href="#anchor">
									<x-front.primary-button :class="'ml-4'" wire:click="submitWebStep">
										{{ __('Continue') }}
									</x-front.primary-button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@elseif($active == 2)
			<div>
				<div class="mt-6">
					<h1 class="mb-1 text-base lg:text-xl font-semibold leading-6">
						@if($post->state->color() == 'blue')
							@if($dateParution['status'] == 'Success')
								<b>{{ __(':x month', ['x' => 1]) }}</b> {{ __('print publication from') }} <span class="text-annonces-blue font-bold">{{ $dateParution['value'] }}</span>
							@elseif($dateParution['status'] == 'Error')
								{{ $dateParution['value'] }}</h1>
							@endif
						@elseif($post->state->color() == 'green')
							<b>{{ __(':x month', ['x' => 1]) }}</b> {{ __('print publication from') }} <span class="text-annonces-blue font-bold">{{ $dateParution }}</span>
						@endif
					</h1>
				</div>

				<div class="mt-6">
					<x-front.form-part-title>
						{{ __('Your post\'s content (format :format column)', ['format' => $post->offer->hasOption('column.1/4')?'1/4':($post->offer->hasOption('column.1/2')?'1/2':'1')]) }}
					</x-front.form-part-title>

					<div style="padding:0 40px 0 40px;">
						<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
							<div x-data="{
								maxCaracters: {{ $maxCaractersTitrePrint }},
								caractersLeft: 0,
								countCaractersLeft:function() {
									caractersLeft = 0;
									this.caractersLeft = this.maxCaracters - ($refs.titleLength.value.length + {{ strlen($post->user->type == 'Professionnel'?$post->user->values['company_name']:$post->user->name) }});

									if(this.caractersLeft <= 0) {
										$refs.titleLength.value = $refs.titleLength.value.substring(0, ($refs.titleLength.value.length + (this.caractersLeft)));

										this.caractersLeft = this.maxCaracters - ($refs.titleLength.value.length + {{ strlen($post->user->type == 'Professionnel'?$post->user->values['company_name']:$post->user->name) }});
									}
								}}" x-init="$nextTick(() => { countCaractersLeft() })">
								<div class="flex flex-row">
									<x-front.input-label for="title" :value="__('Post title')" :required="true" />
								</div>

								<div class="flex flex-row items-center">
									<x-front.text-input x-ref="titleLength" x-on:keyup="countCaractersLeft()" wire:change="refresh" wire:model="post.values_print.title" placeholder="{{ __('Post title') }}" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="mt-1 w-full block text-gray-400 bg-white" />
								</div>

								<div class="text-right">
									<span class="text-sm text-gray pull-right">
										<span x-html="caractersLeft"></span> {{ __('caracters left') }}
									</span>
								</div>

								@error('post.values_print.title')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<div class="flex flex-row">
									<x-front.input-label :value="__('Place')" />
								</div>

								<div class="flex flex-row items-center">
									@php
										if($post->address->city || $post->address->custom_city) {
											$city = $post->address->city ? $post->address->city->name : $post->address->custom_city;

											$location = $city.' ('.$post->address->city->zip_code.'), '.$post->address->country->name;
										}
										elseif($post->address->department) $location = $post->address->department->name.' ('.$post->address->department->code.')';
										elseif($post->address->region) $location = $post->address->region->name;
										elseif($post->address->country) $location = $post->address->country->name;
										else $location = __('Unknown location');
									@endphp
									{{ $location }}
								</div>
							</div>

							{{--
								@if($post->offer->hasOption('column.1/2') || $post->offer->hasOption('column.1'))
									<div x-data="{
										maxCaracters: 30,
										caractersLeft: 0,
										countCaractersLeft:function() {
											caractersLeft = 0;
											this.caractersLeft = this.maxCaracters - $refs.remunerationLength.value.length;

											if(this.caractersLeft <= 0) {
												$refs.remunerationLength.value = $refs.remunerationLength.value.substring(0, ($refs.remunerationLength.value.length + (this.caractersLeft)));

												this.caractersLeft = this.maxCaracters - $refs.remunerationLength.value.length;
											}
										}}" x-init="$nextTick(() => { countCaractersLeft() })">
										<div class="flex flex-row">
											<x-front.input-label for="remuneration" :value="__('Remuneration')" />
										</div>

										<div class="flex flex-row items-center">
											<x-front.text-input type="text" name="remuneration" x-ref="remunerationLength" x-on:keyup="countCaractersLeft()" wire:model="post.values_print.remuneration" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="mt-1 w-full block text-gray-400 bg-white" />
										</div>

										@error('post.values_web.remuneration')
											<span class="error text-danger-700">
												{{ $message }}
											</span>
										@enderror

										<div class="text-right">
											<span class="text-sm text-gray pull-right">
												<span x-html="caractersLeft"></span> {{ __('caracters left') }}
											</span>
										</div>
									</div>
								@endif
							--}}

							<div class="p-12 rounded-md bg-[#F8F8F8]" x-data="{
								maxCaracters: {{ $maxCaractersTextPrint }},
								caractersLeft: 0,
								countCaractersLeft:function(lastInputTyped) {
									caractersLeft = 0;
									this.caractersLeft = this.maxCaracters -
									(
										@if($post->offer->hasOption('column.1/4'))
											$refs.bodyLength.value.length
										@elseif($post->offer->hasOption('column.1/2'))
											$refs.bodyLength.value.length //+ $refs.wantedProfileLength.value.length
										@elseif($post->offer->hasOption('column.1'))
											$refs.bodyLength.value.length //+ $refs.bonusesLength.value.length + $refs.experiencesLength.value.length + $refs.skillsLength.value.length + $refs.wantedProfileLength.value.length
										@endif
									);
								}}" x-init="$nextTick(() => { countCaractersLeft('') })" x-bind:class="caractersLeft < 0 ? 'border-danger-700 border-2' : ''">
								<div class="flex justify-between">
									<x-front.form-part-title class="text-black">
										{{ __('Your post\'s details') }}
									</x-front.form-part-title>

									<div class="text-right">
										<span class="text-sm pull-right" x-bind:class="caractersLeft < 0 ? 'text-danger-500' : 'text-gray'">
											<span x-html="caractersLeft"></span> {{ __('caracters left') }}
										</span>
									</div>
								</div>

								<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
									<div>
										<div class="flex flex-row">
											<x-front.input-label :value="__('Post description')" />
										</div>

										<div class="flex flex-row items-center">
											<textarea name="body" x-ref="bodyLength" x-on:keyup="countCaractersLeft('bodyLength')" wire:model="post.values_print.body" cols="30" rows="6" placeholder="{{ __('Post description') }}" disabled="{{ !Auth::guard('admin')->check() && $post->state->color() == 'green' }}" class="border-gray-300 w-full focus:border-annonces-darkblue focus:ring-annonces-darkblue rounded-md shadow-sm mt-1 block w-full text-gray-400 bg-white"></textarea>
										</div>

										@error('post.values_print.body')
											<span class="error text-danger-700">
												{{ $message }}
											</span>
										@enderror
									</div>

									{{--
										@if($post->offer->hasOption('column.1/2') || $post->offer->hasOption('column.1'))
											<div>
												<div class="flex flex-row">
													<x-front.input-label for="wanted_profile" :value="__('Applicant profile wanted')" />
												</div>

												<div class="flex flex-row items-center">
													<textarea name="body" x-ref="wantedProfileLength" x-on:keyup="countCaractersLeft('wantedProfileLength')" wire:model.lazy="post.values_print.wanted_profile" cols="30" rows="6" placeholder="{{ __('Applicant profile wanted') }}" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="border-gray-300 w-full focus:border-annonces-darkblue focus:ring-annonces-darkblue rounded-md shadow-sm mt-1 block w-full text-gray-400 bg-white"></textarea>
												</div>

												@error('post.values_print.wanted_profile')
													<span class="error text-danger-700">
														{{ $message }}
													</span>
												@enderror
											</div>
										@endif

										@if($post->offer->hasOption('column.1'))
											<div>
												<div class="flex flex-row">
													<x-front.input-label for="experience" :value="__('Needed experience')" />
												</div>

												<div class="flex flex-row items-center">
													<textarea name="experience" x-ref="experiencesLength" x-on:keyup="countCaractersLeft('experiencesLength')" wire:model.lazy="post.values_print.experiences" placeholder="{{ __('Needed experience') }}" cols="30" rows="6" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="border-gray-300 w-full focus:border-annonces-darkblue focus:ring-annonces-darkblue rounded-md shadow-sm mt-1 block w-full text-gray-400 bg-white"></textarea>
												</div>

												@error('post.values_print.experiences')
													<span class="error text-danger-700">
														{{ $message }}
													</span>
												@enderror
											</div>

											<div>
												<div class="flex flex-row">
													<x-front.input-label for="skills" :value="__('Needed skills')" />
												</div>

												<div class="flex flex-row items-center">
													<textarea name="skills" x-ref="skillsLength" x-on:keyup="countCaractersLeft('skillsLength')" wire:model.lazy="post.values_print.skills" placeholder="{{ __('Needed skills') }}" cols="30" rows="6" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="border-gray-300 w-full focus:border-annonces-darkblue focus:ring-annonces-darkblue rounded-md shadow-sm mt-1 block w-full text-gray-400 bg-white"></textarea>
												</div>

												@error('post.values_print.skills')
													<span class="error text-danger-700">
														{{ $message }}
													</span>
												@enderror
											</div>

											<div>
												<div class="flex flex-row">
													<x-front.input-label for="bonuses" :value="__('Bonuses')" />
												</div>

												<div class="flex flex-row items-center">
													<textarea name="bonuses" x-ref="bonusesLength" x-on:keyup="countCaractersLeft('bonusesLength')" wire:model.lazy="post.values_print.bonus_description" placeholder="{{ __('Bonuses') }}" cols="30" rows="6" :disabled="!Auth::guard('admin')->check() && $post->state->color() == 'green'" class="border-gray-300 w-full focus:border-annonces-darkblue focus:ring-annonces-darkblue rounded-md shadow-sm mt-1 block w-full text-gray-400 bg-white"></textarea>
												</div>

												@error('post.values_print.bonus_description')
													<span class="error text-danger-700">
														{{ $message }}
													</span>
												@enderror
											</div>
										@endif
									--}}
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="mt-6">
					<x-front.form-part-title>
						{{ __('Quick preview of your print post') }}
					</x-front.form-part-title>

					<div style="padding:0 40px 0 40px;">
						<div class="flex flex-row bg-[#daeae1] p-6">
							<x-front.space.posts.column-preview :size="$post->offer->hasOption('column.1/4')?'1/4':($post->offer->hasOption('column.1/2')?'1/2':'1')" :post="$post" :location="$location" />
						</div>
					</div>

					<div class="mt-4 flex flex-row text-sm text-annonces-headergray">
						{{ __('Non-contractual preview') }}
					</div>
				</div>

				<div class="flex sm:flex-row flex-col sm:justify-between justify-center mt-12">
					<x-front.secondary-button wire:click="back()" class="flex justify-center">
						{{ __('Go back') }}
					</x-front.secondary-button>

					<div class="flex justify-between sm:mt-0 mt-4">
						<a href="#anchor">
							<x-front.primary-button :class="'ml-4'" wire:click="submitPrintStep">
								{{ __('Continue') }}
							</x-front.primary-button>
						</a>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
