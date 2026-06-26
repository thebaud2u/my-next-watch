<div class="min-h-screen flex justify-center">
	<div class="w-full max-w-5xl flex flex-col px-8 py-8">
		<div class="flex-1">
			<div class="finder-step flex flex-col gap-4 my-4">
				<x-front.input-label for="filters.country" :value="__('What type of watch are you interested in ?')" :class="'pl-4'"/>

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

				<div class="flex flex-row items-center justify-center">
					@error('filters.type')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			@if(count($filters['type']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.country" :value="__('A country preference ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['country'] as $countryId => $countryName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.country" value="{{ $countryId }}" id="watch-country-{{ $countryId }}" wire:model="filters.country" wire:change="finderUpdated('country')" class="peer hidden" />
								<label for="watch-country-{{ $countryId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

					<div class="flex flex-row items-center justify-center">
						@error('filters.country')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				</div>
			@endif

			@if(count($filters['country']) > 0)
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
												{{ $caseDiameter }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@endif

			@if(count($filters['case_diameter']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_thickness" :value="__('What about the case thickness ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['case_thickness'] as $caseThickness)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_thickness" value="{{ $caseThickness }}" id="watch-case-thickness-{{ $caseThickness }}" wire:model="filters.case_thickness" wire:change="finderUpdated('case_thickness')" class="peer hidden" />
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
			@endif

			@if(count($filters['case_thickness']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_lug_width" :value="__('What about the case lug width ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['case_lug_width'] as $caseLugWidth)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_lug_width" value="{{ $caseLugWidth }}" id="watch-case-lug-width-{{ $caseLugWidth }}" wire:model="filters.case_lug_width" wire:change="finderUpdated('case_lug_width')" class="peer hidden" />
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
			@endif

			@if(count($filters['case_lug_width']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_lug_to_lug" :value="__('What about the case lug to lug ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['case_lug_to_lug'] as $caseLugToLug)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_lug_to_lug" value="{{ $caseLugToLug }}" id="watch-case-lug-to-lug-{{ $caseLugToLug }}" wire:model="filters.case_lug_to_lug" wire:change="finderUpdated('case_lug_to_lug')" class="peer hidden" />
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
			@endif

			@if(count($filters['case_lug_to_lug']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_material" :value="__('What about the case material ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['case_material'] as $caseMaterialId => $caseMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_material" value="{{ $caseMaterialId }}" id="watch-case-material-{{ $caseMaterialId }}" wire:model="filters.case_material" wire:change="finderUpdated('case_material')" class="peer hidden" />
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
			@endif

			@if(count($filters['case_material']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.case_color" :value="__('What about the case color ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['case_color'] as $caseColorId => $caseColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.case_color" value="{{ $caseColorId }}" id="watch-case-color-{{ $caseColorId }}" wire:model="filters.case_color" wire:change="finderUpdated('case_color')" class="peer hidden" />
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
			@endif

			@if(count($filters['case_color']) > 0)
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

			@if(!is_null($filters['case_open_case_back']))
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

			@if(!is_null($filters['case_sapphire_crystal_case_back']))
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
												{{ $caseWaterproofness }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@endif

			@if(count($filters['case_waterproofness']) > 0)
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

			@if(count($filters['bezel_direction']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_color" :value="__('What about the bezel color ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['bezel_color'] as $bezelColorId => $bezelColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_color" value="{{ $bezelColorId }}" id="watch-bezel-color-{{ $bezelColorId }}" wire:model="filters.bezel_color" wire:change="finderUpdated('bezel_color')" class="peer hidden" />
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
			@endif

			@if(count($filters['bezel_color']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_marking" :value="__('What about the bezel marking ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['bezel_marking'] as $bezelMarkingId => $bezelMarkingName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_marking" value="{{ $bezelMarkingId }}" id="watch-bezel-marking-{{ $bezelMarkingId }}" wire:model="filters.bezel_marking" wire:change="finderUpdated('bezel_marking')" class="peer hidden" />
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
			@endif

			@if(count($filters['bezel_marking']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bezel_material" :value="__('What about the bezel material ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['bezel_material'] as $bezelMaterialId => $bezelMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bezel_material" value="{{ $bezelMaterialId }}" id="watch-bezel-material-{{ $bezelMaterialId }}" wire:model="filters.bezel_material" wire:change="finderUpdated('bezel_material')" class="peer hidden" />
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
			@endif

			@if(count($filters['bezel_material']) > 0)
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

			@if(!is_null($filters['crystal_domed']))
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.crystal_material" :value="__('What about the crystal material ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['crystal_material'] as $crystalMaterialId => $crystalMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.crystal_material" value="{{ $crystalMaterialId }}" id="watch-crystal-material-{{ $crystalMaterialId }}" wire:model="filters.crystal_material" wire:change="finderUpdated('crystal_material')" class="peer hidden" />
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

			@if(count($filters['crystal_material']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.crown_color" :value="__('What about the crown color ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['crown_color'] as $crownColorId => $crownColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.crown_color" value="{{ $crownColorId }}" id="watch-crown-color-{{ $crownColorId }}" wire:model="filters.crown_color" wire:change="finderUpdated('crown_color')" class="peer hidden" />
								<label for="watch-crown-color-{{ $crownColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['crown_color']) > 0)
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

			@if(count($filters['crown_detail']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.crown_material" :value="__('What about the crystal material ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['crown_material'] as $crownMaterialId => $crownMaterialName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.crown_material" value="{{ $crownMaterialId }}" id="watch-crown-material-{{ $crownMaterialId }}" wire:model="filters.crown_material" wire:change="finderUpdated('crown_material')" class="peer hidden" />
								<label for="watch-crown-material-{{ $crownMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['crown_material']) > 0)
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

			@if(!is_null($filters['crown_screwed_down']))
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

			@if(!is_null($filters['dial_domed']))
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.dial_skeleton" :value="__('Do you want a skeleton dial ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['dial_skeleton'] as $dialSkeleton)
							@php
								$value = $dialSkeleton ? '1' : '0';
							@endphp
							<div class="w-full p-2">
								<input type="radio" name="filters.dial_skeleton" value="{{ $value }}" id="watch-dial-skeleton-{{ $value }}" wire:model.live="filters.dial_skeleton" wire:change="finderUpdated('dial_skeleton')" class="peer hidden" />
								<label for="watch-dial-skeleton-{{ $value }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row p-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px]">
											<span>
												{{ boolLabel($dialSkeleton) }}
											</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@endif

			@if(!is_null($filters['dial_skeleton']))
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

			@if(!is_null($filters['dial_textured']))
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.dial_color" :value="__('What dial color would you like ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['dial_color'] as $dialColorId => $dialColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.dial_color" value="{{ $dialColorId }}" id="watch-dial-color-{{ $dialColorId }}" wire:model="filters.dial_color" wire:change="finderUpdated('dial_color')" class="peer hidden" />
								<label for="watch-dial-color-{{ $dialColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['dial_color']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.dial_marker_type" :value="__('What type of dial marker would you like ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['dial_marker_type'] as $dialMarkerTypeId => $dialMarkerTypeName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.dial_marker_type" value="{{ $dialMarkerTypeId }}" id="watch-dial-marker-type-{{ $dialMarkerTypeId }}" wire:model="filters.dial_marker_type" wire:change="finderUpdated('dial_marker_type')" class="peer hidden" />
								<label for="watch-dial-marker-type-{{ $dialMarkerTypeId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['dial_marker_type']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.dial_marker_color" :value="__('What marker color would you like ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['dial_marker_color'] as $dialMarkerColorId => $dialMarkerColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.dial_marker_color" value="{{ $dialMarkerColorId }}" id="watch-dial-marker-color-{{ $dialMarkerColorId }}" wire:model="filters.dial_marker_color" wire:change="finderUpdated('dial_marker_color')" class="peer hidden" />
								<label for="watch-dial-marker-color-{{ $dialMarkerColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['dial_marker_color']) > 0)
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

			@if(!is_null($filters['dial_marker_lume']))
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.dial_marker_lume_color" :value="__('What marker lume color would you like ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['dial_marker_lume_color'] as $dialMarkerLumeColorId => $dialMarkerLumeColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.dial_marker_lume_color" value="{{ $dialMarkerLumeColorId }}" id="watch-dial-marker-lume-color-{{ $dialMarkerLumeColorId }}" wire:model="filters.dial_marker_lume_color" wire:change="finderUpdated('dial_marker_lume_color')" class="peer hidden" />
								<label for="watch-dial-marker-lume-color-{{ $dialMarkerLumeColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

			@if(count($filters['dial_marker_lume_color']) > 0)
				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bracelet_type" :value="__('What about the bracelet type ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['bracelet_type'] as $braceletTypeId => $braceletTypeName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bracelet_type" value="{{ $braceletTypeId }}" id="watch-bracelet-type-{{ $braceletTypeId }}" wire:model="filters.bracelet_type" wire:change="braceletSteps('bracelet_type')" class="peer hidden" />
								<label for="watch-bracelet-type-{{ $braceletTypeId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@if(in_array('1', $filters['bracelet_type']))
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_material" :value="__('What should the bracelet be made of ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_material'] as $braceletMaterialId => $braceletMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_material" value="{{ $braceletMaterialId }}" id="watch-bracelet-material-{{ $braceletMaterialId }}" wire:model="filters.bracelet_material" wire:change="braceletSteps('bracelet_material')" class="peer hidden" />
									<label for="watch-bracelet-material-{{ $braceletMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

					@if(count($filters['bracelet_material']) > 0)
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_micro_adjustement" :value="__('Do you want the bracelet clasp to have a micro adjustement system ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_micro_adjustement'] as $braceletMicroAdjustement)
									@php
										$value = $braceletMicroAdjustement ? '1' : '0';
									@endphp
									<div class="w-full p-2">
										<input type="radio" name="filters.bracelet_micro_adjustement" value="{{ $value }}" id="watch-bracelet-micro-adjustement-{{ $value }}" wire:model.live="filters.bracelet_micro_adjustement" wire:change="braceletSteps('bracelet_micro_adjustement')" class="peer hidden" />
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

					@if(!is_null($filters['bracelet_micro_adjustement']))
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_micro_adjustement_system" :value="__('What micro adjustement system ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_micro_adjustement_system'] as $braceletMicroAdjustementSystemId => $braceletMicroAdjustementSystemName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_micro_adjustement_system" value="{{ $braceletMicroAdjustementSystemId }}" id="watch-bracelet-micro-adjustement-system-{{ $braceletMicroAdjustementSystemId }}" wire:model="filters.bracelet_micro_adjustement_system" wire:change="braceletSteps('bracelet_micro_adjustement_system')" class="peer hidden" />
										<label for="watch-bracelet-micro-adjustement-system-{{ $braceletMicroAdjustementSystemId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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
				@elseif(in_array('2', $filters['bracelet_type']))
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_stitching" :value="__('Do you want the strap to have stitching ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_stitching'] as $braceletStitching)
								@php
									$value = $braceletStitching ? '1' : '0';
								@endphp
								<div class="w-full p-2">
									<input type="radio" name="filters.bracelet_stitching" value="{{ $value }}" id="watch-bracelet-stitching-{{ $value }}" wire:model.live="filters.bracelet_stitching" wire:change="braceletSteps('bracelet_stitching')" class="peer hidden" />
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

					@if(!is_null($filters['bracelet_stitching']))
						<div class="finder-step flex flex-col gap-4 my-4">
							<x-front.input-label for="filters.bracelet_stitching_color" :value="__('What bracelet style would you like ?')" :class="'pl-4'"/>

							<div class="flex flex-row justify-center items-center">
								@foreach($data['bracelet_stitching_color'] as $braceletStitchingColorId => $braceletStitchingColorName)
									<div class="w-full p-2">
										<input type="checkbox" name="filters.bracelet_stitching_color" value="{{ $braceletStitchingColorId }}" id="watch-bracelet-stitching-color-{{ $braceletStitchingColorId }}" wire:model="filters.bracelet_stitching_color" wire:change="braceletSteps('bracelet_stitching_color')" class="peer hidden" />
										<label for="watch-bracelet-stitching-color-{{ $braceletStitchingColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				<div class="finder-step flex flex-col gap-4 my-4">
					<x-front.input-label for="filters.bracelet_color" :value="__('What color should have the bracelet ?')" :class="'pl-4'"/>

					<div class="flex flex-row justify-center items-center">
						@foreach($data['bracelet_color'] as $braceletColorlId => $braceletColorName)
							<div class="w-full p-2">
								<input type="checkbox" name="filters.bracelet_color" value="{{ $braceletColorlId }}" id="watch-bracelet-color-{{ $braceletColorlId }}" wire:model="filters.bracelet_color" wire:change="braceletSteps('bracelet_color')" class="peer hidden" />
								<label for="watch-bracelet-color-{{ $braceletColorlId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				@if(count($filters['bracelet_color']) > 0)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_style" :value="__('What bracelet style would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_style'] as $braceletStyleId => $braceletStyleName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_style" value="{{ $braceletStyleId }}" id="watch-bracelet-material-{{ $braceletStyleId }}" wire:model="filters.bracelet_style" wire:change="braceletSteps('bracelet_style')" class="peer hidden" />
									<label for="watch-bracelet-material-{{ $braceletStyleId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				@if(count($filters['bracelet_style']) > 0)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_clasp" :value="__('What bracelet clasp would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_clasp'] as $braceletClaspId => $braceletClaspName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_clasp" value="{{ $braceletClaspId }}" id="watch-bracelet-clasp-{{ $braceletClaspId }}" wire:model="filters.bracelet_clasp" wire:change="braceletSteps('bracelet_clasp')" class="peer hidden" />
									<label for="watch-bracelet-clasp-{{ $braceletClaspId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				@if(count($filters['bracelet_clasp']) > 0)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_clasp_color" :value="__('What bracelet clasp color would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_clasp_color'] as $braceletClaspColorId => $braceletClaspColorName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_clasp_color" value="{{ $braceletClaspColorId }}" id="watch-bracelet-clasp-color-{{ $braceletClaspColorId }}" wire:model="filters.bracelet_clasp_color" wire:change="braceletSteps('bracelet_clasp_color')" class="peer hidden" />
									<label for="watch-bracelet-clasp-color-{{ $braceletClaspColorId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

				@if(count($filters['bracelet_clasp_color']) > 0)
					<div class="finder-step flex flex-col gap-4 my-4">
						<x-front.input-label for="filters.bracelet_clasp_material" :value="__('What bracelet clasp material would you like ?')" :class="'pl-4'"/>

						<div class="flex flex-row justify-center items-center">
							@foreach($data['bracelet_clasp_material'] as $braceletClaspMaterialId => $braceletClaspMaterialName)
								<div class="w-full p-2">
									<input type="checkbox" name="filters.bracelet_clasp_material" value="{{ $braceletClaspMaterialId }}" id="watch-bracelet-clasp-material-{{ $braceletClaspMaterialId }}" wire:model="filters.bracelet_clasp_material" wire:change="braceletSteps('bracelet_clasp_material')" class="peer hidden" />
									<label for="watch-bracelet-clasp-material-{{ $braceletClaspMaterialId }}" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
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

		{{--
		<div class="mt-auto pt-8">
			<div class="flex justify-between">
				<div class="flex gap-x-4 text-sm font-bold">
					@if($activeStep > 0)
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
		--}}
	</div>

	@push('scripts')
		<script>
			document.addEventListener('livewire:initialized', () => {
				Livewire.hook('morph.updated', ({ component }) => {
					requestAnimationFrame(() => {
						const steps = document.querySelectorAll('.finder-step');
						const last = steps[steps.length - 1];
						if (last) {
							last.scrollIntoView({ behavior: 'smooth', block: 'start' });
						}
					});
				});
			});
		</script>
	@endpush
</div>