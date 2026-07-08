<x-app-layout>
	@push('seo')
		<title>{{ $watch->getBrand()->name.' '.$watch->collection->name.' '.$watch->reference }}</title>
		<meta name="description" content="{{ $watch->description }}">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
		<meta property="og:title" content="{{ $watch->getBrand()->name.' '.$watch->collection->name.' '.$watch->reference }}">
		<meta property="og:description" content="{{ $watch->description }}">
		<meta property="og:image" content="">
		<meta property="og:url" content="{{ Request::url() }}">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="{{ env('APP_NAME') }}">
		<meta property="og:locale" content="fr_FR">
	@endpush

	<div class="flex flex-row max-xlsm:flex-col max-xlsm:items-center mt-2 max-w-[1200px] w-full text-mnw-deepblue border border-mnw-greige p-6 gap-4">
		{{-- Content --}}
		<div class="text-sm lg:text-base lg:max-w-[870px] max-lg:px-2 w-full">
			<div class="flex flex-col max-md:px-4 md:pr-4 w-full mb-8">
				{{-- First section : common infos --}}
				<div class="flex flex-row justify-between items-center gap-x-4 px-4 bg-mnw-cream py-6">
					<div class="flex flex-row gap-x-4">
						<div class="flex flex-col gap-y-3 justify-center">
							<h1 class="text-[28px] lg:text-[40px] font-bold mb-1 leading-8 lg:leading-10">
								{{ $watch->reference }}
							</h1>

							<div class="flex gap-2 flex-wrap">
								<a href="{{ route('brand.show', ['brand' => $watch->getBrand()->slug]) }}" class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange cursor-pointer">
									{{ $watch->getBrand()->name }}
								</a>

								<a href="{{ route('collection.show', ['collection' => $watch->collection->slug]) }}" class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange cursor-pointer">
									{{ $watch->collection->name }}
								</a>

								{{--
								@if($professionnalActivity->activitySolutions->isNotEmpty())
									@foreach($professionnalActivity->activitySolutions as $solutions)
										@if($loop->iteration > 3)
											<div class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-cream">
												+
											</div>

											@break
										@else
											<div class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-cream">
												{{ $solutions->name }}
											</div>
										@endif
									@endforeach
								@endif
								--}}
							</div>
						</div>
					</div>

					<div class="flex flex-row items-center">
						<livewire:space.favorites.toggle-favorite
							:target="$watch"
							:key="'toggle-favorite-component'" />
					</div>
				</div>

				<div x-data="{ activeTab: 'generalities' }">
					<div class="flex flex-row rounded-b-xl justify-between bg-mnw-cream border-t border-mnw-greige" >
						<div class="flex-1 flex justify-center p-4 cursor-pointer font-medium rounded-bl-xl hover:bg-mnw-deepblue hover:text-mnw-cream" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'generalities'}" x-on:click="activeTab = 'generalities'">
							{{ __('Generalities') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'movement'}" x-on:click="activeTab = 'movement'">
							{{ __('Movement') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'case'}" x-on:click="activeTab = 'case'">
							{{ __('Case') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'dial'}" x-on:click="activeTab = 'dial'">
							{{ __('Dial') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'bezel'}" x-on:click="activeTab = 'bezel'">
							{{ __('Bezel') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'crystal'}" x-on:click="activeTab = 'crystal'">
							{{ __('Crystal') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'crown'}" x-on:click="activeTab = 'crown'">
							{{ __('Crown') }}
						</div>

						<div class="flex-1 flex justify-center p-4 cursor-pointer hover:bg-mnw-deepblue hover:text-mnw-cream font-medium" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'bracelet'}" x-on:click="activeTab = 'bracelet'">
							{{ __('Bracelet') }}
						</div>
					</div>

					<div class="flex flex-row w-full mt-8 mb-4 border border-mnw-greige rounded-xl p-8 flex flex-col gap-4">
						<div x-show="activeTab === 'generalities'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Generalities') }}
							</h2>

							@if($watch->description)
								<div class="flex flex-col gap-4">
									<p class="text-mnw-deepblue font-medium">
										{!! nl2br($watch->description) !!}
									</p>
								</div>
							@endif

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="__('Type')" :class="'pl-4'"/>
								{{ ucfirst(__($watch->type->name)) }}

								<x-front.input-label for="" :value="__('Price at release')" :class="'pl-4'"/>
								{{ ucfirst(__($watch->release_price)) }}€

								<x-front.input-label for="" :value="__('Limited edition')" :class="'pl-4'"/>
								{{ boolLabel($watch->specificities['limited_edition']) }}

								@if($watch->specificities['limited_edition'])
									<x-front.input-label for="" :value="__('Limited to')" :class="'pl-4'"/>
									{{ $watch->specificities['pieces'] }}{{ __('pieces') }}
								@endif
							</div>
						</div>

						<div x-show="activeTab === 'movement'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Movement') }}
							</h2>

							<div class="grid grid-cols-2 gap-2 mb-8">
								<x-front.input-label for="" :value="__('Name')" :class="'pl-4'"/>
								{{ $movement->name }}

								<x-front.input-label for="" :value="__('Origin country')" :class="'pl-4'"/>
								{{ $movement->country->name }}

								<x-front.input-label for="" :value="__('Type')" :class="'pl-4'"/>
								{{ ucfirst(__($movement->movementType->name)) }}

								<x-front.input-label for="" :value="__('COSC')" :class="'pl-4'"/>
								{{ boolLabel($movement->COSC) }}

								<x-front.input-label for="" :value="__('METAS')" :class="'pl-4'"/>
								{{ boolLabel($movement->METAS) }}

								<x-front.input-label for="" :value="__('Manufactured caliber')" :class="'pl-4'"/>
								{{ boolLabel($movement->manufactured_caliber) }}

								<x-front.input-label for="" :value="__('Antimagnetism')" :class="'pl-4'"/>
								{{ $movement->antimagnetism }}gauss

								<x-front.input-label for="" :value="__('Jewels')" :class="'pl-4'"/>
								{{ $movement->jewels }}

								<x-front.input-label for="" :value="__('Frequency')" :class="'pl-4'"/>
								{{ __(':frequencybeat/hour', ['frequency' => $movement->frequency]) }}

								@if($movement->description)
									<x-front.input-label for="" :value="__('Description')" :class="'pl-4'"/>
									{{ $movement->description }}
								@endif
							</div>

							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Specificities for this watch') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="__('Power reserve')" :class="'pl-4'"/>
								{{ $watch->specificities['power_reserve'] }}h

								<x-front.input-label for="" :value="trans_choice('Watch details : Complication', count($complications))" :class="'pl-4'"/>
								{{ $complications->map(fn($complication) => ucfirst(__($complication->name)))->implode(', ') }}
							</div>
						</div>

						<div x-show="activeTab === 'case'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Case') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="__('Diameter')" :class="'pl-4'"/>
								{{ $watch->case['diameter'] }}mm

								<x-front.input-label for="" :value="__('Lug to lug')" :class="'pl-4'"/>
								{{ $watch->case['lug_to_lug'] }}mm

								<x-front.input-label for="" :value="__('Thickness')" :class="'pl-4'"/>
								{{ $watch->case['thickness'] }}mm

								<x-front.input-label for="" :value="__('Lug width')" :class="'pl-4'"/>
								{{ $watch->case['lug_width'] }}mm

								<x-front.input-label for="" :value="trans_choice('Watch details : Color', count($caseColors))" :class="'pl-4'"/>
								{{ $caseColors->map(fn($caseColor) => ucfirst(__($caseColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Material', count($caseMaterials))" :class="'pl-4'"/>
								{{ $caseMaterials->map(fn($caseMaterial) => ucfirst(__($caseMaterial->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Finish', count($caseFinishes))" :class="'pl-4'"/>
								@if(!is_null($watch->case['special_finish_technic']))
									{{ __($watch->case['special_finish_technic']) }}
								@else
									{{ $caseFinishes->map(fn($caseFinish) => ucfirst(__($caseFinish->name)))->implode(', ') }}
								@endif

								@if($caseSurfaceTreatments->isNotEmpty())
									<x-front.input-label for="" :value="trans_choice('Surface treatment', count($caseSurfaceTreatments))" :class="'pl-4'"/>
									{{ $caseSurfaceTreatments->map(fn($caseSurfaceTreatment) => ucfirst(__($caseSurfaceTreatment->name)))->implode(', ') }}
								@endif

								<x-front.input-label for="" :value="__('Open case back')" :class="'pl-4'"/>
								{{ boolLabel($watch->case['open_case_back']) }}

								@if($watch->case['open_case_back'])
									<x-front.input-label for="" :value="__('Sapphire crystal case back')" :class="'pl-4'"/>
									{{ boolLabel($watch->case['sapphire_crystal_case_back']) }}
								@endif

								<x-front.input-label for="" :value="__('Waterproofness')" :class="'pl-4'"/>
								{{ $watch->case['waterproofness'] }}m
							</div>
						</div>

						<div x-show="activeTab === 'dial'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Dial') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="trans_choice('Watch details : Color', count($dialColors))" :class="'pl-4'"/>
								{{ $dialColors->map(fn($dialColor) => ucfirst(__($dialColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Markers color', count($dialMarkerColors))" :class="'pl-4'"/>
								{{ $dialMarkerColors->map(fn($dialMarkerColor) => ucfirst(__($dialMarkerColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Marker lumed')" :class="'pl-4'"/>
								{{ boolLabel($watch->dial['marker_lume']) }}

								@if($watch->dial['marker_lume'])
									<x-front.input-label for="" :value="trans_choice('Watch details : Markers lume color', count($dialMarkerLumeColors))" :class="'pl-4'"/>
									{{ $dialMarkerLumeColors->map(fn($dialMarkerLumeColor) => ucfirst(__($dialMarkerLumeColor->name)))->implode(', ') }}
								@endif

								<x-front.input-label for="" :value="trans_choice('Watch details : Markers type', count($dialMarkerTypes))" :class="'pl-4'"/>
								{{ $dialMarkerTypes->map(fn($dialMarkerType) => ucfirst(__($dialMarkerType->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Domed')" :class="'pl-4'"/>
								{{ boolLabel($watch->dial['domed']) }}

								<x-front.input-label for="" :value="__('Type')" :class="'pl-4'"/>
								{{ ucfirst(__($watch->dialType->name)) }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Finish', count($dialFinishes))" :class="'pl-4'"/>
								{{ $dialFinishes->map(fn($dialFinish) => ucfirst(__($dialFinish->name)))->implode(', ') }}

								@if(!is_null($watch->dial['pattern']))
									<x-front.input-label for="" :value="__('Pattern')" :class="'pl-4'"/>
									{{ ucfirst(__($watch->dial['pattern'])) }}
								@endif
							</div>
						</div>

						<div x-show="activeTab === 'bezel'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Bezel') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="trans_choice('Watch details : Color', count($bezelColors))" :class="'pl-4'"/>
								{{ $bezelColors->map(fn($bezelColor) => ucfirst(__($bezelColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Material', count($bezelMaterials))" :class="'pl-4'"/>
								{{ $bezelMaterials->map(fn($bezelMaterial) => ucfirst(__($bezelMaterial->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Marker', count($bezelMarkings))" :class="'pl-4'"/>
								{{ $bezelMarkings->map(fn($bezelMarking) => ucfirst(__($bezelMarking->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Type')" :class="'pl-4'"/>
								{{ ucfirst(__($watch->bezel['direction'])) }}
							</div>
						</div>

						<div x-show="activeTab === 'crystal'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Crystal') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="trans_choice('Watch details : Material', count($crystalMaterials))" :class="'pl-4'"/>
								{{ $crystalMaterials->map(fn($crystalMaterial) => ucfirst(__($crystalMaterial->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Domed')" :class="'pl-4'"/>
								{{ boolLabel($watch->crystal['domed']) }}
							</div>
						</div>

						<div x-show="activeTab === 'crown'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Crown') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="trans_choice('Watch details : Color', count($crownColors))" :class="'pl-4'"/>
								{{ $crownColors->map(fn($crownColor) => ucfirst(__($crownColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Material', count($crownMaterials))" :class="'pl-4'"/>
								{{ $crownMaterials->map(fn($crownMaterial) => ucfirst(__($crownMaterial->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Domed')" :class="'pl-4'"/>
								{{ boolLabel($watch->crown['screwed_down']) }}

								<x-front.input-label for="" :value="__('Type')" :class="'pl-4'"/>
								{{ ucfirst(__($watch->crown['detail'])) }}
							</div>
						</div>

						<div x-show="activeTab === 'bracelet'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Bracelet') }}
							</h2>

							<div class="grid grid-cols-2 gap-2">
								<x-front.input-label for="" :value="__('Style')" :class="'pl-4'"/>
								{{ ucfirst(__($braceletStyle->name)) }}

								<x-front.input-label for="" :value="__('Color')" :class="'pl-4'"/>
								{{ ucfirst(__($braceletColor->name)) }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Material', count($braceletMaterials))" :class="'pl-4'"/>
								{{ $braceletMaterials->map(fn($braceletMaterial) => ucfirst(__($braceletMaterial->name)))->implode(', ') }}

								<x-front.input-label for="" :value="__('Clasp')" :class="'pl-4'"/>
								{{ ucfirst(__($braceletClasp->name)) }}

								<x-front.input-label for="" :value="count($braceletClaspColors) > 1 ? __('Clasp colors') : __('Clasp color')" :class="'pl-4'"/>
								{{ $braceletClaspColors->map(fn($braceletClaspColor) => ucfirst(__($braceletClaspColor->name)))->implode(', ') }}

								<x-front.input-label for="" :value="trans_choice('Watch details : Clasp material', count($braceletClaspMaterials))" :class="'pl-4'"/>
								{{ $braceletClaspMaterials->map(fn($braceletClaspMaterial) => ucfirst(__($braceletClaspMaterial->name)))->implode(', ') }}

								@if($braceletType == 'bracelet')
									<x-front.input-label for="" :value="__('Micro adjustement')" :class="'pl-4'"/>
									{{ boolLabel($watch->bracelet['micro_adjustement']) }}

									@if($watch->bracelet['micro_adjustement'])
										<x-front.input-label for="" :value="__('Micro adjustement system')" :class="'pl-4'"/>
										{{ ucfirst(__($braceletMicroAdjustementSystem->name)) }}
									@endif
								@elseif($braceletType == 'strap')
									<x-front.input-label for="" :value="__('Stitching')" :class="'pl-4'"/>
									{{ boolLabel($watch->bracelet['stitching']) }}

									@if($watch->bracelet['stitching'])
										<x-front.input-label for="" :value="trans_choice('Watch details : Color', count($braceletStitchingColors))" :class="'pl-4'"/>
										{{ $braceletStitchingColors->map(fn($braceletStitchingColor) => ucfirst(__($braceletStitchingColor->name)))->implode(', ') }}
									@endif
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Column right --}}
		<div class="w-full flex flex-col gap-6 lg:max-w-[300px] max-lg:px-6 max-lg:mb-8">
			<div class="w-full flex flex-col rounded-xl border border-mnw-greige p-6 gap-4">
				<h3 class="text-[24px] lg:text-[28px] font-bold">
					{{ __('View the watch') }}
				</h3>

				<div class="flex gap-4 font-medium">
					<svg class="shrink-0" width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M17 9.18182C17 14.7091 9 21 9 21C9 21 1 14.7091 1 9.18182C1 3.65455 4.58222 1 9 1C13.4178 1 17 3.65455 17 9.18182Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M9.00001 11.9094C10.9637 11.9094 12.5556 10.2814 12.5556 8.27308C12.5556 6.26477 10.9637 4.63672 9.00001 4.63672C7.03633 4.63672 5.44446 6.26477 5.44446 8.27308C5.44446 10.2814 7.03633 11.9094 9.00001 11.9094Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					<a href="{{ 'https://www.google.com/search?tbm=isch&q=' . urlencode(
							$watch->getBrand()->name . ' ' .
							$watch->collection->name . ' ' .
							$watch->reference
						) }}" target="_blank">
							{{ __('Show images of the watch') }}
						</a>
				</div>
			</div>
		</div>
	</div>

	<div class="flex flex-col gap-4">
		<div>
			<livewire:widgets.related
				:slug="$watch->slug"
				:type="'collection'"
				:wire:key="'related-watches-from-same-collection'" />
		</div>

		<div>
			<livewire:widgets.related
				:slug="$watch->slug"
				:type="'brand'"
				:wire:key="'related-watches-from-same-brand'" />
		</div>
	</div>

</x-app-layout>