<div>
	<div class="rounded-b-md ring-1 ring-black ring-opacity-5 bg-white p-4 text-sm xl:text-base"
		x-data="{
			r: {{ $filters['distance'] }},
			dst: '',
			updLoc:function(){
				var d = (this.dst == 1 && $refs.r.value > 0);
				this.loc = (d?'± '+$refs.r.value+' km | ':'')+$wire.searchLabel;
			}
		}" x-init="$nextTick(()=>{ updLoc(); $wire.on('location-selected', (filters, distance) => { dst = distance; updLoc() })})">
		<div>
			<input type="text" name="l" wire:model.debounce.500ms="search" wire:keyup.debounce.500ms="searchLocalisationEntry" placeholder="{{ __('Enter a location') }}" class="block w-full p-2 text-gray-700 text-sm xl:text-base bg-white border-gray-300 rounded-md" />
			<input type="hidden" name="lt" value="{{ $locType }}" wire:model="locType" />
			<input type="hidden" name="lid" value="{{ $locId }}" wire:model="locId" />
		</div>

		@if($showResults)
			<ul class="mt-4 text-gray-700 max-h-72 overflow-y-auto">
				@if(!empty($records))
					@foreach($records as $record)
						@switch ($record->type)
							@case ('country')
								<li wire:click="fetchDetail({{ $record }})" wire:key="country-{{ $record }}" class="cursor-pointer hover:underline transition duration-200 ease-in-out">
									{{ $record->name }} ({{ __('country') }})
								</li>
								@break

							@case ('region')
								<li wire:click="fetchDetail({{ $record }})" wire:key="region-{{ $record }}" class="cursor-pointer hover:underline transition duration-200 ease-in-out">
									{{ $record->name }} ({{ __('region') }})
								</li>
								@break

							@case ('department')
								<li wire:click="fetchDetail({{ $record }})" wire:key="department-{{ $record }}" class="cursor-pointer hover:underline transition duration-200 ease-in-out">
									{{ $record->name }} ({{ __('department') }})
								</li>
								@break

							@case ('city')
								<li wire:click="fetchDetail({{ $record }})" wire:key="city-{{ $record }}" class="cursor-pointer hover:underline transition duration-200 ease-in-out">
									{{ $record->name }} ({{ $record->zip_code }})
								</li>
								@break

							@case ('cities')
								<li wire:click="fetchDetail({{ $record }})" wire:key="cities-{{ $record }}" class="cursor-pointer hover:underline transition duration-200 ease-in-out">
									{{ $record->name }} ({{ __('all city') }})
								</li>
								@break
								@default
						@endswitch
					@endforeach
				@endif
			</ul>
		@endif

		<div class="mt-4 text-gray-700 {{ $showDistance ? '' : 'hidden' }}">
			<input type="hidden" name="d" {{ $showDistance ? '' : 'disabled' }} x-bind:value="r*1000">
			<label for="range" class="block mb-2 text-sm xl:text-base">{{ __('Radius around') }}</label>
			<input id="range" type="range" min="0" step="20" max="200" {{ $showDistance ? '' : 'disabled' }} x-ref="r" x-model="r" x-on:change="updLoc()" wire:model="filters.distance" wire:change.debounce.500ms="distanceUpdated" class="w-2/3 h-2 bg-gray-200 accent-vjcyan-500 rounded-lg appearance-none cursor-pointer">
			<output class="ml-2">{{ $filters['distance'] }}</output> km
		</div>
	</div>
</div>
