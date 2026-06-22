<div>
	<div class="flex flex-row justify-center m-4">
		<div class="flex flex-col p-8">
			@if($activeStep == 1)
				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.country" :value="__('What type of watch are you interested in ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['types'] as $type)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.type" value="{{ $type->slug }}" id="watch-type-{{ $type->slug }}" wire:model="filters.type" wire:change="finderUpdated" class="peer hidden" />
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
								<input type="checkbox" name="filters.country" value="{{ $country->id }}" id="watch-country-{{ $country->id }}" wire:model="filters.country" wire:change="finderUpdated" class="peer hidden" />
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
			@elseif($activeStep == 2)
				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_diameter" :value="__('What about the case diameter ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_diameter'] as $caseDiameter)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_diameter" value="{{ $caseDiameter }}" id="watch-case-diameter-{{ $caseDiameter }}" wire:model="filters.case_diameter" wire:change="finderUpdated" class="peer hidden" />
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_thickness" :value="__('What about the case thickness ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_thickness'] as $caseThickness)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_thickness" value="{{ $caseThickness }}" id="watch-case-thickness-{{ $caseThickness }}" wire:model="filters.case_thickness" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-thickness-{{ $caseThickness }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ $caseThickness }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_lug_to_lug" :value="__('What about the case lug to lug ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_lug_to_lug'] as $caseLugToLug)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_lug_to_lug" value="{{ $caseLugToLug }}" id="watch-case-lug-to-lug-{{ $caseLugToLug }}" wire:model="filters.case_lug_to_lug" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-lug-to-lug-{{ $caseLugToLug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ $caseLugToLug }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_lug_width" :value="__('What about the case lug width ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_lug_width'] as $caseLugWidth)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_lug_width" value="{{ $caseLugWidth }}" id="watch-case-lug-width-{{ $caseLugWidth }}" wire:model="filters.case_lug_width" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-lug-width-{{ $caseLugWidth }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ $caseLugWidth }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_material" :value="__('What about the case material ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_material'] as $caseMaterialId => $caseMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_material" value="{{ $caseMaterialId }}" id="watch-case-material-{{ $caseMaterialId }}" wire:model="filters.case_material" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-material-{{ $caseMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ ucfirst(__($caseMaterialName)) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_color" :value="__('What about the case color ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_color'] as $caseColorId => $caseColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_color" value="{{ $caseColorId }}" id="watch-case-color-{{ $caseColorId }}" wire:model="filters.case_color" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-color-{{ $caseColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ ucfirst(__($caseColorName)) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_open_case_back" :value="__('Do you want the case back to be opened ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_open_case_back'] as $caseOpenCaseBack)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_open_case_back" value="{{ $caseOpenCaseBack }}" id="watch-case-open-case-back-{{ $caseOpenCaseBack }}" wire:model="filters.case_open_case_back" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-open-case-back-{{ $caseOpenCaseBack }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ boolLabel($caseOpenCaseBack) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_sapphire_crystal_case_back" :value="__('Do you want the case back crystal to be a sapphire crystal ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_sapphire_crystal_case_back'] as $caseSapphireCrystalCaseBack)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_sapphire_crystal_case_back" value="{{ $caseSapphireCrystalCaseBack }}" id="watch-case-sapphire-crystal-case-back-{{ $caseSapphireCrystalCaseBack }}" wire:model="filters.case_sapphire_crystal_case_back" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-sapphire-crystal-case-back-{{ $caseSapphireCrystalCaseBack }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ boolLabel($caseSapphireCrystalCaseBack) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_waterproofness" :value="__('What about the case waterproofness ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_waterproofness'] as $caseWaterproofness)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_waterproofness" value="{{ $caseWaterproofness }}" id="watch-case-waterproofness-{{ $caseWaterproofness }}" wire:model="filters.case_waterproofness" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-case-waterproofness-{{ $caseWaterproofness }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ $caseWaterproofness }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@elseif($activeStep == 3)

			@endif

			<div class="flex flex-row justify-end mt-10">
				<x-front.primary-button wire:click="nextStep">
					@if($activeStep < $totalSteps)
						{{ __('Next') }}

						<svg class="ml-2" width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.85938 1.5L7.31392 6.5L1.85938 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					@elseif($activeStep == $totalSteps)
						{{ __('Find my next watch !') }}
					@endif
				</x-front.primary-button>
			</div>
		</div>
	</div>
</div>