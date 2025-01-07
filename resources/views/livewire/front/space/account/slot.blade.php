<div>
	<div wire:key="error">
		{{-- Flash message --}}
		@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
			<div class="py-5 px-4 lg:px-6 max-w-[1440px]" x-data="{}" x-ref="alert">
				@include('components.front.home.alert-message')
			</div>
		@endif
	</div>

	@if($active == 'account')
		<div>
			<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:flex-row sm:justify-between">
				<x-front.space-title>
					{{ __('My personnal information') }}
				</x-front.space-title>
			</div>

			<div class="flex flex-row mt-4 mb-2">
				<x-front.input-label :value="__('Select your logo')" />
			</div>

			<div wire:ignore wire:key="avatar-uploader-component">
				<livewire:uploader
					:user="$user"
					:max_medias="1"
					:first_is_main="false"
					:class="\App\Models\User::class"
					:model_id="$this->user->id"
					:collection="'avatar'"
					:grid_class="'w-full max-w-[250px]'"
					:aspect_ratio="'aspect-square'"
					:object_fit="'object-cover'"
					:wire:key="'avatar'" />
			</div>

			<div class="mt-4">
				<x-front.input-label for="user.gender_id" :value="__('Gender')" :required="true" />

				<div class="flex flex-row flex-wrap mt-2">
					@foreach($genders as $gender)
						<div class="pr-5">
							<input type="radio" name="user.gender_id" value="{{ $gender->id }}" wire:model="user.gender_id" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
							<x-front.input-label for="user.gender_id" :class="'inline-block'" :value="__($gender->name)" />
						</div>
					@endforeach
				</div>

				@error('user.gender_id')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div class="grid gap-6 grid-cols-1 md:grid-cols-2 mt-5">
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="user.last_name" :value="__('Lastname')" :required="true" />
					</div>

					<x-front.text-input type="text" name="user.last_name" wire:model="user.last_name" placeholder="{{ __('Lastname') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

					@error('user.last_name')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				<div>
					<div class="flex flex-row">
						<x-front.input-label for="user.first_name" :value="__('Firstname')" :required="true" />
					</div>

					<x-front.text-input type="text" name="user.first_name" wire:model="user.first_name" laceholder="{{ __('Firstname') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

					@error('user.first_name')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				<div>
					<div class="flex flex-row">
						<x-front.input-label for="user.mobile_phone" :value="__('Mobile number')" :required="true" />
					</div>

					<x-front.text-input type="tel" name="user.mobile_phone" wire:model="user.mobile_phone" placeholder="{{ __('06 05 04 ...') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

					@error('user.mobile_phone')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				<div>
					<div class="flex flex-row">
						<x-front.input-label for="user.thematic_id" :value="__('Favorite thematic')" />
					</div>

					<select name="user.thematic_id" wire:model="user.thematic_id" wire:change="thematicSelected" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm w-full">
						<option value="">{{ __('Choose your favorite thematic') }}</option>
						@foreach($thematics as $thematic)
							<option value="{{ $thematic->id }}">
								{{ ucfirst($thematic->slug) }}
							</option>
						@endforeach
					</select>

					@error('user.thematic_id')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-between mt-10">
				<a href="https://profil.tema-transport-logistique.com/user/{{ request()->session()->get('ssoUserId') }}/mot_de_passe" target="_blank">
					<x-front.secondary-button>
						{{ __('Change my password') }}
					</x-front.secondary-button>
				</a>

				<x-front.primary-button wire:click="submitForm">
					{{ __('Save') }}
				</x-front.primary-button>
			</div>
		</div>
	@elseif($active == 'profile')
		<div>
			<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:flex-row sm:justify-between">
				<x-front.space-title>
					{{ __('My profile information') }}
				</x-front.space-title>
			</div>

			<div class="flex lg:flex-row flex-col mt-2">
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="user.type" :value="__('You are')" :required="true" />
					</div>

					<div class="flex flex-row flex-wrap mt-2">
						<div class="pr-5">
							<input type="radio" name="user.type" value="Particulier" wire:model.live="user.type" wire:change="typeChanged" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
							<x-front.input-label for="user.type" :class="'font-normal inline-block'" :value="__('Individual')" />
						</div>

						<div class="pr-5">
							<input type="radio" name="user.type" value="Professionnel" wire:model.live="user.type" wire:change="typeChanged" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
							<x-front.input-label for="user.type" :class="'font-normal inline-block'" :value="__('Professional')" />
						</div>
					</div>

					@error('user.type')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			@if($user->type)
				<div class="mt-4">
					@if($user->type == 'Particulier')
						<div class="w-48">
							<div class="flex flex-row">
								<x-front.input-label for="user.birth_date" :value="__('Birth date')" />
							</div>

							<x-front.text-input type="date" name="user.birth_date" wire:model="user.birth_date" placeholder="{{ __('dd/mm/yyyy') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

							@error('user.birth_date')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div wire:ignore wire:key="particulier-address-component">
							<livewire:address
								:address="$address"
								:city_required="true"
								:country_required="true"
								:additionnal_2="false"
								:wire:key="'particulier-'.$user->id" />
						</div>

						@error('address.city_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.custom_city')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.country_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					@elseif($user->type == 'Professionnel')
						<div>
							<div class="grid gap-6 grid-cols-1 md:grid-cols-2 mt-5">
								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.sector_id" :value="__('Your sector')" />
									</div>

									<select name="user.sector_id" wire:model.live="user.sector_id" wire:change="sectorSelected" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm w-full">
										@if($user->thematic)
											<option value="">{{ __('Choose your sector') }}</option>
											@foreach($sectors as $sector)
												<option value="{{ $sector->id }}">
													{{ $sector->name }}
												</option>
											@endforeach
										@else
											<option value="">{{ __('You must select your favorite thematic') }}</option>
										@endif
									</select>

									@error('user.sector_id')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.activity_id" :value="__('Your activity')" />
									</div>

									<select name="user.activity_id" wire:model="user.activity_id" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm w-full">
										@if($user->thematic)
											@if($user->sector)
												@if($activities->isNotEmpty())
													<option value="">{{ __('Choose your activity') }}</option>
													@foreach($activities as $activity)
														<option value="{{ $activity->id }}">
															{{ $activity->name }}
														</option>
													@endforeach
												@else
													<option value="">{{ __('No activities available') }}</option>
												@endif
											@else
												<option value="">{{ __('You must select your sector') }}</option>
											@endif
										@else
											<option value="">{{ __('You must select your favorite thematic') }}</option>
										@endif
									</select>

									@error('user.thematic_id')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.raison_sociale" :value="__('Corporate name')" :required="true" />
									</div>

									<x-front.text-input type="text" name="user.values.raison_sociale" wire:model="user.values.raison_sociale" placeholder="{{ __('Corporate name') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.raison_sociale')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.company_name" :value="__('Company name')" :required="true" />
									</div>

									<x-front.text-input type="text" name="user.values.company_name" wire:model="user.values.company_name" placeholder="{{ __('Company name') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.company_name')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.naf" :value="__('NAF code')" :required="true" />
									</div>

									<x-front.text-input type="text" name="user.values.naf" wire:model="user.values.naf" maxlength="5" placeholder="{{ __('NAF code') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.naf')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.siret" :value="__('SIRET number')" :required="true" />
									</div>

									<x-front.text-input type="text" name="user.values.siret" wire:model="user.values.siret" maxlength="14" placeholder="{{ __('SIRET number') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.siret')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.tva" :value="__('TVA number')" />
									</div>

									<x-front.text-input type="text" name="user.values.tva" wire:model="user.values.tva" placeholder="{{ __('TVA number') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.tva')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.company_phone" :value="__('Company phone number')" :required="true" />
									</div>

									<x-front.text-input type="tel" name="user.values.company_phone" wire:model="user.values.company_phone" placeholder="{{ __('06 05 04 ...') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.company_phone')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div wire:ignore wire:key="professionnal-address-component">
								<livewire:address
									:address="$address"
									:city_required="true"
									:country_required="true"
									:additionnal_2="false"
									:wire:key="'professionnel-'.$user->id" />
							</div>

							@error('address.city_id')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							@error('address.custom_city')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							@error('address.country_id')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="flex flex-row justify-center items-center">
							<hr class="w-48 h-1 my-8 border-0 bg-mnw-blue">
						</div>

						<div>
							<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:flex-row sm:justify-between">
								<x-front.space-title>
									{{ __('Your company') }}
								</x-front.space-title>
							</div>

							<div class="flex flex-row mt-4 mb-2">
								<x-front.input-label :value="__('Select your logo')" />
							</div>

							<livewire:uploader
								:user="$user"
								:max_medias="1"
								:first_is_main="false"
								:class="\App\Models\User::class"
								:model_id="$this->user->id"
								:collection="'logo'"
								:grid_class="'w-full max-w-[250px]'"
								:aspect_ratio="'aspect-square'"
								:object_fit="'object-cover'"
								:wire:key="'logo'" />

							<div class="flex flex-row mt-4 mb-2">
								<x-front.input-label :value="__('Select your banner')" />
							</div>

							<livewire:uploader
								:user="$user"
								:max_medias="1"
								:first_is_main="false"
								:class="\App\Models\User::class"
								:model_id="$this->user->id"
								:collection="'banner'"
								:grid_class="'w-full max-w-[250px]'"
								:aspect_ratio="'aspect-square'"
								:object_fit="'object-cover'"
								:key="'banner'" />

							<div class="grid gap-6 grid-cols-1 md:grid-cols-2 mt-5">
								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.url" :value="__('Site url')" />
									</div>

									<x-front.text-input type="text" name="user.values.url" wire:model="user.values.url" placeholder="{{ __('Site url') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.url')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.facebook" :value="__('Facebook url')" />
									</div>

									<x-front.text-input type="text" name="user.values.facebook" wire:model="user.values.facebook" placeholder="{{ __('Facebook url') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.facebook')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.linkedin" :value="__('Linkedin url')" />
									</div>

									<x-front.text-input type="text" name="user.values.linkedin" wire:model="user.values.linkedin" placeholder="{{ __('Linkedin url') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.linkedin')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<div class="flex flex-row">
										<x-front.input-label for="user.values.instagram" :value="__('Instagram url')" />
									</div>

									<x-front.text-input type="text" name="user.values.instagram" wire:model="user.values.instagram" placeholder="{{ __('Instagram url') }}" :class="'mt-1 block w-full sm:min-w-[207px]'" />

									@error('user.values.instagram')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-4">
								<x-front.input-label for="user.values.company_presentation" :value="__('Company description')" />

								<textarea name="user.values.company_presentation" wire:model="user.values.company_presentation" rows="5" placeholder="{{ __('Company description') }}" class="border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>

								@error('user.values.company_presentation')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>
					@endif
				</div>
			@endif

			<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-end mt-10">
				<x-front.primary-button wire:click="submitForm">
					{{ __('Save') }}
				</x-front.primary-button>
			</div>
		</div>
	@endif
</div>
