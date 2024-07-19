<div class="flex flex-col justify-center px-4 pb-6">
	@php
		$secondMenuThematics = App\Models\Thematic::all();

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

	<a href="{{ $route }}" class="pb-6 border-transparent border-2 border-b-annonces-transparentgray w-full text-center">
		<x-front.primary-button :class="'px-4 py-1 mr-2 bg-annonces-blue text-white hover:bg-annonces-blue hover:text-white font-semibold'">
			<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
				<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			{{ __('Place a post') }}
		</x-front.primary-button>
	</a>

	<div class="w-full flex flex-col mt-6">

	</div>
</div>
