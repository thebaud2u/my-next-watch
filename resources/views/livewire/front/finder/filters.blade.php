<div>
	<div class="flex flex-row justify-center m-4">
		<div class="flex flex-col p-8">
			{{-- Generalities filters --}}
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
			{{-- Case dimensions filters --}}
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
			{{-- Case color, material and case back details filters --}}
			@elseif($activeStep == 3)
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
							@php
								$value = $caseOpenCaseBack ? '1' : '0';
							@endphp
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_open_case_back" value="{{ $value }}" id="watch-case-open-case-back-{{ $value }}" wire:model="filters.case_open_case_back" wire:change="finderUpdated" class="peer hidden" />
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_sapphire_crystal_case_back" :value="__('Do you want the case back crystal to be a sapphire crystal ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['case_sapphire_crystal_case_back'] as $caseSapphireCrystalCaseBack)
							@php
								$value = $caseSapphireCrystalCaseBack ? '1' : '0';
							@endphp
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_sapphire_crystal_case_back" value="{{ $value }}" id="watch-case-sapphire-crystal-case-back-{{ $value }}" wire:model="filters.case_sapphire_crystal_case_back" wire:change="finderUpdated" class="peer hidden" />
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
			{{-- Bezel filters --}}
			@elseif($activeStep == 4)
				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_direction" :value="__('What about the bezel direction ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['bezel_direction'] as $bezelDirection)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_direction" value="{{ $bezelDirection }}" id="watch-bezel-direction-{{ $bezelDirection }}" wire:model="filters.bezel_direction" wire:change="finderUpdated" class="peer hidden" />
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_color" :value="__('What about the bezel color ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['bezel_color'] as $bezelColorId => $bezelColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_color" value="{{ $bezelColorId }}" id="watch-bezel-color-{{ $bezelColorId }}" wire:model="filters.bezel_color" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-bezel-color-{{ $bezelColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_marking" :value="__('What about the bezel marking ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['bezel_marking'] as $bezelMarkingId => $bezelMarkingName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_marking" value="{{ $bezelMarkingId }}" id="watch-bezel-marking-{{ $bezelMarkingId }}" wire:model="filters.bezel_marking" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-bezel-marking-{{ $bezelMarkingId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_material" :value="__('What about the bezel material ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['bezel_material'] as $bezelMaterialId => $bezelMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_material" value="{{ $bezelMaterialId }}" id="watch-bezel-material-{{ $bezelMaterialId }}" wire:model="filters.bezel_material" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-bezel-material-{{ $bezelMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
			@elseif($activeStep == 5)
				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.crystal_domed" :value="__('Do you want the crystal to be domed ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['crystal_domed'] as $crystalDomed)
							@php
								$value = $crystalDomed ? '1' : '0';
							@endphp
							<div class="w-full p-2">
								<input type="checkbox" name="filters.crystal_domed" value="{{ $value }}" id="watch-crystal-domed-{{ $value }}" wire:model="filters.crystal_domed" wire:change="finderUpdated" class="peer hidden" />
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

				<div class="flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.crystal_material" :value="__('What about the crystal material ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['crystal_material'] as $crystalMaterialId => $crystalMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.crystal_material" value="{{ $crystalMaterialId }}" id="watch-crystal-material-{{ $crystalMaterialId }}" wire:model="filters.crystal_material" wire:change="finderUpdated" class="peer hidden" />
								<label for="watch-crystal-material-{{ $crystalMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-between mt-10">
				<div class="flex gap-x-4 text-sm font-bold">
					@if($activeStep > 1)
						<x-front.secondary-button wire:click="previousStep" :class="'flex gap-x-2 items-center cursor-pointer'">
							<svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.5166 1.5L2.15296 5.5L6.5166 9.5" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							{{ __('Previous') }}
						</x-front.secondary-button>
					@endif
				</div>

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