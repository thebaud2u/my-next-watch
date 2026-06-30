<div>
	@if($user->exists)
		@if($user->hasFavorited($target))
			<div wire:click="toggleFavorite" title="{{ __('In my favorites (remove)') }}" class="text-mnw-deepblue hover:text-mnw-deepblue rounded-full flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" fill="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		@else
			<div wire:click="toggleFavorite" title="{{ __('Add to my favorites') }}" class="group text-mnw-deepblue group-hover:text-mnw-deepblue rounded-full  flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		@endif
	@else
		<a href="{{ route('login') }}">
			<div title="{{ __('Add to my favorites') }}" class="group text-mnw-deepblue group-hover:text-mnw-deepblue rounded-full flex justify-center items-center w-[2.2rem] h-[2.2rem]">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.2458 25.75C20.147 25.75 25.7416 20.1536 25.7416 13.25C25.7416 6.34644 20.147 0.75 13.2458 0.75C6.34454 0.75 0.75 6.34644 0.75 13.25C0.75 20.1536 6.34454 25.75 13.2458 25.75Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					<path d="M19.5987 9.00259C18.079 7.48237 15.6197 7.48237 14.1 9.00259L13.2493 9.85349L12.3987 9.00259C10.879 7.48237 8.41974 7.48237 6.90004 9.00259C5.38033 10.5228 5.38033 12.9829 6.90004 14.5032L13.2529 20.8582L19.6058 14.5032C21.1255 12.9829 21.1255 10.5228 19.6058 9.00259H19.5987Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>
			</div>
		</a>
	@endif
</div>