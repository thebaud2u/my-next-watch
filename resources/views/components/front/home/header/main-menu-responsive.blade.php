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
		@foreach($secondMenuThematics as $secondMenuThematic)
			@php
				// Si la thematique n'a qu'un seul postType alors on précharge direct vers le seul PostType
				if($secondMenuThematic->postTypes()->count() > 1) $array = ['thematic' => $secondMenuThematic];
				else $array = ['thematic' => $secondMenuThematic, 'postType' => $secondMenuThematic->postTypes()->first()];
			@endphp

			<div x-data="{ deploy: false }">
				<div class="flex justify-between" x-on:click="deploy = !deploy">
					<p class="text-base font-semibold text-annonces-black">
						{{ ucfirst($secondMenuThematic->slug) }}
					</p>

					<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="!deploy">
						<path d="M1.28516 1.5L6.64219 6.5L11.9992 1.5" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="deploy">
						<path d="M12 6.5L6.64297 1.5L1.28593 6.5" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				@php
					$thirdMenuPostTypes = App\Models\PostType::whereHas('thematic', function($whereHas) use ($secondMenuThematic) {
							$whereHas->where('slug', '=', $secondMenuThematic->slug);
						})
						->get();
				@endphp

				<div class="pl-8" x-show="deploy">
					@foreach($thirdMenuPostTypes as $thirdMenuPostType)
						<x-front.header.responsive-nav-link :href="route('posts', ['thematic' => $secondMenuThematic, 'postType' => $thirdMenuPostType])" :active="$thirdMenuPostType->slug == $currentPostType->slug" :class="'font-normal'">
							{{ $thirdMenuPostType->name }}
						</x-front.header.responsive-nav-link>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>
