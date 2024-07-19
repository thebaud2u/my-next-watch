<x-app-layout>
	@push('seo')
		<title>{{ __('Find your job in transport and logistics') }}</title>
		<meta name="description" content="{{ __('With its candidate space :siteName allows you to apply for a job of driver, deliveryman, driver, forklift operator, technician, engineer and more', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, logistics transport professions, transport, logistics, employment transport, logistics job, jobs, offers, announcements, research, employment, work, paycheck, profession, jobs, job-search, CDI, CDD, internship, alternation, learning, recruiting, interim, teacher, road, maritime, rail, fluvial, registered, multi modal, schools, training centre, chauffeur, driver, pilot, deliveryman, road, director, responsible, chief, agent, quay, commissionaire, commercial, controller, engineer, deckhand, officer, freight, storekeeper, cargo handler, mechanic, loader, truck driver, engineer, manager, logistician, preparer', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1">
	@endpush

	<x-slot name="mainTitle">
		<div class="h-[450px] bg-cover bg-center flex flex-col lg:flex-row lg:items-center lg:justify-center bg-[url('/storage/header_background/home_search_engine.png')]">
			<div class="py-5 px-4 lg:px-6">
				<h1 class="text-xl leading-7 text-gray-800">
					{{-- Job search form --}}
					<div class="flex flex-row justify-center items-center font-semibold">
						<h1 class="mb-2 lg:mb-4 text-white text-3xl text-center font-bold">
							{{ __('What is the principle') }} ?
						</h1>
					</div>

					<p class="mb-2 lg:mb-4 text-white text-center text-sm sm:text-base lg:text-xl lg:tracking-tight font-thin max-w-[650px] mx-auto">
						{{ __(':site allows you to find the watch that matchs your criterias' ,['site' => env('APP_NAME')]) }}<br/>
						{{ __('follow our steps to help you find your next watch') }}
					</p>

					<div class="w-full flex flex-col justify-center items-center lg:pt-8 lg:pb-4">
						<x-front.primary-button :class="'px-4 py-1 mr-2 bg-annonces-blue text-white hover:bg-annonces-blue hover:text-white font-semibold'">
							<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
								<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							{{ __('Find my next watch') }} !
						</x-front.primary-button>
					</div>
				</h1>
			</div>
		</div>
	</x-slot>

	{{-- Recently viewed watches --}}
	@if(Auth::guard('web')->check())
		<div class="w-full bg-annonces-lightblue">
			<livewire:front.watches.recently-viewed :wire:key="'recently-viewed'" />
		</div>
	@else
		<div class="w-full bg-annonces-lightblue">
			<livewire:front.watches.random-watches :wire:key="'random-watches'" />
		</div>
	@endif
</x-app-layout>
