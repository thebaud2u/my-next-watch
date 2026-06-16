<div>
	@if($user->exists && $createToggle)
		@if($user->hasFavorited($target))
			<div wire:click="toggleFavorite" title="{{ __('In my favorites (remove)') }}" class="text-jobboard-deepblue hover:text-jobboard-deepblue rounded-full flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" fill="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		@else
			<div wire:click="toggleFavorite" title="{{ __('Add to my favorites') }}" class="group text-jobboard-deepblue group-hover:text-jobboard-deepblue rounded-full  flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		@endif

		@if($createModal)
			<x-front.modal name="follow-company-modal" :class="'w-full max-w-2xl'" focusable>
				<section class="p-0">
					<header class="flex flex-row gap-x-1 mb-4">
						{!! __('<strong>:company</strong> has been successfully added to your favorites.', ['company' => $target->name]) !!}
					</header>

					<div class="flex flex-col font-bold">
						{{ __('Do you wish to be informed by emails when the company :company publish a post ?', ['company' => $target->name]) }}
					</div>

					<div class="flex flex-col max-md:items-center md:flex-row mt-4 w-full justify-center md:justify-between gap-4">
						<x-front.secondary-button x-on:click="$dispatch('close');" :class="'flex flex-row gap-x-1'">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.75 16.75C13.1683 16.75 16.75 13.1683 16.75 8.75C16.75 4.33172 13.1683 0.75 8.75 0.75C4.33172 0.75 0.75 4.33172 0.75 8.75C0.75 13.1683 4.33172 16.75 8.75 16.75Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M6.17578 11.3244L11.3248 6.17529" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M6.17578 6.17529L11.3248 11.3244" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							{{ __('No thank you') }}
						</x-front.secondary-button>
						
						<x-front.primary-button wire:click="createAlert" @alert-created.window="$dispatch('close');" :class="'flex flex-row gap-x-1'">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.43906 14.8223C6.43906 15.8855 7.47941 16.75 8.75875 16.75C10.0381 16.75 11.0784 15.8855 11.0784 14.8223M16.6244 13.7708L15.577 12.5032C14.9374 11.7321 14.5929 10.815 14.5929 9.8745V7.87669C14.5929 5.64522 12.7793 3.76424 10.312 3.19761V2.04682C10.312 1.32831 9.61613 0.75 8.75151 0.75C7.8869 0.75 7.19099 1.32831 7.19099 2.04682V3.19761C4.72368 3.76424 2.9101 5.64522 2.9101 7.87669V9.8745C2.9101 10.815 2.56566 11.7321 1.92599 12.5032L0.87861 13.7708C0.54823 14.168 0.892669 14.7113 1.47611 14.7113H16.0269C16.6104 14.7113 16.9478 14.168 16.6244 13.7708Z" stroke="#F7F6EF" stroke-width="1.5" stroke-miterlimit="10"/>
							</svg>

							{{ __('I wish to receive alerts') }}
						</x-front.primary-button>
					</div>
				</section>
			</x-front.modal>
		@endif
	@else
		<a href="{{ route('login') }}">
			<div title="{{ __('Add to my favorites') }}" class="group text-jobboard-deepblue group-hover:text-jobboard-deepblue rounded-full flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		</a>
	@endif
</div>