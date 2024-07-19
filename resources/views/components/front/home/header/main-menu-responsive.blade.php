<div class="flex flex-col justify-center px-4 pb-6">
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

	<x-front.logo :link="true" :href="$route" />
</div>
