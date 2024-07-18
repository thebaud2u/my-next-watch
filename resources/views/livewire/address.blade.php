<div>
	<div class="grid gap-4 grid-cols-1 md:grid-cols-2 mt-5">
		<div>
			<x-front.input-label for="street" :value="__('Street')" />

			<x-front.text-input id="street" name="street" wire:model.live="address.street" placeholder="{{ __('Street') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

		</div>

		<div>
			<x-front.input-label for="additional_1" :value="__('Additional 1')" />

			<x-front.text-input id="additional_1" name="additional_1" wire:model.live="address.additional_1" :disabled="$disabled" placeholder="{{ __('Additional 1') }}" :class="'mt-1 block w-full'" />

		</div>

		@if($additionnal_2)
			<div>
				<x-front.input-label for="additional_2" :value="__('Additional 2')" />

				<x-front.text-input id="additional_2" name="additional_2" wire:model.live="address.additional_2" :disabled="$disabled" placeholder="{{ __('Additional 2') }}" :class="'mt-1 block w-full'" />

			</div>
		@endif

		@if($address['country_id'] != 67)
			<div>
				<x-front.input-label for="custom_postcode" :value="__('Custom postcode')" />

				<x-front.text-input id="custom_postcode" name="custom_postcode" wire:model.live="address.custom_postcode" placeholder="{{ __('Custom postcode') }}" :class="'mt-1 block w-full'" />

			</div>

			<div>
				<x-front.input-label for="custom_province" :value="__('Custom province')" />

				<x-front.text-input id="custom_province" name="custom_province" wire:model.live="address.custom_province" placeholder="{{ __('Custom province') }}" :class="'mt-1 block w-full'" />

			</div>

			<div>
				<x-front.input-label for="custom_city" :value="__('Custom city')" :required="$city_required" />

				<x-front.text-input id="custom_city" name="custom_city" wire:model.live="address.custom_city" placeholder="{{ __('Custom city') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />


			</div>
		@else
			<div>
				<x-front.input-label for="search" :value="__('City')" :required="$city_required" />

				<x-front.text-input name="search" id="search" wire:model.live.debounce.500ms="search" wire:keyup.debounce.500ms="searchResult" placeholder="{{ __('City') }}" :disabled="$disabled" :class="'mt-1 block w-full'" />

				<!-- Search result list -->
				@if($showdiv)
					<ul class="p-4 border border-gray-300 rounded-md max-h-72 overflow-y-auto absolute bg-white">
						@if(!empty($cities))
							@foreach($cities as $city)
								<li wire:click="fetchDetail({{ $city }})" wire:key="city-{{ $city->id }}" class="hover:underline cursor-pointer">
									{{ $city->name }} ({{ $city->zip_code }})
								</li>
							@endforeach
						@endif
					</ul>
				@endif
			</div>
		@endif

		<div>
			<x-front.input-label for="country_id" :value="__('Country')" :required="$country_required" />

			<select id="country_id" name="country_id" wire:model.live="address.country_id" disabled="$disabled" class="text-gray-400 mt-1 block border border-gray-300 rounded-md focus:ring-annonces-blue focus:border-annonces-blue w-full">
				@foreach($countries as $country)
					<option value="{{ $country->id }}" wire:key="country-{{ $country->id }}">
						{{ $country->name }}
					</option>
				@endforeach
			</select>
		</div>

		<div>
			@if($address)
				@php
					if($address->city || $address->custom_city) {
						$street = $address->street ? $address->street.',' : '';
						$city = $address->city ? $address->city->name : $address->custom_city;
						$code = $address->city->zip_code ? $address->city->zip_code : (($address->custom_city && $address->custom_postcode) ? $address->custom_postcode : '');

						$location = $street.' '.$city.', '.$code.', '.$address->country->name;
					}
					elseif($address->department) $location = $address->department->name.' ('.$address->department->code.')';
					elseif($address->region) $location = $address->region->name;
					elseif($address->country) $location = $address->country->name;
					else $location = __('Unknown location');
				@endphp

				<div class="mt-4">
					<span class="text-annonces-blue font-semibold">
						{{ __('Location chosen') }}
					</span> :<br/>

					{{ $location }}
				</div>
			@else
				{{ __('No address') }}
			@endif
		</div>

		<input type="hidden" name="city_id" value="{{ $address->country_id == 67 ? $address->city?->id : null }}" />
		<input type="hidden" name="department_id" value="{{ $address->country_id == 67 ? $address->department?->id : null }}" />
		<input type="hidden" name="region_id" value="{{ $address->country_id == 67 ? $address->region?->id : null }}" />
	</div>
</div>
