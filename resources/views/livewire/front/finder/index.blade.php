<div class="min-h-screen flex justify-center">
	@if(!$showFoundWatch)
		<div class="w-full max-w-5xl flex flex-col px-8 py-8" x-data x-on:watch-finder.window="$nextTick(() => $el.scrollIntoView({ behavior: 'smooth', block: 'start' }))">
			<div class="flex-1">
				<div class="px-4 mb-6">
					<h2 class="font-bold text-[28px]">
						{{ __('Let\'s find your next watch') }}
					</h2>
				</div>

				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.type" :value="__('What type of watch are you interested in ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['type'] as $type)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.type" value="{{ $type->slug }}" id="watch-type-{{ $type->slug }}" wire:model="filters.type" wire:change="finderUpdated('type')" class="peer hidden" />
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

				@if(count($filters['type']) > 0 && count($data['country']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.country" :value="__('A country preference ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['country'] as $countrySlug => $countryName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.country" value="{{ $countrySlug }}" id="watch-country-{{ $countrySlug }}" wire:model="filters.country" wire:change="finderUpdated('country')" class="peer hidden" />
									<label for="watch-country-{{ $countrySlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst($countryName) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['country']) > 0 && count($data['case_diameter']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_diameter" :value="__('What about the case diameter ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_diameter'] as $caseDiameter)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_diameter" value="{{ $caseDiameter }}" id="watch-case-diameter-{{ $caseDiameter }}" wire:model="filters.case_diameter" wire:change="finderUpdated('case_diameter')" class="peer hidden" />
									<label for="watch-case-diameter-{{ $caseDiameter }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $caseDiameter }}mm
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['case_diameter']) > 0 && count($data['case_thickness']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_thickness" :value="__('What about the case thickness ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_thickness'] as $index => $caseThickness)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_thickness" value="{{ $caseThickness }}" id="watch-case-thickness-{{ $index }}" wire:model="filters.case_thickness" wire:change="finderUpdated('case_thickness')" class="peer hidden" />
									<label for="watch-case-thickness-{{ $index }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $caseThickness }}mm
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['case_thickness']) > 0 && count($data['case_lug_width']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_lug_width" :value="__('What about the case lug width ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_lug_width'] as $index => $caseLugWidth)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_lug_width" value="{{ $caseLugWidth }}" id="watch-case-lug-width-{{ $index }}" wire:model="filters.case_lug_width" wire:change="finderUpdated('case_lug_width')" class="peer hidden" />
									<label for="watch-case-lug-width-{{ $index }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $caseLugWidth }}mm
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['case_lug_width']) > 0 && count($data['case_lug_to_lug']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_lug_to_lug" :value="__('What about the case lug to lug ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_lug_to_lug'] as $index => $caseLugToLug)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_lug_to_lug" value="{{ $caseLugToLug }}" id="watch-case-lug-to-lug-{{ $index }}" wire:model="filters.case_lug_to_lug" wire:change="finderUpdated('case_lug_to_lug')" class="peer hidden" />
									<label for="watch-case-lug-to-lug-{{ $index }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $caseLugToLug }}mm
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['case_lug_to_lug']) > 0 && count($data['case_material']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_material" :value="__('What about the case material ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_material'] as $caseMaterialSlug => $caseMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_material" value="{{ $caseMaterialSlug }}" id="watch-case-material-{{ $caseMaterialSlug }}" wire:model="filters.case_material" wire:change="finderUpdated('case_material')" class="peer hidden" />
									<label for="watch-case-material-{{ $caseMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@endif

				@if(count($filters['case_material']) > 0 && count($data['case_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_color" :value="__('What about the case color ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_color'] as $caseColorSlug => $caseColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_color" value="{{ $caseColorSlug }}" id="watch-case-color-{{ $caseColorSlug }}" wire:model="filters.case_color" wire:change="finderUpdated('case_color')" class="peer hidden" />
									<label for="watch-case-color-{{ $caseColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@endif

				@if(count($filters['case_color']) > 0 && count($data['case_open_case_back']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_open_case_back" :value="__('Do you want the case back to be opened ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_open_case_back'] as $caseOpenCaseBack)
								@php
									$value = $caseOpenCaseBack ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.case_open_case_back" value="{{ $value }}" id="watch-case-open-case-back-{{ $value }}" wire:model="filters.case_open_case_back" wire:change="finderUpdated('case_open_case_back')" class="peer hidden" />
									<label for="watch-case-open-case-back-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@endif

				@if(!is_null($filters['case_open_case_back']) && count($data['case_sapphire_crystal_case_back']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_sapphire_crystal_case_back" :value="__('Do you want the case back crystal to be a sapphire crystal ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_sapphire_crystal_case_back'] as $caseSapphireCrystalCaseBack)
								@php
									$value = $caseSapphireCrystalCaseBack ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.case_sapphire_crystal_case_back" value="{{ $value }}" id="watch-case-sapphire-crystal-case-back-{{ $value }}" wire:model="filters.case_sapphire_crystal_case_back" wire:change="finderUpdated('case_sapphire_crystal_case_back')" class="peer hidden" />
									<label for="watch-case-sapphire-crystal-case-back-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@endif

				@if(!is_null($filters['case_sapphire_crystal_case_back']) && count($data['case_waterproofness']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.case_waterproofness" :value="__('What about the case waterproofness ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['case_waterproofness'] as $caseWaterproofness)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.case_waterproofness" value="{{ $caseWaterproofness }}" id="watch-case-waterproofness-{{ $caseWaterproofness }}" wire:model="filters.case_waterproofness" wire:change="finderUpdated('case_waterproofness')" class="peer hidden" />
									<label for="watch-case-waterproofness-{{ $caseWaterproofness }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $caseWaterproofness }}m
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['case_open_case_back']) && count($data['movement_type']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.movement_type" :value="__('What about the movement type ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['movement_type'] as $movementType)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.movement_type" value="{{ $movementType }}" id="watch-movement-type-{{ $movementType }}" wire:model="filters.movement_type" wire:change="finderUpdated('movement_type')" class="peer hidden" />
									<label for="watch-movement-type-{{ $movementType }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($movementType)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['movement_type']) > 0 && count($data['movement_COSC']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.movement_COSC" :value="__('Do you want the movement to be COSC Certified ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['movement_COSC'] as $movementCOSC)
								@php
									$value = $movementCOSC ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.movement_COSC" value="{{ $value }}" id="watch-movement-COSC-{{ $value }}" wire:model="filters.movement_COSC" wire:change="finderUpdated('movement_COSC')" class="peer hidden" />
									<label for="watch-movement-COSC-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($movementCOSC) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['movement_METAS']) && count($data['movement_METAS']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.movement_METAS" :value="__('Do you want the movement to be METAS Certified ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['movement_METAS'] as $movementMETAS)
								@php
									$value = $movementMETAS ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.movement_METAS" value="{{ $value }}" id="watch-movement-METAS-{{ $value }}" wire:model="filters.movement_METAS" wire:change="finderUpdated('movement_METAS')" class="peer hidden" />
									<label for="watch-movement-METAS-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($movementMETAS) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['movement_METAS']) && count($data['movement_manufactured_caliber']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.movement_manufactured_caliber" :value="__('Do you want the caliber to be manufactured ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['movement_manufactured_caliber'] as $movementManufacturedCaliber)
								@php
									$value = $movementManufacturedCaliber ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.movement_manufactured_caliber" value="{{ $value }}" id="watch-movement-manufactured-caliber-{{ $value }}" wire:model="filters.movement_manufactured_caliber" wire:change="finderUpdated('movement_manufactured_caliber')" class="peer hidden" />
									<label for="watch-movement-manufactured-caliber-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($movementManufacturedCaliber) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['movement_manufactured_caliber']) && count($data['power_reserve']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.power_reserve" :value="__('What about the power reserve ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['power_reserve'] as $powerReserve)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.power_reserve" value="{{ $powerReserve }}" id="watch-power-reserve-{{ $powerReserve }}" wire:model="filters.power_reserve" wire:change="finderUpdated('power_reserve')" class="peer hidden" />
									<label for="watch-power-reserve-{{ $powerReserve }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ $powerReserve }}h
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['power_reserve']) > 0 && count($data['complication']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.complication" :value="__('What about the watch complication ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['complication'] as $complicationSlug => $complicationName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.complication" value="{{ $complicationSlug }}" id="watch-complication-{{ $complicationSlug }}" wire:model="filters.complication" wire:change="finderUpdated('complication')" class="peer hidden" />
									<label for="watch-complication-{{ $complicationSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($complicationName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['complication']) > 0 && count($data['bezel_direction']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bezel_direction" :value="__('What about the bezel direction ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bezel_direction'] as $bezelDirection)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bezel_direction" value="{{ $bezelDirection }}" id="watch-bezel-direction-{{ $bezelDirection }}" wire:model="filters.bezel_direction" wire:change="finderUpdated('bezel_direction')" class="peer hidden" />
									<label for="watch-bezel-direction-{{ $bezelDirection }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($bezelDirection)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['bezel_direction']) > 0 && count($data['bezel_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bezel_color" :value="__('What about the bezel color ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bezel_color'] as $bezelColorSlug => $bezelColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bezel_color" value="{{ $bezelColorSlug }}" id="watch-bezel-color-{{ $bezelColorSlug }}" wire:model="filters.bezel_color" wire:change="finderUpdated('bezel_color')" class="peer hidden" />
									<label for="watch-bezel-color-{{ $bezelColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($bezelColorName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['bezel_color']) > 0 && count($data['bezel_marking']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bezel_marking" :value="__('What about the bezel marking ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bezel_marking'] as $bezelMarkingSlug => $bezelMarkingName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bezel_marking" value="{{ $bezelMarkingSlug }}" id="watch-bezel-marking-{{ $bezelMarkingSlug }}" wire:model="filters.bezel_marking" wire:change="finderUpdated('bezel_marking')" class="peer hidden" />
									<label for="watch-bezel-marking-{{ $bezelMarkingSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($bezelMarkingName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['bezel_marking']) > 0 && count($data['bezel_material']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bezel_material" :value="__('What about the bezel material ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bezel_material'] as $bezelMaterialSlug => $bezelMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bezel_material" value="{{ $bezelMaterialSlug }}" id="watch-bezel-material-{{ $bezelMaterialSlug }}" wire:model="filters.bezel_material" wire:change="finderUpdated('bezel_material')" class="peer hidden" />
									<label for="watch-bezel-material-{{ $bezelMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($bezelMaterialName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['bezel_material']) > 0 && count($data['crystal_domed']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crystal_domed" :value="__('Do you want the crystal to be domed ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crystal_domed'] as $crystalDomed)
								@php
									$value = $crystalDomed ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.crystal_domed" value="{{ $value }}" id="watch-crystal-domed-{{ $value }}" wire:model="filters.crystal_domed" wire:change="finderUpdated('crystal_domed')" class="peer hidden" />
									<label for="watch-crystal-domed-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($crystalDomed) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['crystal_domed']) && count($data['crystal_material']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crystal_material" :value="__('What about the crystal material ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crystal_material'] as $crystalMaterialSlug => $crystalMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.crystal_material" value="{{ $crystalMaterialSlug }}" id="watch-crystal-material-{{ $crystalMaterialSlug }}" wire:model="filters.crystal_material" wire:change="finderUpdated('crystal_material')" class="peer hidden" />
									<label for="watch-crystal-material-{{ $crystalMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($crystalMaterialName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['crystal_material']) > 0 && count($data['crown_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crown_color" :value="__('What about the crown color ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crown_color'] as $crownColorSlug => $crownColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.crown_color" value="{{ $crownColorSlug }}" id="watch-crown-color-{{ $crownColorSlug }}" wire:model="filters.crown_color" wire:change="finderUpdated('crown_color')" class="peer hidden" />
									<label for="watch-crown-color-{{ $crownColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($crownColorName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['crown_color']) > 0 && count($data['crown_detail']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crown_detail" :value="__('What detail would like the crown to have ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crown_detail'] as $index => $crownDetail)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.crown_detail" value="{{ $crownDetail }}" id="watch-crown-detail-{{ $index }}" wire:model="filters.crown_detail" wire:change="finderUpdated('crown_detail')" class="peer hidden" />
									<label for="watch-crown-detail-{{ $index }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ __($crownDetail) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['crown_detail']) > 0 && count($data['crown_material']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crown_material" :value="__('What about the crystal material ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crown_material'] as $crownMaterialSlug => $crownMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.crown_material" value="{{ $crownMaterialSlug }}" id="watch-crown-material-{{ $crownMaterialSlug }}" wire:model="filters.crown_material" wire:change="finderUpdated('crown_material')" class="peer hidden" />
									<label for="watch-crown-material-{{ $crownMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($crownMaterialName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['crown_material']) > 0 && count($data['crown_screwed_down']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.crown_screwed_down" :value="__('Do you want the crown to be screwed down ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['crown_screwed_down'] as $crownScrewedDown)
								@php
									$value = $crownScrewedDown ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.crown_screwed_down" value="{{ $value }}" id="watch-crown-screwed-down-{{ $value }}" wire:model="filters.crown_screwed_down" wire:change="finderUpdated('crown_screwed_down')" class="peer hidden" />
									<label for="watch-crown-screwed-down-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($crownScrewedDown) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['crown_screwed_down']) && count($data['dial_domed']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_domed" :value="__('Do you want the dial to be domed ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_domed'] as $dialDomed)
								@php
									$value = $dialDomed ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.dial_domed" value="{{ $value }}" id="watch-dial-domed-{{ $value }}" wire:model.live="filters.dial_domed" wire:change="finderUpdated('dial_domed')" class="peer hidden" />
									<label for="watch-dial-domed-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($dialDomed) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['dial_domed']) && count($data['dial_textured']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_textured" :value="__('Do you want the dial to be textured ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_textured'] as $dialTextured)
								@php
									$value = $dialTextured ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.dial_textured" value="{{ $value }}" id="watch-dial-textured-{{ $value }}" wire:model.live="filters.dial_textured" wire:change="finderUpdated('dial_textured')" class="peer hidden" />
									<label for="watch-dial-textured-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($dialTextured) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['dial_textured']) && count($data['dial_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_color" :value="__('What dial color would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_color'] as $dialColorSlug => $dialColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.dial_color" value="{{ $dialColorSlug }}" id="watch-dial-color-{{ $dialColorSlug }}" wire:model="filters.dial_color" wire:change="finderUpdated('dial_color')" class="peer hidden" />
									<label for="watch-dial-color-{{ $dialColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($dialColorName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['dial_color']) > 0 && count($data['dial_marker_type']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_marker_type" :value="__('What type of dial marker would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_marker_type'] as $dialMarkerTypeSlug => $dialMarkerTypeName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.dial_marker_type" value="{{ $dialMarkerTypeSlug }}" id="watch-dial-marker-type-{{ $dialMarkerTypeSlug }}" wire:model="filters.dial_marker_type" wire:change="finderUpdated('dial_marker_type')" class="peer hidden" />
									<label for="watch-dial-marker-type-{{ $dialMarkerTypeSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($dialMarkerTypeName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['dial_marker_type']) > 0 && count($data['dial_marker_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_marker_color" :value="__('What marker color would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_marker_color'] as $dialMarkerColorSlug => $dialMarkerColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.dial_marker_color" value="{{ $dialMarkerColorSlug }}" id="watch-dial-marker-color-{{ $dialMarkerColorSlug }}" wire:model="filters.dial_marker_color" wire:change="finderUpdated('dial_marker_color')" class="peer hidden" />
									<label for="watch-dial-marker-color-{{ $dialMarkerColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($dialMarkerColorName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['dial_marker_color']) > 0 && count($data['dial_marker_lume']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_marker_lume" :value="__('Do you want the dial marker to have lume ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_marker_lume'] as $dialMarkerLume)
								@php
									$value = $dialMarkerLume ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.dial_marker_lume" value="{{ $value }}" id="watch-dial-marker-lume-{{ $value }}" wire:model.live="filters.dial_marker_lume" wire:change="finderUpdated('dial_marker_lume')" class="peer hidden" />
									<label for="watch-dial-marker-lume-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ boolLabel($dialMarkerLume) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(!is_null($filters['dial_marker_lume']) && count($data['dial_marker_lume_color']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.dial_marker_lume_color" :value="__('What marker lume color would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['dial_marker_lume_color'] as $dialMarkerLumeColorSlug => $dialMarkerLumeColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.dial_marker_lume_color" value="{{ $dialMarkerLumeColorSlug }}" id="watch-dial-marker-lume-color-{{ $dialMarkerLumeColorSlug }}" wire:model="filters.dial_marker_lume_color" wire:change="finderUpdated('dial_marker_lume_color')" class="peer hidden" />
									<label for="watch-dial-marker-lume-color-{{ $dialMarkerLumeColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($dialMarkerLumeColorName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['dial_marker_lume_color']) > 0 && count($data['bracelet_type']) > 1)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_type" :value="__('What about the bracelet type ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_type'] as $braceletTypeSlug => $braceletTypeName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_type" value="{{ $braceletTypeSlug }}" id="watch-bracelet-type-{{ $braceletTypeSlug }}" wire:model="filters.bracelet_type" wire:change="finderUpdated('bracelet_type')" class="peer hidden" />
									<label for="watch-bracelet-type-{{ $braceletTypeSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
										<div>
											<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
												<span>
													{{ ucfirst(__($braceletTypeName)) }}
												</span>
											</h3>
										</div>
									</label>
								</div>
							@endforeach
						</div>
					</div>
				@endif

				@if(count($filters['bracelet_type']) > 0)
					@if(in_array('bracelet', $filters['bracelet_type']) && count($data['bracelet_material']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_material" :value="__('What should the bracelet be made of ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_material'] as $braceletMaterialSlug => $braceletMaterialName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_material" value="{{ $braceletMaterialSlug }}" id="watch-bracelet-material-{{ $braceletMaterialSlug }}" wire:model="filters.bracelet_material" wire:change="finderUpdated('bracelet_material')" class="peer hidden" />
										<label for="watch-bracelet-material-{{ $braceletMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletMaterialName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>

						@if(count($filters['bracelet_material']) > 0 && count($data['bracelet_micro_adjustement']) > 1)
							<div class="finder-step flex flex-col gap-4 my-4">
								<x-front.input-label for="filters.bracelet_micro_adjustement" :value="__('Do you want the bracelet clasp to have a micro adjustement system ?')" :class="'pl-4'"/>

								<div class="flex flex-row justify-center items-center">
									@foreach($data['bracelet_micro_adjustement'] as $braceletMicroAdjustement)
										@php
											$value = $braceletMicroAdjustement ? '1' : '0';
										@endphp
										<div class="w-full p-2">
											<input type="radio" name="filters.bracelet_micro_adjustement" value="{{ $value }}" id="watch-bracelet-micro-adjustement-{{ $value }}" wire:model.live="filters.bracelet_micro_adjustement" wire:change="finderUpdated('bracelet_micro_adjustement')" class="peer hidden" />
											<label for="watch-bracelet-micro-adjustement-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
												<div>
													<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
														<span>
															{{ boolLabel($braceletMicroAdjustement) }}
														</span>
													</h3>
												</div>
											</label>
										</div>
									@endforeach
								</div>
							</div>
						@endif

						@if(!is_null($filters['bracelet_micro_adjustement']) && count($data['bracelet_micro_adjustement_system']) > 1)
							<div class="finder-step flex flex-col gap-4 my-4">
								<x-front.input-label for="filters.bracelet_micro_adjustement_system" :value="__('What micro adjustement system ?')" :class="'pl-4'"/>

								<div class="flex flex-row justify-center items-center">
									@foreach($data['bracelet_micro_adjustement_system'] as $braceletMicroAdjustementSystemSlug => $braceletMicroAdjustementSystemName)
										<div class="w-full p-2">
											<input type="checkbox" name="filters.bracelet_micro_adjustement_system" value="{{ $braceletMicroAdjustementSystemSlug }}" id="watch-bracelet-micro-adjustement-system-{{ $braceletMicroAdjustementSystemSlug }}" wire:model="filters.bracelet_micro_adjustement_system" wire:change="finderUpdated('bracelet_micro_adjustement_system')" class="peer hidden" />
											<label for="watch-bracelet-micro-adjustement-system-{{ $braceletMicroAdjustementSystemSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
												<div>
													<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
														<span>
															{{ ucfirst(__($braceletMicroAdjustementSystemName)) }}
														</span>
													</h3>
												</div>
											</label>
										</div>
									@endforeach
								</div>
							</div>
						@endif
					@endif

					@if(((count($filters['bracelet_type']) == 1 && in_array('strap', $filters['bracelet_type'])) || (count($filters['bracelet_type']) > 0 && in_array('strap', $filters['bracelet_type']) && !is_null($filters['bracelet_micro_adjustement']) && count($filters['bracelet_micro_adjustement_system']) > 0)) && count($data['bracelet_stitching']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_stitching" :value="__('Do you want the strap to have stitching ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_stitching'] as $braceletStitching)
									@php
										$value = $braceletStitching ? '1' : '0';
									@endphp
									<div class="w-full p-2">
										<input type="radio" name="filters.bracelet_stitching" value="{{ $value }}" id="watch-bracelet-stitching-{{ $value }}" wire:model.live="filters.bracelet_stitching" wire:change="finderUpdated('bracelet_stitching')" class="peer hidden" />
										<label for="watch-bracelet-stitching-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ boolLabel($braceletStitching) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>

						@if(!is_null($filters['bracelet_stitching']) && count($data['bracelet_stitching_color']) > 0)
							<div class="finder-step flex flex-col gap-4 my-4">
								<x-front.input-label for="filters.bracelet_stitching_color" :value="__('What stitching color would you like ?')" :class="'pl-4'"/>

								<div class="flex flex-row justify-center items-center">
									@foreach($data['bracelet_stitching_color'] as $braceletStitchingColorSlug => $braceletStitchingColorName)
										<div class="w-full p-2">
											<input type="checkbox" name="filters.bracelet_stitching_color" value="{{ $braceletStitchingColorSlug }}" id="watch-bracelet-stitching-color-{{ $braceletStitchingColorSlug }}" wire:model="filters.bracelet_stitching_color" wire:change="finderUpdated('bracelet_stitching_color')" class="peer hidden" />
											<label for="watch-bracelet-stitching-color-{{ $braceletStitchingColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
												<div>
													<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
														<span>
															{{ ucfirst(__($braceletStitchingColorName)) }}
														</span>
													</h3>
												</div>
											</label>
										</div>
									@endforeach
								</div>
							</div>
						@endif
					@endif

					@if(count($filters['bracelet_material']) > 0 && count($data['bracelet_color']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_color" :value="__('What color should have the bracelet ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_color'] as $braceletColorlSlug => $braceletColorName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_color" value="{{ $braceletColorlSlug }}" id="watch-bracelet-color-{{ $braceletColorlSlug }}" wire:model="filters.bracelet_color" wire:change="finderUpdated('bracelet_color')" class="peer hidden" />
										<label for="watch-bracelet-color-{{ $braceletColorlSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletColorName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					@if(count($filters['bracelet_color']) > 0 && count($data['bracelet_style']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_style" :value="__('What bracelet style would you like ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_style'] as $braceletStyleSlug => $braceletStyleName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_style" value="{{ $braceletStyleSlug }}" id="watch-bracelet-material-{{ $braceletStyleSlug }}" wire:model="filters.bracelet_style" wire:change="finderUpdated('bracelet_style')" class="peer hidden" />
										<label for="watch-bracelet-material-{{ $braceletStyleSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletStyleName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					@if(count($filters['bracelet_style']) > 0 && count($data['bracelet_clasp']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_clasp" :value="__('What bracelet clasp would you like ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_clasp'] as $braceletClaspSlug => $braceletClaspName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_clasp" value="{{ $braceletClaspSlug }}" id="watch-bracelet-clasp-{{ $braceletClaspSlug }}" wire:model="filters.bracelet_clasp" wire:change="finderUpdated('bracelet_clasp')" class="peer hidden" />
										<label for="watch-bracelet-clasp-{{ $braceletClaspSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletClaspName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					@if(count($filters['bracelet_clasp']) > 0 && count($data['bracelet_clasp_color']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_clasp_color" :value="__('What bracelet clasp color would you like ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_clasp_color'] as $braceletClaspColorSlug => $braceletClaspColorName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_clasp_color" value="{{ $braceletClaspColorSlug }}" id="watch-bracelet-clasp-color-{{ $braceletClaspColorSlug }}" wire:model="filters.bracelet_clasp_color" wire:change="finderUpdated('bracelet_clasp_color')" class="peer hidden" />
										<label for="watch-bracelet-clasp-color-{{ $braceletClaspColorSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletClaspColorName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					@if(count($filters['bracelet_clasp_color']) > 0 && count($data['bracelet_clasp_material']) > 1)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_clasp_material" :value="__('What bracelet clasp material would you like ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_clasp_material'] as $braceletClaspMaterialSlug => $braceletClaspMaterialName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_clasp_material" value="{{ $braceletClaspMaterialSlug }}" id="watch-bracelet-clasp-material-{{ $braceletClaspMaterialSlug }}" wire:model="filters.bracelet_clasp_material" wire:change="finderUpdated('bracelet_clasp_material')" class="peer hidden" />
										<label for="watch-bracelet-clasp-material-{{ $braceletClaspMaterialSlug }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
											<div>
												<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
													<span>
														{{ ucfirst(__($braceletClaspMaterialName)) }}
													</span>
												</h3>
											</div>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					@endif
				@endif
			</div>

			<div class="flex justify-end mt-auto pt-8">
				<x-front.primary-button wire:click="findMyWatch">
					{{ __('Find my next watch !') }}
				</x-front.primary-button>
			</div>
		</div>
	@else
		<div class="w-full max-w-5xl flex flex-col px-8 py-8"  x-data x-on:watch-found.window="$nextTick(() => $el.scrollIntoView({ behavior: 'smooth', block: 'start' }))">
			<div class="flex-1">
				<div class="px-4 mb-6">
					<h2 class="font-bold text-[28px]">
						{{ __('Watches matching') }}
					</h2>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
					@foreach($watches as $watch)
						@include('components.front.finder.list-entry')
					@endforeach
				</div>
			</div>

			@if($watches->hasPages())
				<div class="my-8">
					{{ $watches->links() }}
				</div>
			@endif

			<div class="flex justify-end mt-auto pt-8">
				<x-front.primary-button wire:click="showFinder">
					{{ __('I want to find something more specific') }}
				</x-front.primary-button>
			</div>
		</div>
	@endif

	@push('scripts')
		<script>
			document.addEventListener('livewire:initialized', () => {
				Livewire.hook('morph.updated', ({ component }) => {
					requestAnimationFrame(() => {
						const steps = document.querySelectorAll('.finder-step');
						const last = steps[steps.length - 1];
						if(last) last.scrollIntoView({ behavior: 'smooth', block: 'start' });
					});
				});
			});
		</script>
	@endpush
</div>