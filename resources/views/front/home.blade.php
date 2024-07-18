<x-app-layout>
	@push('seo')
		<title>{{ __('Find your job in transport and logistics') }}</title>
		<meta name="description" content="{{ __('With its candidate space :siteName allows you to apply for a job of driver, deliveryman, driver, forklift operator, technician, engineer and more', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, logistics transport professions, transport, logistics, employment transport, logistics job, jobs, offers, announcements, research, employment, work, paycheck, profession, jobs, job-search, CDI, CDD, internship, alternation, learning, recruiting, interim, teacher, road, maritime, rail, fluvial, registered, multi modal, schools, training centre, chauffeur, driver, pilot, deliveryman, road, director, responsible, chief, agent, quay, commissionaire, commercial, controller, engineer, deckhand, officer, freight, storekeeper, cargo handler, mechanic, loader, truck driver, engineer, manager, logistician, preparer', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1">
	@endpush

	@php
		if (!(is_null(Auth::guard('web')->user()))) {
			if (Auth::guard('web')->user()->hasRole('applicant')) $roleSmart = 'Transport=candidat';
			elseif (Auth::guard('web')->user()->hasRole('registered')) $roleSmart = 'Transport=recruteur';
		}
		else $roleSmart = 'Transport=generique';
	@endphp

	{{-- Script smartad Home --}}
	<x-slot name="scriptSmartad">
		<script type="application/javascript" src="https://ced.sascdn.com/tag/106/smart.js" async></script>
		<script type="application/javascript">
			var sas = sas || {};
			sas.cmd = sas.cmd || [];
			sas.cmd.push(function() {
				sas.setup({ networkid: 106, domain: "https://adapi.smartadserver.com", async: true });
			});
			sas.cmd.push(function() {
				sas.call("onecall", {
					siteId: 655607,
					pageId: 1975378,
					formats: [
						{ id: 129766 },
						{ id: 129764 },
						{ id: 129770 }
					],
					target: '{{ $roleSmart }}'
				});
			});
		</script>
	</x-slot>

	<x-slot name="mainTitle">
		<div class="h-[450px] bg-cover bg-center flex flex-col lg:flex-row lg:items-center lg:justify-center bg-[url('/storage/header_background/home_search_engine.png')]">
		{{-- <div class="h-[350px] bg-annonces-darkblue flex flex-col lg:flex-row lg:items-center lg:justify-center"> --}}
			<div class="py-5 px-4 lg:px-6">
				<h1 class="text-xl leading-7 text-gray-800">
					{{-- Job search form --}}
					<div class="flex flex-row justify-center items-center font-semibold">
						<h1 class="mb-2 lg:mb-4 text-white text-3xl text-center font-bold">
							{{-- Temp title --}}
							Les petites annonces pour les professionnels
						</h1>
					</div>

					<p class="mb-2 lg:mb-4 text-white text-center text-sm sm:text-base lg:text-xl lg:tracking-tight font-thin max-w-[650px] mx-auto">
						Lorem ipsum dolor sit amet consectetur. Amet eleifend consectetur neque rhoncus quis sem nam bibendum. Sed elit ut libero purus amet dolor felis.
					</p>

					<div class="w-full flex flex-col justify-center items-center lg:pt-8 lg:pb-4">
						<livewire:front.posts.search :withRedirect="true" :wire:key="'home-search-bar'" />
					</div>
				</h1>
			</div>
		</div>
	</x-slot>

	{{--Banners smartad Home --}}
	<div id="bannersSmartad" class="w-full flex flex-col items-center p-6">
		{{-- Banners smartad --}}
		@include('components.front.home.smartad.smartadsbanners')
	</div>

	{{-- Thematics --}}
	<div class="bg-annonces-white">
		@include('components.front.home.thematics')
	</div>

	{{-- Recently viewed/published posts --}}
	<div class="w-full bg-annonces-lightblue">
		@if(Auth::guard('web')->check())
			<livewire:front.posts.recently-viewed :wire:key="'recently-viewed'" />
		@else
			<livewire:front.posts.recently-published :wire:key="'recently-published'" />
		@endif
	</div>
</x-app-layout>
