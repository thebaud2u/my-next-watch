<form method="post" action="{{ route('logout') }}">
	@csrf

	<x-front.header.responsive-nav-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();" class="font-semibold text-annonces-red">
		{{ __('Log out') }}
	</x-front.header.responsive-nav-link>
</form>
