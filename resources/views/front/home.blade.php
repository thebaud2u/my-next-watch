<x-app-layout>
	@push('seo')
		<title>{{ __('Find your job in transport and logistics') }}</title>
		<meta name="description" content="{{ __(':site allows you to find the watch that matchs your criterias', ['site' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':site, watchs, watch', ['site' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1">
	@endpush

	<x-slot name="mainTitle">
		<div class="h-[450px] bg-cover bg-center flex flex-col lg:flex-row lg:items-center lg:justify-center bg-[url('/storage/header_background/home_search_engine.png')]">
			<div class="py-5 px-4 lg:px-6">
				<h1 class="text-xl leading-7 text-gray-800">
					{{-- Job search form --}}
					<div class="flex flex-row justify-center items-center font-semibold">
						<h1 class="mb-2 lg:mb-4 text-black text-3xl text-center font-bold">
							{{ __('What is the principle') }} ?
						</h1>
					</div>

					<p class="mb-2 lg:mb-4 text-black text-center text-sm sm:text-base lg:text-xl lg:tracking-tight font-thin max-w-[650px] mx-auto">
						{{ __(':site allows you to find the watch that matchs your criterias' ,['site' => env('APP_NAME')]) }}.<br/>
						{{ __('Follow our steps to help you find your next watch') }}
					</p>

					<div class="w-full flex flex-col justify-center items-center lg:pt-8 lg:pb-4">
						@php
							$route = route('lets-find-my-next-watch');

							if(Auth::guard('web')->check()) {
								if(Auth::guard('web')->user()->experience) {
									if(Auth::guard('web')->user()->experience->name != 'Beginner') $route = route('search');
								}
							}
						@endphp

						<a href="{{ $route }}">
							<x-front.primary-button :class="'px-4 py-1 mr-2 bg-mnw-blue text-white hover:bg-mnw-blue hover:text-white font-semibold'">
								<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
									<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>

								{{ __('Find my next watch') }} !
							</x-front.primary-button>
						</a>
					</div>
				</h1>
			</div>
		</div>
	</x-slot>

	{{-- Recently viewed watches --}}
	@if(Auth::guard('web')->check())
		<div class="w-full bg-mnw-lightblue">
			<livewire:front.watches.recently-viewed :wire:key="'recently-viewed'" />
		</div>
	@endif
</x-app-layout>
