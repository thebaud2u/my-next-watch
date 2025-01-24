<div>
	<div class="py-5 px-4 lg:px-6">
		<div class="flex flex-col s:flex-row lg:min-h-[600px]">
			<div class="flex-1">
				<div class="flex flex-row justify-between">
					<x-front.space.space-title>
						{{ __('My posts') }}
					</x-front.space.space-title>

					<div class="justify-right">
						@if($posts->isNotEmpty())
							<a href="{{ route('space.posts.show-offers') }}">
								<x-primary-button>
									{{ __('Create a post') }}
								</x-primary-button>
							</a>
						@else
							<a href="{{ route('rates.index', ['compositionId' => 32]) }}">
								<x-primary-button>
									{{ __('See the offers') }}
								</x-primary-button>
							</a>
						@endif
					</div>
				</div>

				<div wire:key="error">
					{{-- Flash message --}}
					@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('components.front.home.alert-message')
						</div>
					@endif
				</div>

				@if(Auth::guard('web')->user()->hasPostCreditAvailable('count') > 0)
					<div class="mb-4">
						<span class="mr-1 font-semibold">
							{{ __('You have') }} :
						</span>

						@foreach(Auth::guard('web')->user()->hasPostCreditAvailable('get') as $offer)
							<span class="mr-1 font-semibold">
								{{ $offer->name }}@if($loop->last)@else,@endif
							</span>
						@endforeach
					</div>
				@endif

				@if($posts->isNotEmpty())
					@foreach($posts as $post)
						@php
						if(!empty($post->offer->slug)) {
							switch ($post->offer->slug) {
								case 'F2ASHPREM':
									$product = 2;
									break;
								case 'F2ASH1/4C':
									$product = 2;
									break;
								case 'F2ASH1/2C':
									$product = 2;
									break;
								case 'F2ASH1C':
									$product = 2;
									break;
								case 'F3ASHPRM+':
									$product = 3;
									break;
								case 'F3ASH1/4C':
									$product = 3;
									break;
								case 'F3ASH1/2C':
									$product = 3;
									break;
								case 'F3ASH1C':
									$product = 3;
									break;
								default:
									$product = 1;
									break;
							}
						}
						else $product = 1;

						$classes = "";

						if((!empty($product) && $product > 1 && $product != 3)) $classes .= " shadow-lg border-2 border-mnw-blue hover:border-mnw-blue";
						else {
							if($product == 3) $classes .= " shadow-lg border-2 border-mnw-yellow hover:border-mnw-yellow";
							else $classes .= " hover:bg-gray-50 border-t border-x border-gray-100 hover:border-gray-200";
						}
						@endphp

						<article class="flex flex-col sm:flex-row justify-between group relative min-w-[250px] mb-6 sm:items-stretch rounded shadow-lg bg-white {{ $classes }}" x-data="{hoverOn: false}" @mouseleave="hoverOn = false" @mouseover="hoverOn = true">
							<div class="flex flex-row">
								<div class="flex flex-col sm:flex-none justify-center overflow-hidden items-stretch w-full sm:max-w-[200px] max-h-[173px] rounded-t sm:rounded-l sm:rounded-tr-none">
									@if($media = $post->getFirstMedia('photos'))
										<img src="{{ $media->getAvailableUrl(['optimized']) }}" alt="{{ $post->name }}" class="object-cover w-full rounded-t-sm sm:rounded-none" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
									@else
										<img src="{{ asset('/storage/'.$post->thematic->getRandomImage()) }}" alt="{{ $post->name }}" class="object-cover w-full rounded-t-sm sm:rounded-none" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
									@endif
								</div>

								<div class="flex flex-col pt-6 pl-6 text-xs lg:text-sm">
									@if($post->state->color() == 'blue')
										<x-front.tag :class="'text-black text-xs font-semibold bg-mnw-gray'">
											<span>{{ __('Draft') }}</span>
										</x-front.tag>
									@elseif($post->state->color() == 'green')
										<x-front.tag :class="'text-black text-xs font-semibold bg-mnw-lightgreen'">
											<span>{{ __('Published') }}</span>
										</x-front.tag>
									@elseif($post->state->color() == 'red')
										<x-front.tag :class="'text-black text-xs font-semibold bg-mnw-lightyellow'">
											<span>{{ __('Archived') }}</span>
										</x-front.tag>
									@endif

									<h2 class="text-sm sm:text-base xl:text-lg font-semibold leading-normal" :class="hoverOn ? 'text-mnw-blue': 'text-black'">
										{{ $post->title }}
									</h2>

									<div class="mb-2 group-hover:text-gray-400 ? 'text-mnw-blue group-hover:text-mnw-blue transition duration-200 ease-in-out">
										{{ ucfirst($post->thematic->slug) }} / {{ $post->postType->name }}
									</div>

									<div class="text-gray-400 group-hover:text-gray-500 transition duration-200 ease-in-out">
										@if($post->state->color() == 'green')
											<div class="flex flex-row mt-2">
												<div class="inline-flex items-center mr-4">
													<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2">
														<path d="M6 1.25378V4.25378" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M14 1.25378V4.25378" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M1.5 8.34363H18.5" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M19 7.75378V16.2538C19 19.2538 17.5 21.2538 14 21.2538H6C2.5 21.2538 1 19.2538 1 16.2538V7.75378C1 4.75378 2.5 2.75378 6 2.75378H14C17.5 2.75378 19 4.75378 19 7.75378Z" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M13.6953 12.954H13.7043" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M13.6953 15.954H13.7043" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M9.99609 12.954H10.0051" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M9.99609 15.954H10.0051" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M6.29492 12.954H6.3039" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M6.29492 15.954H6.3039" stroke="#BCBCBC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>

													@php
														$postPublishedDate = $post->published_at->startOfDay();
														$now = now()->startOfDay();

														$dateDiffSincePublishing = $postPublishedDate->diffInDays($now);
													@endphp

													{{ trans_choice('Published-since', $dateDiffSincePublishing, ['diff' => $dateDiffSincePublishing]) }}
												</div>

												<div class="inline-flex items-center mr-4">
													<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2">
														<path d="M2.73828 1.25378V5.60161" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
														<path d="M7.08611 5.60156H2.73828" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
														<path d="M11 1.25378C16.5217 1.25378 21 5.73204 21 11.2538C21 16.7755 16.5217 21.2538 11 21.2538C5.47826 21.2538 1 16.7755 1 11.2538" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
														<path d="M2.75586 5.60161C4.55586 2.97552 7.57323 1.25378 10.9993 1.25378" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
														<path d="M11.4355 5.60156V11.6885" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
														<path d="M16.6529 11.6886H11.4355" stroke="#BCBCBC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
													</svg>

													@php
														$postArchivedAtDate = $post->archived_at->startOfDay();
														$now = now()->startOfDay();

														$dateDiffForArchiving = $now->diffInDays($postArchivedAtDate);
													@endphp

													{{ trans_choice('Expires-in', $dateDiffForArchiving, ['diff' => $dateDiffForArchiving]) }}
												</div>

												@if($post->offer->type == 'print')
													<div class="inline-flex items-center mr-4">
														<span class="font-normal">
															{{ __('Parution date') }} :
														</span>

														@if($post->state->color() == 'green')
															@if($post->parution_date)
																{{ $post->parution_date->format('d/m/Y') }} ({{ __('magazine of :month', ['month' => __($post->parution_date->format('F')) ]) }})
															@else
																{{ $post->getParutionDate() }}
															@endif
														@else
															{{ $post->getParutionDate() }}
														@endif
													</div>
												@endif
											</div>
										@endif
									</div>

									<div class="mt-4 flex flex-row gap-2 justify-start items-center inline-block">
										@if($post->state->color() == 'blue')
											@if($post->hasOfferChangingPending())
												@if($post->isOfferChangePossible())
													<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('space.posts.confirm-offer-change', ['post' => $post]) }}';" :class="'xl:text-sm'">
														{{ __('Confirm my offer change') }}
													</x-primary-button>
												@else
													<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('rates.index', ['compositionId' => 27]) }}';" :class="'xl:text-sm'">
														{{ __('Buy my credit') }}
													</x-primary-button>
												@endif
											@else
												@php
													$subscription = $post->user->hasCreditAvailable($post->offer->slug);
													$isPublishable = false;
												@endphp

												@if(!$post->offer->is_free && !$subscription)
													<x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','publish-post-{{ $post->id }}')" :class="'xl:text-sm'">
														{{ __('Publish the post') }}
													</x-primary-button>

													<x-modal name="publish-post-{{ $post->id }}" :class="'w-full max-w-2xl'" focusable>
														<section class="p-10">
															<div class="flex flex-col flex-wrap items-center">
																<p class="text-center m-auto font-bold text-sm mb-4">
																	{{ __('This post is written in a :offer form', ['offer' => $post->offer->name]) }}.<br/>
																	{{ __('You don\'t have any credit for :offer', ['offer' => $post->offer->name]) }}.<br/>
																	{{ __('Would you like to buy a post credit :offer (available for 12 months) to be able to publish this post', ['offer' => $post->offer->name]) }} ?
																</p>

																<p class="text-center m-auto font-bold text-sm mb-4 text-red-600">
																	<u>{{ __('Be careful to select the correct offer :offer when buying or go in "Edit post\'s content or offer type" to change offer (upgrade/downgrade)', ['offer' => $post->offer->name]) }}</u>
																</p>

																<div class="flex flex-row mt-4 justify-center">
																	<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('rates.index', ['compositionId' => 27]) }}';" :class="'mr-6'">
																		{{ __('Yes, buy my credit') }}
																	</x-primary-button>

																	<x-secondary-button x-data="" x-on:click="$dispatch('close')">
																		{{ __('No, go back to my posts') }}
																	</x-secondary-button>
																</div>
															</div>
														</section>
													</x-modal>
												@elseif($post->offer->slug == 'F1ASH1/4C')
													<x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','publish-post-{{ $post->id }}')" :class="'xl:text-sm'">
														{{ __('Publish the post') }}
													</x-primary-button>

													<x-modal name="publish-post-{{ $post->id }}" :class="'w-full max-w-2xl'" focusable>
														<section class="p-10">
															<div class="flex flex-col flex-wrap items-center">
																<p class="text-center m-auto font-normal text-sm mb-4">
																	{{ __('You are about to publish your Web + Print post') }}.<br>
																	{{ __('The publication date of your print post is') }} : <span class="font-bold">{{ $dateParution }}</span>.<br>
																	{{ __('The publication of the print post is') }} <span class="font-bold underline">{{ __('final') }}</span> : {{ __('you will no longer be able to modify it or change its publication date in the Mag') }}.<br>
																	{{ __('You can however at any time modify your web ad during its two months of publication by clicking on its title (excluding title, type of post and place of the post)') }}.
																</p>

																<p class="text-center m-auto font-bold text-sm mb-4 text-red-600">
																	{{ __('Would you like to publish your web + print post') }} ?
																</p>

																<div class="flex flex-row mt-4 justify-center">
																	<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('space.posts.publish', ['post' => $post]) }}';" :class="'mr-6'">
																		{{ __('Publish the post') }}
																	</x-primary-button>

																	<x-secondary-button x-data="" x-on:click="$dispatch('close')">
																		{{ __('No, go back to my posts') }}
																	</x-secondary-button>
																</div>
															</div>
														</section>
													</x-modal>
												@else
													<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('space.posts.publish', ['post' => $post]) }}';" :class="'xl:text-sm'">
														{{ __('Publish the post') }}
													</x-primary-button>
												@endif
											@endif
										@elseif($post->state->color() == 'green')
											@if($dateDiffForArchiving <= 30)
												@if(!empty($post->offer->slug))
													@if($hasSubscription = $post->user->hasCreditAvailable($post->offer->slug) || $post->offer->is_free)
														<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('space.posts.extend-offer', ['post' => $post]) }}';" :class="'xl:text-sm'">
															{{ __('Extend my post') }}
														</x-primary-button>
													@else
														<x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','publish-post-{{ $post->id }}')" :class="'xl:text-sm'">
															{{ __('Extend my post') }}
														</x-primary-button>

														<x-modal name="publish-post-{{ $post->id }}" :class="'w-full max-w-2xl'" focusable>
															<section class="p-10">
																<div class="flex flex-col flex-wrap items-center">
																	<p class="text-center m-auto font-bold text-sm mb-4">
																		{{ __('This post is written in a :offer form', ['offer' => $post->offer->name]) }}.<br/>
																		{{ __('You don\'t have any credit for :offer', ['offer' => $post->offer->name]) }}.<br/>
																		{{ __('Would you like to buy a post credit :offer (available for 12 months) to be able to extend this post', ['offer' => $post->offer->name]) }} ?
																	</p>

																	<p class="text-center m-auto font-bold text-sm mb-4 text-red-600">
																		<u>{{ __('Be careful to select the correct offer :offer when buying or go in "Edit post\'s content or offer type" to change offer (upgrade/downgrade)', ['offer' => $post->offer->name]) }}</u>
																	</p>

																	<div class="flex flex-row mt-4 justify-center">
																		<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('rates.index', ['compositionId' => 32]) }}';">
																			{{ __('Extend my post') }}
																		</x-primary-button>

																		<x-secondary-button x-data="" x-on:click="$dispatch('close')">
																			{{ __('No, go back to my posts') }}
																		</x-secondary-button>
																	</div>
																</div>
															</section>
														</x-modal>
													@endif
												@endif
											@endif

											<x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','unpublish-post-{{ $post->id }}')" :class="'xl:text-sm'">
												{{ __('Unpublish the post') }}
											</x-primary-button>

											<x-modal name="unpublish-post-{{ $post->id }}" :class="'w-full max-w-2xl'" focusable>
												<section class="p-10">
													<div class="flex flex-col flex-wrap items-center">
														<p class="text-center m-auto font-normal text-sm mb-4">
															{{ __('You are about to unpublish your post') }}.<br/>
															{{ __('If so, your post credit will be consumed and you will need to purchase a new credit if you want to put this ad back online') }}.<br/>
															{{ __('To edit your post, click on its title') }}.
														</p>

														<p class="text-center m-auto font-bold text-sm mb-4 text-red-600">
															{{ __('Are you sure to unpublish this post') }} ?
														</p>

														<div class="flex flex-row mt-4 justify-center">
															<x-primary-button x-data="" x-on:click.prevent="window.location.href='{{ route('space.posts.unpublish', ['post' => $post]) }}';" :class="'mr-6'">
																{{ __('Unpublish the post') }}
															</x-primary-button>

															<x-secondary-button x-data="" x-on:click="$dispatch('close')">
																{{ __('No, go back to my posts') }}
															</x-secondary-button>
														</div>
													</div>
												</section>
											</x-modal>
										@endif

										@if($post->state->color() == 'green' || $post->user->id == Auth::guard('web')->user()->id)
											<div class="shrink-0 flex justify-center items-center size-8 rounded-full bg-mnw-lightblue text-mnw-blue">
												<a href="{{ route('show-post', ['post' => $post]) }}" title="{{ __('Preview this post') }}" target="_blank">
													<svg width="26" height="17" viewBox="0 0 26 17" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M24.5 8.50757C24.5 8.50757 20.5 16.0076 13 16.0076C5.5 16.0076 1.5 8.50757 1.5 8.50757C1.5 8.50757 5.5 1.00757 13 1.00757C20.5 1.00757 24.5 8.50757 24.5 8.50757Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M13 13.0076C15.4853 13.0076 17.5 10.9928 17.5 8.50757C17.5 6.02229 15.4853 4.00757 13 4.00757C10.5147 4.00757 8.5 6.02229 8.5 8.50757C8.5 10.9928 10.5147 13.0076 13 13.0076Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</a>
											</div>
										@endif

										<div class="shrink-0 flex justify-center items-center size-8 rounded-full bg-mnw-lightblue text-mnw-blue">
											<a href="{{ route('space.posts.edit', ['post' => $post]) }}" title="{{ __('Edit this post') }}" target="_blank">
												<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M7.55834 2.89136H4.79283C2.75635 2.89136 1.10547 4.54224 1.10547 6.57872V15.7971C1.10547 17.8336 2.75635 19.4845 4.79283 19.4845H14.0112C16.0477 19.4845 17.6986 17.8336 17.6986 15.7971V13.0316" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M19.0303 5.24729L9.4022 14.8752H5.71484V11.1879L15.3429 1.55994C16.1349 0.767944 17.419 0.767944 18.211 1.55994L19.0303 2.37919C19.8223 3.17118 19.8223 4.4553 19.0303 5.24729Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M7.55859 10.2661L10.3241 13.0316" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</a>
										</div>

										<div class="shrink-0 flex justify-center items-center size-8 rounded-full bg-mnw-lightred text-mnw-red">
											<a href="#" x-data="" x-on:click.prevent="$dispatch('open-modal','delete-post-{{ $post->id }}')" title="{{ __('Delete this post') }}">
												<svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M15.9055 7.56531V19.6108C15.9055 20.6583 15.056 21.5076 14.0079 21.5076H3.91919C2.87117 21.5076 2.02148 20.6585 2.02148 19.6108V7.56531" stroke="#FF2C2C" stroke-width="1.5" stroke-miterlimit="10"/>
													<path d="M2.16427 4.33538H15.836C16.5335 4.33538 17.1001 4.90146 17.1001 5.59885V7.44967H0.900391V5.59867C0.900391 4.90146 1.46674 4.33521 2.16446 4.33521L2.16427 4.33538Z" stroke="#FF2C2C" stroke-width="1.5" stroke-miterlimit="10"/>
													<path d="M5.41602 4.24096V2.52217C5.41602 1.96182 5.87049 1.50757 6.43111 1.50757H11.4972C12.0578 1.50757 12.5123 1.96182 12.5123 2.52217V4.24096" stroke="#FF2C2C" stroke-width="1.5" stroke-miterlimit="10"/>
													<path d="M6.62305 10.1477V18.3545" stroke="#FF2C2C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
													<path d="M11.377 10.1477V18.3545" stroke="#FF2C2C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
												</svg>
											</a>
										</div>
									</div>
								</div>
							</div>

							<div class="flex flex-col justify-between items-center bg-mnw-lightblue">
								<div title="{{ __('Views') }}" class="flex flex-row p-4 gap-2 border-b-2 border-white">
									<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
										<path d="M5.036 2.23097L6.626 5.06597M11 0.990967V4.35697M16.439 2.23097L15.035 5.06597M1 13.862C1 13.862 4.75 7.83797 11 7.83797C17.25 7.83797 21 13.862 21 13.862C21 13.862 17.25 19.886 11 19.886C4.75 19.886 1 13.862 1 13.862ZM11 17.037C11.961 17.037 12.883 16.702 13.562 16.107C14.242 15.512 14.623 14.704 14.623 13.862C14.623 13.02 14.241 12.212 13.562 11.617C12.882 11.022 11.961 10.687 11 10.687C10.039 10.687 9.117 11.022 8.438 11.617C7.758 12.212 7.377 13.02 7.377 13.862C7.377 14.704 7.759 15.512 8.438 16.107C9.118 16.702 10.039 17.037 11 17.037Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
									</svg>

									{{ views($post)->collection('search')->count() }}
								</div>

								<div title="{{ __('Readen') }}" class="flex flex-row p-4 gap-2 border-b-2 border-white">
									<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
										<path d="M20.3306 11.9064L7.51758 7.81042L11.5396 20.7354L14.4456 17.8174L18.0186 21.4314L21.0006 18.4364L17.4266 14.8244L20.3306 11.9074V11.9064Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M4.68392 4.90146L2.79492 2.99146" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M3.672 7.36342L1 7.35242" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M4.68878 9.8335L2.80078 11.7305" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M7.13091 3.89046L7.12891 1.19946" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M9.57812 4.92251L11.4661 3.02551" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round"/>
									</svg>

									{{ views($post)->count() - views($post)->collection('search')->count() }}
								</div>

								<div title="{{ __('Favorites') }}" class="flex flex-row p-4 gap-2 border-b-2 border-white">
									<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
										<path d="M11 21.1923C16.5228 21.1923 21 16.7151 21 11.1923C21 5.66941 16.5228 1.19226 11 1.19226C5.47714 1.19226 1 5.66941 1 11.1923C1 16.7151 5.47714 21.1923 11 21.1923Z" stroke="#0082FF" stroke-width="1.5" stroke-miterlimit="10"/>
										<path d="M16.0842 7.79434C14.8681 6.57816 12.9 6.57816 11.6838 7.79434L11.0031 8.47505L10.3223 7.79434C9.10616 6.57816 7.13807 6.57816 5.9219 7.79434C4.70572 9.01051 4.70572 10.9786 5.9219 12.1948L11.0059 17.2788L16.0899 12.1948C17.3061 10.9786 17.3061 9.01051 16.0899 7.79434H16.0842Z" stroke="#0082FF" stroke-width="1.5" stroke-miterlimit="10"/>
									</svg>

									{{ $post->favoriters()->count() }}
								</div>

								<div title="{{ __('Conversations') }}" class="flex flex-row p-4 gap-2">
									<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
										<path d="M19.4869 16.3388C20.4435 14.8083 21 13.0083 21 11.0692C21 5.54747 16.5217 1.06921 11 1.06921C5.47823 1.06921 1 5.54747 1 11.0692C1 16.591 5.47823 21.0692 11 21.0692C12.9391 21.0692 14.7391 20.5127 16.2695 19.5562L21 21.0692L19.4869 16.3388Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M7.08789 8.89539H14.914" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M7.08789 13.2432H12.3053" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>

									{{ $post->responses()->count() }}
								</div>
							</div>
						</article>

						<x-modal name="delete-post-{{ $post->id }}" :class="'w-full max-w-2xl'" focusable>
							<section class="p-10">
								<header class="flex flex-col flex-wrap content-center">
									<div class="mt-1 text-sm m-auto text-mnw-blue">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
										</svg>
									</div>

									<h2 class="text-lg font-semibold">
										{{ __('Are you sure to delete this post') }} ?
									</h2>
								</header>

								<div class="flex flex-row mt-4 justify-center">
									<form method="post" action="{{ route('space.posts.destroy', ['post' => $post]) }}">
										@method('delete')
										@csrf

										<x-primary-button :class="'mr-6'">
											{{ __('Yes, delete') }}
										</x-primary-button>
									</form>

									<x-secondary-button x-data="" x-on:click="$dispatch('close')">
										{{ __('No, go back to my posts') }}
									</x-secondary-button>
								</div>
							</section>
						</x-modal>
					@endforeach

					<div class="mt-8">
						{!! $posts->links() !!}
					</div>
				@else
					<div class="flex flex-col flex-wrap justify-center content-center h-full bg-mnw-lightblue max-h-[177px]">
						<p class="mb-8 text-center">
							{{ __('You haven\'t created any post yet') }}
						</p>

						<div class="flex justify-center">
							<a href="{{ route('space.posts.show-offers') }}">
								<x-primary-button :class="'xs:block mb-8 mr-4 w-[196px]'">
									{{ __('Create a post') }}
								</x-primary-button>
							</a>

							<a href="{{ route('rates.index', ['compositionId' => 32]) }}">
								<x-front.tertiary-button :class="'xs:block mb-8'">
									{{ __('View our offers') }}
								</x-front.tertiary-button>
							</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
