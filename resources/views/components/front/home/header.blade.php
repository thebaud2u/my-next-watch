<nav class="bg-white" class="bg-white">
	<div class="max-w-screen-xl mx-auto px-4 lg:px-6">
		<div class="flex justify-between">
			<div class="flex flex-col md:flex-row">
				{{-- Logo --}}
				<div class="shrink-0 flex items-center z-40 block max-sm:mr-4 h-[100px] w-auto">
					<x-front.logo :link="true" :href="route('home')" />
				</div>
			</div>

			<div class="hidden xlsm:flex xlsm:items-center xlsm:ml-6 text-right text-xs xlsm:text-sm xl:text-base">
				@auth('web')
					<x-front.header.nav-link :href="route('logout')" class="font-semibold text-mnw-red">
						{{ __('Log out') }}
					</x-front.header.nav-link>
				@else
					<div class="shrink flex-wrap">
						{{-- Log in --}}
						<a href="{{ route('login') }}">
							<x-front.primary-button :class="'px-4 py-1 hover:bg-mnw-blue hover:text-white font-semibold'">
								{{ __('Log in') }}
							</x-front.primary-button>
						</a>
					</div>
				@endauth
			</div>
		</div>
	</div>

	<div class="xlsm:hidden shadow-md fixed top-0 bg-white w-full z-50">
		<div class="flex justify-between items-center px-4">
			{{-- Logo --}}
			<div class="shrink-0 flex items-center z-40 mr-4 h-[100px] w-auto">
				<x-front.logo :link="true" />
			</div>

			@auth('web')
				<x-front.header.responsive-nav-link :href="route('logout')" class="font-semibold text-mnw-red">
					{{ __('Log out') }}
				</x-front.header.responsive-nav-link>
			@else
				<div class="flex flex-col justify-center items-center px-4 space-y-4">
					{{-- Log in --}}
					<a href="{{ route('login') }}" class="text-base">
						<x-front.primary-button :class="'font-semibold hover:text-white focus:text-white w-full justify-center'">
							{{ __('Log in') }}
						</x-front.primary-button>
					</a>
				</div>
			@endauth
		</div>
	</div>
</nav>
