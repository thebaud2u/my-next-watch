<div>
	<div class="shadow-lg p-8 bg-white">
		<form>
			<div class="flex flex-col justify-between">
				<div class="flex flex-row justify-between">
					<div class="text-annonces-blue flex items-center mr-3">
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

						<div class="inline-block font-semibold text-black">
							{{ __('Filter by') }} :
						</div>
					</div>

					<div class="inline-block font-semibold">
						<input type="reset" wire:click="resetForm" x-on:click="loc=''" value="{{ __('Reinitialize') }}" class="underline uppercase underline-offset-4 text-annonces-blue hover:text-annonces-blue cursor-pointer" />
					</div>
				</div>

				<div class="mb-5 text-sm sm:text-base lg:text-md">
					<div class="flex flex-col">
						<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-jobboard-transparentgray mt-4">
							<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
								<span class="flex-1 font-semibold text-jobboard-gray">
									{{ __('Order by') }}
								</span>

								<span class="inline-block text-jobboard-gray" x-show="deploy">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
									</svg>
								</span>

								<span class="inline-block text-jobboard-gray" x-show="!deploy">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
									</svg>
								</span>
							</span>

							<div x-show="deploy" x-transition class="mt-4 p-4">
								<div class="flex flex-row mt-2">
									<input type="radio" name="order" value="revelancy" wire:model="filters.order_by" wire:change="search" class="mr-2 disabled:bg-gray-200 my-1 checked:bg-jobboard-blue checked:hover:bg-jobboard-blue checked:active:bg-jobboard-blue checked:focus:bg-jobboard-blue focus:bg-jobboard-blue focus:outline-none focus:ring-1 focus:ring-jobboard-blue w-4 h-4">
									<label for="order" class="text-xs lg:text-sm text-jobboard-blue">{{ __('Relevancy') }}</label>
								</div>

								<div class="flex flex-row mt-2">
									<input type="radio" name="order" value="publication" wire:model="filters.order_by" wire:change="search" class="mr-2 disabled:bg-gray-200 my-1 checked:bg-jobboard-blue checked:hover:bg-jobboard-blue checked:active:bg-jobboard-blue checked:focus:bg-jobboard-blue focus:bg-jobboard-blue focus:outline-none focus:ring-1 focus:ring-jobboard-blue w-4 h-4">
									<label for="order" class="text-xs lg:text-sm text-jobboard-blue">{{ __('Publication date') }}</label>
								</div>
							</div>
						</div>

						@if($thematic->slug == 'transport' || $thematic->slug == 'social')
							<div wire:key="thematic-advanced-search-criterias">
								@include('components.front.posts.advanced-search-criterias.'.$thematic->slug)
							</div>
						@endif
					</div>
				</div>
			</div>
		</form>
	</div>

	@if (Auth::guard('web')->check())
		@if (Auth::guard('web')->user()->hasRole('registered'))
			@php
				$searchName = ((empty($thematic->slug)) ? '' : ucfirst($thematic->slug))
					.((empty($postType->name)) ? '' : ' - '.$postType->name);
			@endphp
			<div class="my-6 text-center" x-data="{}">
				<a href="#" class="mx-auto" x-on:click.prevent="$dispatch('open-modal','save-search')">
					<x-front.primary-button :class="'gap-2 lg:w-full px-4 py-1 bg-annonces-blue text-white hover:bg-annonces-blue hover:text-white xl:text-sm'">{{-- text-sm xl:text-base font-semibold --}}
						<svg class="size-5 xl:size-6" viewBox="0 0 19 18" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.4978 17H3.50136C2.39669 17 1.50195 16.105 1.50195 15V3C1.50195 1.895 2.39669 1 3.50136 1H12.6712C13.201 1 13.7109 1.21001 14.0858 1.58501L16.9124 4.41251C17.2873 4.78751 17.4972 5.2975 17.4972 5.8275V15C17.4972 16.105 16.6025 17 15.4978 17Z" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M13.4976 1.17999V6C13.4976 7.105 12.6029 8 11.4982 8H7.49941C6.39474 8 5.5 7.105 5.5 6V1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M5.5 17V15C5.5 13.895 6.39474 13 7.49941 13H11.4982C12.6029 13 13.4976 13.895 13.4976 15V17" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<span>{{ __('Save my search') }}</span>
					</x-front.primary-button>
				</a>
				<x-front.modal name="save-search" width="w-full max-w-2xl" wire:key="save-search" focusable>
					<section class="p-10">
						<form method="post" action="{{ route('space.searches.save', ['search' => $savedSearch]) }}">
							@csrf

							<header class="flex flex-col flex-wrap content-center">
								<div class="mt-1 mb-6 text-sm m-auto text-annonces-blue">
									<svg class="size-12" viewBox="0 0 19 18" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.4978 17H3.50136C2.39669 17 1.50195 16.105 1.50195 15V3C1.50195 1.895 2.39669 1 3.50136 1H12.6712C13.201 1 13.7109 1.21001 14.0858 1.58501L16.9124 4.41251C17.2873 4.78751 17.4972 5.2975 17.4972 5.8275V15C17.4972 16.105 16.6025 17 15.4978 17Z" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M13.4976 1.17999V6C13.4976 7.105 12.6029 8 11.4982 8H7.49941C6.39474 8 5.5 7.105 5.5 6V1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M5.5 17V15C5.5 13.895 6.39474 13 7.49941 13H11.4982C12.6029 13 13.4976 13.895 13.4976 15V17" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
								<h2>
									<x-front.input-label for="search_name" :value="__('Choose a title for this search')" :required="true"
										:class="'lg:text-lg text-center font-semibold'" />
								</h2>
								<p class="text-base text-center italic my-4">
									<x-front.text-input name="search_name" :value="$searchName" readonly
										:class="'mt-1 block bg-white w-full'" />
									<input type="hidden" name="search_uuid" value="{{ $savedSearch?->uuid ?? '' }}">
									<input type="hidden" name="thematic_id" value="{{ $thematic?->id ?? 0 }}">
									<input type="hidden" name="post_type_id" value="{{ $postType?->id ?? 0 }}">
									<input type="hidden" name="category_id" value="{{ $category?->id ?? 0 }}">
									{{-- <input type="hidden" wire:model="filters"> --}}
									<input type="hidden" name="filters" value="{{ (empty($filters)) ? '{}' : json_encode($filters) }}">
								</p>
							</header>
							<div class="flex flex-row mt-4 justify-center">
								<x-front.primary-button class="mr-6">
									{{ __('Save my search') }}
								</x-front.primary-button>
								<x-front.secondary-button x-on:click="$dispatch('close')">
									{{ __('Cancel') }}
								</x-front.secondary-button>
							</div>
						</form>
					</section>
				</x-front.modal>
			</div>
		@endif
	@endif
</div>
