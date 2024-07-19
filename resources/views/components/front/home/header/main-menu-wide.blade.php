<div class="hidden xlsm:grid xlsm:grid-cols-3 xlsm:items-center text-xs xlsm:justify-between xlsm:text-sm xl:text-base leading-5 w-full">
	@php
		$route = route('home');

		if(Auth::guard('web')->check()) {
			if(Auth::guard('web')->user()->hasRole('registered')) {
				if(Auth::guard('web')->user()->experience) {
					if(Auth::guard('web')->user()->experience->name != 'Beginner') $route = route('search');
					else $route = route('lets-find-my-next-watch');
				}
			}
			else $route = route('register.role.registered');
		}
	@endphp

	<a href="{{ $route }}">
		<x-front.primary-button :class="'px-4 py-1 mr-2 bg-annonces-blue text-white hover:bg-annonces-blue hover:text-white font-semibold'">
			<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
				<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			{{ __('Find my next watch') }}
		</x-front.primary-button>
	</a>

	{{-- Logo --}}
	<div class="shrink-0 flex items-center z-40 block max-sm:mr-4 h-[100px] w-auto mx-auto">
		<x-front.logo :link="true" :href="route('home')" />
	</div>

	<div class="flex gap-x-3 mt-4">
		<x-front.header.picto-link :href="''" :active="''" :class="'items-center'">
			<svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.795 21.5882C16.4786 21.5882 21.0861 16.9794 21.0861 11.2941C21.0861 5.60883 16.4786 1 10.795 1C5.11138 1 0.503906 5.60883 0.503906 11.2941C0.503906 16.9794 5.11138 21.5882 10.795 21.5882Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M18.146 18.647L25.4968 25.9999" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<p class="max-w-[104px] text-wrap text-center">
				{{ __('My saved research') }}
			</p>
		</x-front.header.picto-link>

		<a href="{{ (Auth::guard('web')->check()) ? ((Auth::guard('web')->user()->hasRole('registered')) ? route('space.dashboard') : route('register.role.registered').'?'.http_build_query(['r' => route('space.dashboard')])) : route('login').'?'.http_build_query(['r' => route('space.dashboard')]) }}">
			@if ((Auth::guard('web')->check()) && (Auth::guard('web')->user()->hasRole('registered')))
				<div class="w-[50px] h-[50px] rounded-full bg-annonces-lightblue text-annonces-blue font-semibold flex justify-center items-center text-xl">
					{{ \Illuminate\Support\Str::acronym(Auth::guard('web')->user()->name) }}
				</div>
			@else
				<x-front.secondary-button :class="'px-4 py-1 mr-2 hover:bg-annonces-blue hover:text-white font-semibold'">
					{{ __('Log in') }}
				</x-front.secondary-button>
			@endif
		</a>
	</div>
</div>
