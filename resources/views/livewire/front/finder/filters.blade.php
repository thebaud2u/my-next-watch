<div>
	<div class="flex flex-row justify-center m-4">
		<div class="flex flex-col p-8">
			@if($step == 'generalities')
				<div class="flex flex-col gap-4 my-4">
					{{ __('What type of watch are you interested in ?') }}

					<div class="flex flex-row">
						@foreach($data['types'] as $type)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.type" value="{{ $type->slug }}" id="watch-type-{{ $type->slug }}" wire:model="filters.type" class="peer hidden" />
								<label for="watch-type-{{ $type->slug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ ucfirst($type->name) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.country" :value="__('A country preference ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['countries'] as $country)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.country" value="{{ $country->id }}" id="watch-country-{{ $country->id }}" wire:model="filters.country" class="peer hidden" />
								<label for="watch-country-{{ $country->id }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ ucfirst($country->name) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@elseif($step == 'dimensions')
				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_diameter" :value="__('What about the case diameter ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_diameters'] as $caseDiameter)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_diameter" value="{{ $caseDiameter }}" id="watch-case-diameter-{{ $caseDiameter }}" wire:model="filters.case_diameter" class="peer hidden" />
								<label for="watch-case-diameter-{{ $caseDiameter }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ $caseDiameter }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@elseif($step == 'price')
			
			@endif

			<div class="flex flex-row justify-end mt-10">
				<x-front.primary-button wire:click="nextStep">
					@if($step != 'price')
						{{ __('Next') }}

						<svg class="ml-2" width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.85938 1.5L7.31392 6.5L1.85938 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					@elseif($step == 'price')
						{{ __('Find my next watch !') }}
					@endif
				</x-front.primary-button>
			</div>
		</div>
	</div>
</div>