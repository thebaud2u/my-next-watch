<x-space-layout :currentThematic="$post->thematic" :currentPostType="$post->postType" :post="$post ?? null" :breadcrumb="'post-favorites'">
	<x-slot name="side_menu">

	</x-slot>

	<div class="flex flex-col py-5 px-4 lg:px-6">
		<div class="flex flex-col">
			<x-front.space.space-title>
				{{ __('My favorite job posts') }}
			</x-front.space.space-title>
		</div>

		<div class="flex flex-col">
			@if(is_null($type) || $type == 'posts')
				@if($posts->isNotEmpty())
					@foreach($posts as $post)
						<div class="flex flex-col mb-8 shadow-md rounded">
							<div class="flex md:flex-row flex-col">
								<a href="{{ route('post.show', ['post' => $post->id, 'slug' => $post->slug]) }}">
									<div class="flex-4 p-4">
										<article class="group relative min-w-[250px] mb-4 sm:p-4 flex flex-col sm:flex-row justify-center sm:items-stretch rounded transition duration-200 ease-in-out">
											{{-- Image, logo --}}
											<div class="relative sm:flex-none flex justify-center items-stretch w-full sm:max-w-[200px] max-h-36 rounded-t sm:rounded-l sm:rounded-tr-none">
												@if($media = $post->getFirstMedia('image'))
													<div class="w-full h-20 sm:h-full flex justify-center items-center bg-mnw-lightblue rounded-t-sm sm:rounded-none border-b sm:border border-transparent transition duration-200 ease-in-out">
														<img src="{{ $media->getAvailableUrl(['optimized']) }}" title="{{ __('Logo of') }} {{ $post->company->name }}" class="object-cover w-full rounded-t-sm sm:rounded-none" />
													</div>
												@else
													<div class="w-full h-20 sm:h-full flex justify-center items-center bg-mnw-lightblue rounded-t-sm sm:rounded-none border-b sm:border border-transparent transition duration-200 ease-in-out">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 max-sm:ml-12 sm:mr-6">
															<path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
															<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
														</svg>
													</div>
												@endif

												@if($media = $post->company->getFirstMedia('logo'))
													<div class="absolute max-sm:-bottom-4 max-sm:left-4 max-sm:w-20 sm:top-1/4 sm:-right-5 sm:h-1/2 aspect-square rounded-full shadow-md bg-white flex justify-center items-center overflow-hidden">
														<div class="w-2/3 aspect-square flex items-center">
															<img alt="{{ $post->company->name }}" src="{{ $media->getAvailableUrl(['optimized']) }}" class="object-contain" />
														</div>
													</div>
												@else
													<div class="absolute max-sm:-bottom-4 max-sm:left-4 max-sm:w-20 sm:top-1/4 sm:-right-5 sm:h-1/2 aspect-square rounded-full shadow-md bg-white flex justify-center items-center overflow-hidden">
														<div class="w-2/3 aspect-square flex items-center">
															<img alt="{{ $post->company->name }}" src="" class="object-contain" />
														</div>
													</div>
												@endif
											</div>

											<div class="sm:grow max-sm:p-4 max-sm:pt-6 sm:pl-8 text-xs lg:text-sm text-gray-500">
												{{-- Viewed, premium tag --}}

												<h2 class="mb-2 text-mnw-blue text-sm sm:text-base xl:text-lg font-semibold leading-normal">
													{{ $post->title }}
												</h2>

												<div class="mb-2 group-hover:text-gray-700? 'text-mnw-blue group-hover:text-mnw-lighterdarkblue transition duration-200 ease-in-out">
													<span class="uppercase font-semibold">{{ $post->company->name }}</span>
													-
													{{ Str::limit($post->body, 50) }}
												</div>

												{{-- Location, contract type, posted date --}}
												<div class="text-gray-400 group-hover:text-gray-500 transition duration-200 ease-in-out">
													<div class="inline-flex items-center mr-4">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
															<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
															<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
														</svg>

														@if($post->company->address->count() > 0)
															{{ $post->company->address->first()->city ? $post->company->address->first()->city?->name . ' (' . $post->company->address->first()->city?->zip_code . ')' : $post->company->address->first()->custom_city . ' (' . $post->company->address->first()->country->name . ')' }}
														@else
															{{ __('No address') }}
														@endif
													</div>

													<div class="inline-flex items-center mr-4">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
															<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
														</svg>

														@foreach($post->contract_types as $index => $contract_type)
															{{ $contract_type->contract_type->name }}

															@if($index < count($post->contract_types)-1)
																-
															@endif
														@endforeach
													</div>

													<div class="inline-flex items-center mr-4">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
															<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
														</svg>

														{{ $post->created_at->diffForHumans() }}
													</div>
												</div>

												{{-- Tag --}}
												{{--<div class="mt-2 max-sm:mb-2">
													@if($post->type->bloodline()->orderBy('id', 'asc')->skip(1)->first()->slug == 'veterinaire')
														<x-front.tag :class="'text-white text-xs max-w-[30%]'">
															<span>{{ __('Veterinary') }}</span>
														</x-front.tag>
													@elseif($post->type->bloodline()->orderBy('id', 'asc')->skip(1)->first()->slug == 'auxiliaire-veterinaire')
														<x-front.tag :class="'text-white text-xs bg-mnw-pink max-w-[30%]'">
															<span>{{ __('Auxiliary veterinary') }}</span>
														</x-front.tag>
													@endif
												</div>--}}
											</div>
										</article>
									</div>

									<div class="flex-1 flex md:flex-col p-4 md:justify-start md:items-center flex-row justify-around content-center flex-wrap">
										<div class="text-mnw-blue sm:mt-5">
											@role('applicant')
												<form method="post" action="{{ route('add-to-my-favorites-posts', ['post' => $post]) }}" x-data="{}" x-ref="togglefavorite">
													@csrf

													@if(Auth::user()->hasFavorited($post))
														<a href="#removeFromFavorites" title="{{ __('In my favorites').' ('.__('remove').')' }}" class="text-mnw-blue hover:text-mnw-blue" x-on:click.prevent="$refs.togglefavorite.submit()">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 lg:w-7 lg:h-7 pointer-events-none">
																<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
															</svg>
														</a>
													@else
														<a href="#addToFavorites" title="{{ __('Add to my favorites') }}" class="text-mnw-lightblue hover:text-mnw-blue" x-on:click.prevent="$refs.togglefavorite.submit()">
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 lg:w-7 lg:h-7 pointer-events-none">
																<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
															</svg>
														</a>
													@endif
												</form>
											@endrole
										</div>
									</div>
								</a>
							</div>
						</div>
					@endforeach
				@else
					{{ __('No favorites yet') }}
				@endif
			@endif
		</div>
	</div>
</x-space-layout>
