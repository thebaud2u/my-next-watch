{{-- Vehicule type --}}
@if($postType->slug == 'vente-vehicule' || $postType->slug == 'achat-location-vehicule')
	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Vehicule types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}vehicule_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Vehicule types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_vehicule_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['vehicule-type'] as $vehiculeType)
								<div wire:key="vehicule-types-{{ $vehiculeType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}vehicule_types_checkbox_{{ $vehiculeType->id }}" value="{{ $vehiculeType->id }}" x-on:click="checkEls()" wire:model="filters.vehicule_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}vehicule_types_checkbox_{{ $vehiculeType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $vehiculeType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

{{-- Commissioning Year / Mileage --}}
@if($postType->slug == 'vente-vehicule')
	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				{{ __('Commissioning year') }}
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			<x-front.text-input type="number" name="filters.commissioning_year_min" wire:model="filters.commissioning_year_min" wire:change="search" placeholder="{{ __('Minimum commissioning year') }}" minlength="4" maxlength="4" :class="'mt-1 inline-block bg-white w-full'" />

			<x-front.text-input type="number" name="filters.commissioning_year_max" wire:model="filters.commissioning_year_max" wire:change="search" placeholder="{{ __('Maximum commissioning year') }}" minlength="4" maxlength="4" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
		</div>
	</div>

	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				{{ __('Mileage') }}
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			<x-front.text-input type="number" name="filters.mileage_min" wire:model="filters.mileage_min" wire:change="search" placeholder="{{ __('Minimum mileage') }}" :class="'mt-1 inline-block bg-white w-full'" />

			<x-front.text-input type="number" name="filters.mileage_max" wire:model="filters.mileage_max" wire:change="search" placeholder="{{ __('Maximum mileage') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
		</div>
	</div>
@endif

{{-- Availibity --}}
@if($postType->slug == 'achat-location-vehicule')
	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				{{ __('Availability') }}
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			<x-front.text-input type="number" name="filters.availability_min" wire:model="filters.availability_min" wire:change="search" placeholder="{{ __('Minimum availability') }}" :class="'mt-1 inline-block bg-white w-full'" />

			<x-front.text-input type="number" name="filters.availability_max" wire:model="filters.availability_max" wire:change="search" placeholder="{{ __('Maximum availability') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
		</div>
	</div>
@endif

{{-- Sector / Activity type --}}
@if($postType->slug == 'transaction-entreprise')
	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Sectors')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}sectors_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Sectors')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_sectors">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['sector'] as $sector)
								<div wire:key="sectors-{{ $sector->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}sectors_checkbox_{{ $sector->id }}" value="{{ $sector->id }}" x-on:click="checkEls()" wire:model="filters.sectors" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}sectors_checkbox_{{ $sector->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $sector->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Activity types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}activity_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Activity types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_activity_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['activity-type'] as $activityType)
								<div wire:key="activity-types-{{ $activityType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}activity_types_checkbox_{{ $activityType->id }}" value="{{ $activityType->id }}" x-on:click="checkEls()" wire:model="filters.activity_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}activity_types_checkbox_{{ $activityType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $activityType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

{{-- Good type / Characteristics / Surface / Energy class / GES --}}
@if($postType->slug == 'offre-immobiliere')
	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Good types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}good_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Good types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_good_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['good-type'] as $goodType)
								<div wire:key="good-types-{{ $goodType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}good_types_checkbox_{{ $goodType->id }}" value="{{ $goodType->id }}" x-on:click="checkEls()" wire:model="filters.good_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}good_types_checkbox_{{ $goodType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $goodType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Characteristics')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}characteristics_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Characteristics')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_characteristics">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['characteristics'] as $characteristics)
								<div wire:key="characteristics-{{ $characteristics->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}characteristics_checkbox_{{ $characteristics->id }}" value="{{ $characteristics->id }}" x-on:click="checkEls()" wire:model="filters.characteristics" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}characteristics_checkbox_{{ $characteristics->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $characteristics->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				{{ __('Surface') }}
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			<x-front.text-input type="number" name="filters.surface_min" wire:model="filters.surface_min" wire:change="search" placeholder="{{ __('Minimum surface') }}" :class="'mt-1 inline-block bg-white w-full'" />

			<x-front.text-input type="number" name="filters.surface_max" wire:model="filters.surface_max" wire:change="search" placeholder="{{ __('Maximum surface') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Energy classes')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}energy_classes_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Energy classes')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_energy_classes">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['energy-class'] as $energyClass)
								<div wire:key="energy_classes-{{ $energyClass->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}energy_classes_checkbox_{{ $energyClass->id }}" value="{{ $energyClass->id }}" x-on:click="checkEls()" wire:model="filters.energy_classes" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}energy_classes_checkbox_{{ $energyClass->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $energyClass->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('GES')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}ges_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('GES')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_ges">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['GES'] as $ges)
								<div wire:key="ges-{{ $ges->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}ges_checkbox_{{ $ges->id }}" value="{{ $ges->id }}" x-on:click="checkEls()" wire:model="filters.ges" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}ges_checkbox_{{ $ges->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $ges->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

{{-- Market spectrum / Market type / Notice type / Closing date --}}
@if($postType->slug == 'appel-offre')
	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Market spectrums')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}market_sepctrums_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Market spectrums')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_market_spectrums">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['market-spectrum'] as $marketSpectrum)
								<div wire:key="market-spectrums-{{ $marketSpectrum->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}market_sepctrums_checkbox_{{ $marketSpectrum->id }}" value="{{ $marketSpectrum->id }}" x-on:click="checkEls()" wire:model="filters.market_spectrums" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}market_sepctrums_checkbox_{{ $marketSpectrum->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $marketSpectrum->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Market types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}market_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Market types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_market_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['market-type'] as $marketType)
								<div wire:key="market-types-{{ $marketType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}market_types_checkbox_{{ $marketType->id }}" value="{{ $marketType->id }}" x-on:click="checkEls()" wire:model="filters.market_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}market_types_checkbox_{{ $marketType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $marketType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Notice types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}notice_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Notice types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_notice_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['notice-type'] as $noticeType)
								<div wire:key="notice-types-{{ $noticeType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}notice_types_checkbox_{{ $noticeType->id }}" value="{{ $noticeType->id }}" x-on:click="checkEls()" wire:model="filters.notice_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}notice_types_checkbox_{{ $noticeType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $noticeType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				{{ __('Closing date') }}
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			<x-front.text-input type="date" name="filters.closing_date" wire:model="filters.closing_date" wire:change="search" placeholder="{{ __('Closing date') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" :class="'mt-1 inline-block bg-white w-full'" />
		</div>
	</div>
