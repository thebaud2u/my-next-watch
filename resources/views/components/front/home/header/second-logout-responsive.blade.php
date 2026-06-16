<div class="flex justify-center w-full">
	<form method="post" action="{{ route('logout') }}" class="flex justify-center">
			@csrf
	
			<x-front.header.responsive-nav-link class="font-semibold text-jobboard-deepblue">
				{{ __('Log out') }}
			</x-front.header.responsive-nav-link>
	</form>
</div>
