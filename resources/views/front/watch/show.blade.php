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

	<div class="flex flex-row max-xlsm:flex-col max-xlsm:items-center mt-2 max-w-[1200px] w-full text-mnw-deepblue">
		{{-- Content --}}
		<div class="text-sm lg:text-base lg:max-w-[870px] max-lg:px-2 w-full">
			<div class="flex flex-col max-md:px-4 md:pr-4 w-full mb-8">
				{{-- First section : common infos --}}
				<div class="flex flex-row justify-between items-center gap-x-4 px-4 bg-mnw-cream py-6">
					<div class="flex flex-row gap-x-4">
						<div class="flex flex-col gap-y-3 justify-center">
							<h1 class="text-[28px] lg:text-[40px] font-bold mb-1 leading-8 lg:leading-10">
								{{ $watch->name }}
							</h1>

							<div class="flex gap-2 flex-wrap">
								<div class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange">
									{{ __($watch->getBrand()->name) }}
								</div>

								<div class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange">
									{{ __($watch->collection->name) }}
								</div>

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

				<div x-data="{ activeTab: 'description' }">
					<div class="flex flex-row rounded-b-xl justify-between bg-mnw-cream border-t border-mnw-greige" >
						<div class="flex-1 flex justify-center p-4 cursor-pointer font-medium rounded-bl-xl hover:bg-mnw-deepblue hover:text-mnw-cream" :class="{'bg-mnw-deepblue text-mnw-cream': activeTab === 'description'}" x-on:click="activeTab = 'description'">
							{{ __('Description') }}
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
						<div x-show="activeTab === 'description'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Description') }}
							</h2>

							<div class="flex flex-col gap-4">
								<p class="text-mnw-deepblue font-medium">
									{!! nl2br($watch->description) !!}
								</p>
							</div>
						</div>

						<div x-show="activeTab === 'movement'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">
								{{ __('Movement') }}
							</h2>

							{{ $watch->movement->name }}
						</div>

						<div x-show="activeTab === 'case'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Case') }}</h2>
						</div>

						<div x-show="activeTab === 'dial'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Dial') }}</h2>
						</div>

						<div x-show="activeTab === 'bezel'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Bezel') }}</h2>
						</div>

						<div x-show="activeTab === 'crystal'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Crystal') }}</h2>
						</div>

						<div x-show="activeTab === 'crown'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Crown') }}</h2>
						</div>

						<div x-show="activeTab === 'bracelet'" x-cloak>
							<h2 class="text-[24px] lg:text-[28px] font-bold mb-4">{{ __('Bracelet') }}</h2>
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


				</div>
			</div>
		</div>
	</div>

</x-app-layout>