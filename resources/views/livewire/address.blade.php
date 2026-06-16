<div>
	<div class="grid gap-4 grid-cols-1">
		<div>
			<x-front.input-label for="street" :value="__('Number and street name')" :required="$streetRequired" :class="'pl-4'" />

			<x-front.text-input id="street" name="street" wire:model.live="address.street" placeholder="{{ __('Number and street name') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

			@error('address.street')
				<span class="error text-danger-700">
					{{ $message }}
				</span>
			@enderror
		</div>

		@if($additionnal_1)
			<div>
				<x-front.input-label for="additionnal_1" :value="__('Additionnal 1')" :class="'pl-4'" />

				<x-front.text-input id="additionnal_1" name="additionnal_1" wire:model.live="address.additionnal_1" :disabled="$disabled" placeholder="{{ __('Additional 1') }}" :class="'mt-1 block w-full'" />
			</div>
		@endif

		@if($additionnal_2)
			<div>
				<x-front.input-label for="additionnal_2" :value="__('Additionnal 2')" :class="'pl-4'" />

				<x-front.text-input id="additionnal_2" name="additionnal_2" wire:model.live="address.additionnal_2" :disabled="$disabled" placeholder="{{ __('Additional 2') }}" :class="'mt-1 block w-full'" />
			</div>
		@endif

		@if($address->country_id != 67)
			<div class="flex flex-row">
				@if($showZipCode)
					<div class="pr-4">
						<x-front.input-label for="custom_postcode" :value="__('Postal code')" :required="$zipCodeRequired" :class="'pl-4'" />

						<x-front.text-input name="custom_postcode" id="custom_postcode" wire:model.live="address.custom_postcode" placeholder="{{ __('Postal code') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

						@error('address.custom_postcode')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@endif

				<div>
					<x-front.input-label for="custom_city" :value="__('City')" :required="$cityRequired" :class="'pl-4'" />

					<x-front.text-input name="custom_city" id="custom_city" wire:model.live="address.custom_city" placeholder="{{ __('City') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

					@error('address.custom_city')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			<div>
				<x-front.input-label for="custom_province" :value="__('Province')" :class="'pl-4'" />

				<x-front.text-input id="custom_province" name="custom_province" wire:model.live="address.custom_province" placeholder="{{ __('Province') }}" :class="'mt-1 block w-full'" />
			</div>
		@else
			<div class="flex flex-row">
				@if($showZipCode)
					<div class="pr-4">
						<x-front.input-label for="zipCode" :value="__('Postal code')" :required="$zipCodeRequired" :class="'pl-4'" />

						<x-front.text-input name="zipCode" id="zipCode" wire:model.live="zipCode" wire:keyup.debounce.500ms="searchZipCode" placeholder="{{ __('Postal code') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

						@error('zipCode')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<!-- Search result list -->
						@if($showDivZipCode)
							<ul class="p-4 border border-gray-300 rounded-md max-h-72 overflow-y-auto absolute bg-white z-50">
								@if($cities->isNotEmpty())
									@foreach($cities as $city)
										<li wire:click="fetchDetail({{ $city->id }})" wire:key="city-{{ $city->id }}" class="hover:underline cursor-pointer text-jobboard-deepblue">
											{{ $city->name }} ({{ $city->zip_code }})
										</li>
									@endforeach
								@else
									{{ __('No city found') }}
								@endif
							</ul>
						@endif
					</div>
				@endif

				<div>
					<x-front.input-label for="search" :value="__('City')" :required="$cityRequired" :class="'pl-4'" />

					<x-front.text-input name="search" id="search" wire:model.live.debounce.500ms="search" wire:keyup.debounce.500ms="searchCity" placeholder="{{ __('City') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

					@error('address.city_id')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror

					<!-- Search result list -->
					@if($showDivCity)
						<ul class="p-4 border border-gray-300 rounded-md max-h-72 overflow-y-auto absolute bg-white z-50">
							@if($cities->isNotEmpty())
								@foreach($cities as $city)
									<li wire:click="fetchDetail({{ $city->id }})" wire:key="city-{{ $city->id }}" class="hover:underline cursor-pointer text-jobboard-deepblue">
										{{ $city->name }} ({{ $city->zip_code }})
									</li>
								@endforeach
							@else
								{{ __('No city found') }}
							@endif
						</ul>
					@endif
				</div>
			</div>
		@endif

		@if($showCountry)
			<div>
				<x-front.input-label for="country_id" :value="__('Country')" :required="$countryRequired" :class="'pl-4'" />

				<select id="country_id" name="country_id" wire:model.live="address.country_id" wire:change="countrySelected" @disabled($disabled) class="border-jobboard-greige focus:border-jobboard-deepblue focus:ring-jobboard-deepblue rounded-md shadow-sm text-jobboard-deepblue placeholder:text-gray-400 mt-1 w-full w-full">
					@foreach($countries as $country)
						<option value="{{ $country->id }}" wire:key="country-{{ $country->id }}">
							{{ $country->name }}
						</option>
					@endforeach
				</select>
			</div>
		@endif

		<input type="hidden" name="city_id" value="{{ $address->country_id == 67 ? $address->city?->id : null }}" />
		<input type="hidden" name="department_id" value="{{ $address->country_id == 67 ? $address->department?->id : null }}" />
		<input type="hidden" name="region_id" value="{{ $address->country_id == 67 ? $address->region?->id : null }}" />
	</div>
</div>
