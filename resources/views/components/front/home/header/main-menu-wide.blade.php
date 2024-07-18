<div class="hidden xlsm:grid xlsm:grid-cols-3 xlsm:items-center text-xs xlsm:justify-between xlsm:text-sm xl:text-base leading-5 w-full">

	@php
		if(Auth::guard('web')->check()) {
			if(Auth::guard('web')->user()->hasRole('registered')) {
				if($currentThematic->slug)
					if($currentPostType->slug) $route = route('space.posts.show-offers', ['thematic' => $currentThematic, 'postType' => $currentPostType]);
					else $route = route('space.posts.show-offers', ['thematic' => $currentThematic]);
				else $route = route('space.posts.show-offers');
			}
			else {
				if($currentThematic->slug)
					if($currentPostType->slug) route('register.role.registered').'?'.http_build_query(['r' => route('space.posts.show-offers', ['thematic' => $currentThematic, 'postType' => $currentPostType])]);
					else $route = route('register.role.registered').'?'.http_build_query(['r' => route('space.posts.show-offers', ['thematic' => $currentThematic])]);
				else $route = route('register.role.registered').'?'.http_build_query(['r' => route('space.posts.show-offers')]);
			}
		}
		else {
			if($currentThematic->slug)
				if($currentPostType->slug) $route = route('login').'?'.http_build_query(['r' => route('space.posts.show-offers', ['thematic' => $currentThematic, 'postType' => $currentPostType])]);
				else $route = route('login').'?'.http_build_query(['r' => route('space.posts.show-offers', ['thematic' => $currentThematic])]);
			else $route = route('login').'?'.http_build_query(['r' => route('space.posts.show-offers')]);
		}
	@endphp

	<a href="{{ $route }}">
		<x-front.primary-button :class="'px-4 py-1 mr-2 bg-annonces-blue text-white hover:bg-annonces-blue hover:text-white font-semibold'">
			<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
				<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			{{ __('Place a post') }}
		</x-front.primary-button>
	</a>

	{{-- Logo --}}
	<div class="shrink-0 flex items-center z-40 block max-sm:mr-4 h-[100px] w-auto mx-auto">
		@php
			if(Auth::guard('web')->check()) {
				if(Auth::guard('web')->user()->hasRole('registered')) {
					if(Auth::guard('web')->user()->thematic) $route = route('posts', ['thematic' => Auth::guard('web')->user()->thematic]);
					else $route = route('home');
				}
				else $route = route('register.role.registered');
			}
			else $route = route('home'); // route('login');
		@endphp
		<x-front.logo :link="true" :href="$route" />
	</div>
	<div class="flex gap-x-3 mt-4">
		@php
			$unreadThreads = (Auth::guard('web')->check()) ? \Cmgmyr\Messenger\Models\Thread::forUserWithNewMessages(Auth::guard('web')->user()->id)->latest('updated_at')->get()->isNotEmpty() : false;
		@endphp
		<x-front.header.picto-link :class="'relative items-center'" :href="Auth::guard('web')->check() ? (Auth::guard('web')->user()->hasRole('registered') ? route('space.responses.messaging') : route('register.role.registered').'?'.http_build_query(['r' => route('space.responses.messaging')])) : route('login').'?'.http_build_query(['r' => route('space.responses.messaging')])" :active="request()->routeIs('space.responses.messaging')">
			<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
				<path d="M24.1087 20.087C25.3043 18.1739 26 15.9239 26 13.5C26 6.59783 20.4021 1 13.5 1C6.59779 1 1 6.59783 1 13.5C1 20.4022 6.59779 26 13.5 26C15.9239 26 18.1739 25.3043 20.0869 24.1087L26 26L24.1087 20.087Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M8.60889 10.7827H18.3915" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M8.60889 16.2173H15.1306" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			{{ __('Messages') }}
			@if (! empty($unreadThreads))
				<div class="absolute -top-1 right-3 inline-flex justify-center items-center size-4 rounded-full border-2 bg-red-500 group-hover:bg-red-600 border-white transition duration-150 ease-in-out text-white text-xs font-semibold"></div>
			@endif
		</x-front.header.picto-link>

		<x-front.header.picto-link :class="'items-center'" :href="Auth::guard('web')->check() ? (Auth::guard('web')->user()->hasRole('registered') ? route('space.favorites.my-favorites') : route('register.role.registered').'?'.http_build_query(['r' => route('space.favorites.my-favorites')])) : route('login').'?'.http_build_query(['r' => route('space.favorites.my-favorites')])" :active="request()->routeIs('space.favorites.my-favorites')">
			<svg width="30" height="27" viewBox="0 0 30 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M27.2151 3.18856C24.297 0.27048 19.5564 0.27048 16.6286 3.18856L14.9902 4.82695L13.3518 3.18856C10.4337 0.27048 5.69307 0.27048 2.77499 3.18856C-0.143094 6.10664 -0.143094 10.8473 2.77499 13.7751L14.9999 26L27.2248 13.7751C30.1429 10.857 30.1429 6.11634 27.2248 3.18856H27.2151Z" stroke="currentColor" stroke-miterlimit="10"/>
			</svg>

			{{ __('Favorites') }}
		</x-front.header.picto-link>

		<x-front.header.picto-link :href="''" :active="''" :class="'items-center'">
			<svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.795 21.5882C16.4786 21.5882 21.0861 16.9794 21.0861 11.2941C21.0861 5.60883 16.4786 1 10.795 1C5.11138 1 0.503906 5.60883 0.503906 11.2941C0.503906 16.9794 5.11138 21.5882 10.795 21.5882Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M18.146 18.647L25.4968 25.9999" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<p class="max-w-[104px] text-wrap text-center">{{ __('My saved research') }}</p>
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
