<div>
	<form>
		<div class="flex flex-row justify-between">
			<div class="flex flex-row items-center">
				<div class="text-annonces-blue inline-block mr-3">
					<svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path id="Vector" d="M23.7768 4.88867H17.1101" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_2" d="M5.99889 4.88867H1.55444" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_3" d="M10.4433 8.77778C12.5911 8.77778 14.3322 7.03666 14.3322 4.88889C14.3322 2.74111 12.5911 1 10.4433 1C8.29556 1 6.55444 2.74111 6.55444 4.88889C6.55444 7.03666 8.29556 8.77778 10.4433 8.77778Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_4" d="M23.7767 17.1113H19.3323" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_5" d="M8.22111 17.1113H1.55444" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_6" d="M14.8877 20.9999C17.0354 20.9999 18.7766 19.2588 18.7766 17.1111C18.7766 14.9633 17.0354 13.2222 14.8877 13.2222C12.7399 13.2222 10.9988 14.9633 10.9988 17.1111C10.9988 19.2588 12.7399 20.9999 14.8877 20.9999Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="inline-block text-black font-semibold">
					{{ __('Filter by') }} :
				</div>
			</div>

			<div class="flex-2 inline-block">
				<input type="reset" wire:click="resetForm" value="{{ __('Reinitialize') }}" class="underline uppercase text-annonces-blue hover:text-annonces-blue cursor-pointer">
			</div>
		</div>

		<div class="flex flex-col">
			<div class="flex flex-row py-4 border-b-2 border-annonces-transparentgray mt-4">
				<div class="bg-white lg:flex-1 p-0 text-annonces-gray min-w-[250px] ">
					<div class="flex justify-between">
						<input type="text" wire:model="keywords" wire:keydown.debounce.500ms="search" name="keywords" placeholder="Mot(s)-clé(s)" class="p-0 block w-full text-annonces-gray border-annonces-darkerwhite text-sm xl:text-base bg-white border py-3 px-2 focus:border-annonces-blue focus:ring-0 rounded-md">
						<div class="text-annonces-gray relative">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute left-[-35px] top-[13px]">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4" x-data="{ deploy: false }">
				<span class="flex flex-row cursor-pointer" x-on:click="deploy = !deploy">
					<span class="flex-1 font-semibold text-annonces-gray">
						{{ __('Post type') }}
					</span>

					<span class="flex-2 inline-block" x-show="deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
						</svg>
					</span>

					<span class="flex-2 inline-block" x-show="!deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
						</svg>
					</span>
				</span>

				<div x-show="deploy" x-transition class="mt-4">
					@foreach($filterPostTypes as $postType)
						<div class="flex items-center py-1 text-annonces-blue">
							<input type="checkbox" name="post_types_{{ $postType->id }}" value="{{ $postType->id }}" wire:model="postTypes" wire:change.debounce.500ms="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer">
							<label for="post_types_{{ $postType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $postType->name }}</label>
						</div>
					@endforeach
				</div>
			</div>

			<div class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4" x-data="{ deploy: false }">
				<span class="flex flex-row cursor-pointer" x-on:click="deploy = !deploy">
					<span class="flex-1 font-semibold text-annonces-gray">
						{{ __('Offers') }}
					</span>

					<span class="flex-2 inline-block" x-show="deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
						</svg>
					</span>

					<span class="flex-2 inline-block" x-show="!deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
						</svg>
					</span>
				</span>

				<div x-show="deploy" x-transition class="mt-4">
					@foreach($filterOffers as $offer)
						<div class="flex items-center py-1 text-annonces-blue">
							<input type="checkbox" name="offers_{{ $offer->id }}" value="{{ $offer->id }}" wire:model="offers" wire:change.debounce.500ms="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer">
							<label for="offers_{{ $offer->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ ucfirst($offer->thematic->slug) }} - {{ $offer->name }}</label>
						</div>
					@endforeach
				</div>
			</div>

			<div class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4" x-data="{ deploy: false }">
				<span class="flex flex-row cursor-pointer" x-on:click="deploy = !deploy">
					<span class="flex-1 font-semibold text-annonces-gray">
						{{ __('States') }}
					</span>

					<span class="flex-2 inline-block" x-show="deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
						</svg>
					</span>

					<span class="flex-2 inline-block" x-show="!deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
						</svg>
					</span>
				</span>

				<div x-show="deploy" x-transition class="mt-4">
					@foreach($filterStates as $state)
						<div class="flex items-center py-1">
							<input type="checkbox" name="states_{{ $state->state }}" value="{{ $state->state }}" wire:model="states" wire:change.debounce.500ms="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer">
							<label for="states_{{ $state->state }}" class="ml-2 text-xs lg:text-sm cursor-pointer">
								@if($state->state->color() == 'blue')
									<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-gray'">
										<span>{{ __('Draft') }}</span>
									</x-front.tag>
								@elseif($state->state->color() == 'green')
									<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-lightgreen'">
										<span>{{ __('Published') }}</span>
									</x-front.tag>
								@elseif($state->state->color() == 'red')
									<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-lightyellow'">
										<span>{{ __('Archived') }}</span>
									</x-front.tag>
								@endif
							</label>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</form>
</div>