@endif

{{-- Tractionnary type --}}
@if($postType->slug == 'tractionnaire')
	<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
		<div x-data="{
			deploy: false,
			tLbl:'{{ str_replace("'", "\\'", __('Tractor types')) }}',
			checkEls:function() {
				t = [];
				els = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}tractor_types_checkbox_]');
				[...els].map((el, key) => {
					if(el.checked) t.push(el.value);
				});

				this.tLbl = '{{ str_replace("'", "\\'", __('Tractor types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
			}
		}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_tractor_types">
			<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
				<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
					<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
						<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
						<span class="inline-block text-annonces-gray" x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
							</svg>
						</span>

						<span class="inline-block text-annonces-gray" x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
							</svg>
						</span>
					</span>

					<div x-show="deploy" x-transition class="mt-4 p-4">
						<div>
							@foreach($criterias['tractor-type'] as $tractorType)
								<div wire:key="tractor-types-{{ $tractorType->id }}" class="flex items-center py-1 text-annonces-blue">
									<input type="checkbox" id="{{ $responsive?'r_':'' }}tractor_types_checkbox_{{ $tractorType->id }}" value="{{ $tractorType->id }}" x-on:click="checkEls()" wire:model="filters.tractor_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
									<label for="{{ $responsive?'r_':'' }}tractor_types_checkbox_{{ $tractorType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $tractorType->name }}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

{{-- Price --}}
@if($postType->slug != 'appel-offre' && $postType->slug != 'tractionnaire')
	<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
		<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
			<span class="flex-1 font-semibold text-annonces-gray">
				@if($postType->slug == 'achat-location-vehicule')
					{{ __('Rental price / day') }}
				@elseif($postType->slug == 'transaction-entreprise')
					{{ __('Transfer pricing') }}
				@else
					{{ __('Selling price') }}
				@endif
			</span>

			<span class="inline-block text-annonces-gray" x-show="deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
				</svg>
			</span>

			<span class="inline-block text-annonces-gray" x-show="!deploy">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</span>
		</span>

		<div x-show="deploy" x-transition class="mt-4 p-4">
			@if($postType->slug == 'achat-location-vehicule')
				<x-front.text-input type="number" name="filters.price_min" wire:model="filters.price_min" wire:change="search" placeholder="{{ __('Minimum rental price / day') }}" :class="'mt-1 inline-block bg-white w-full'" />

				<x-front.text-input type="number" name="filters.price_max" wire:model="filters.price_max" wire:change="search" placeholder="{{ __('Maximum rental price / day') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
			@elseif($postType->slug == 'transaction-entreprise')
				<x-front.text-input type="number" name="filters.price_min" wire:model="filters.price_min" wire:change="search" placeholder="{{ __('Minimum transfer pricing') }}" :class="'mt-1 inline-block bg-white w-full'" />

				<x-front.text-input type="number" name="filters.price_max" wire:model="filters.price_max" wire:change="search" placeholder="{{ __('Maximum transfer pricing') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
			@else
				<x-front.text-input type="number" name="filters.price_min" wire:model="filters.price_min" wire:change="search" placeholder="{{ __('Minimum price') }}" :class="'mt-1 inline-block bg-white w-full'" />

				<x-front.text-input type="number" name="filters.price_max" wire:model="filters.price_max" wire:change="search" placeholder="{{ __('Maximum price') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
			@endif
		</div>
	</div>
@endif
