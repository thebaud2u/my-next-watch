<div>
	<div class="py-5 px-4 lg:px-6">
		<div class="flex flex-col s:flex-row lg:min-h-[600px]">
			<div class="flex-1">
				<div class="flex flex-row justify-between">
					<x-front.space.space-title>
						{{ __('My favorites & followed') }}
					</x-front.space.space-title>
				</div>

				@if($favorites->isNotEmpty())
					<h2 class="text-base font-bold mb-4">
						{{ __('Favorites') }}
					</h2>

					@foreach($favorites as $post)
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

							if((!empty($product) && $product > 1 && $product != 3)) $classes .= " shadow-lg border-2 border-annonces-blue hover:border-annonces-blue";
							else {
								if($product == 3) $classes .= " shadow-lg border-2 border-annonces-yellow hover:border-annonces-yellow";
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
										<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-gray'">
											<span>{{ __('Draft') }}</span>
										</x-front.tag>
									@elseif($post->state->color() == 'green')
										<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-lightgreen'">
											<span>{{ __('Published') }}</span>
										</x-front.tag>
									@elseif($post->state->color() == 'red')
										<x-front.tag :class="'text-black text-xs font-semibold bg-annonces-lightyellow'">
											<span>{{ __('Archived') }}</span>
										</x-front.tag>
									@endif

									<a href="{{ route('show-post', ['post' => $post]) }}" target="_blank">
										<h2 class="text-sm sm:text-base xl:text-lg font-semibold leading-normal" :class="hoverOn ? 'text-annonces-blue': 'text-black'">
											{{ $post->title }}
										</h2>
									</a>

									<div class="mb-2 group-hover:text-gray-400 ? 'text-annonces-blue group-hover:text-annonces-blue transition duration-200 ease-in-out">
										{{ ucfirst($post->thematic->slug) }} / {{ $post->postType->name }}
									</div>
								</div>
							</div>

							<div class="flex flex-col justify-center items-center mr-24">
								@if(Auth::user()->hasFavorited($post))
									<a href="{{ route('space.favorites.favorite', ['post' => $post]) }}" title="{{ __('In my favorites') . ' (' . __('remove') . ')' }}" class="text-annonces-blue hover:text-annonces-blue rounded-full bg-annonces-lightblue flex justify-center items-center w-12 h-12">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" fill="currentColor" class="w-6 h-6 lg:w-7 lg:h-7 pointer-events-none">
											<path id="ic_coeur_2" d="M19.1075 2.48822C17.1232 0.503926 13.8996 0.503926 11.9087 2.48822L10.7946 3.60233L9.68047 2.48822C7.69617 0.503926 4.47252 0.503926 2.48822 2.48822C0.503926 4.47252 0.503926 7.69617 2.48822 9.68706L10.8012 18L19.1141 9.68706C21.0984 7.70276 21.0984 4.47911 19.1141 2.48822H19.1075Z"/>
										</svg>
									</a>
								@else
									<a href="{{ route('space.favorites.favorite', ['post' => $post]) }}" title="{{ __('Add to my favorites') }}" class="group text-annonces-blue group-hover:text-annonces-blue rounded-full bg-annonces-lightblue flex justify-center items-center w-12 h-12">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 lg:w-7 lg:h-7 pointer-events-none group-hover:stroke-annonces-blue group-hover:fill-annonces-blue w-6 h-6">
											<path id="ic_coeur_2" d="M19.1075 2.48822C17.1232 0.503926 13.8996 0.503926 11.9087 2.48822L10.7946 3.60233L9.68047 2.48822C7.69617 0.503926 4.47252 0.503926 2.48822 2.48822C0.503926 4.47252 0.503926 7.69617 2.48822 9.68706L10.8012 18L19.1141 9.68706C21.0984 7.70276 21.0984 4.47911 19.1141 2.48822H19.1075Z"/>
										</svg>
									</a>
								@endif
							</div>
						</article>
					@endforeach
				@endif

				@if($followed->isNotEmpty())
					<h2 class="text-base font-bold mb-4">
						{{ __('Followed') }}
					</h2>

					@foreach($followed as $user)
						<article class="flex flex-col p-8 rounded shadow-lg bg-white  hover:bg-gray-50 border-t border-x border-gray-100 hover:border-gray-200" x-data="{hoverOn: false}" @mouseleave="hoverOn = false" @mouseover="hoverOn = true">
							<div class="flex flex-row justify-between items-center">
								<div class="flex flex-row justify-center items-center">
									@php
										$advertiserImage = null;
										if($user->type == 'Professionnel') {
											// Si l'utilisateur n'a pas de logo pour son entreprise, on fous son avatar
											if(!is_null($user->getFirstMedia('logo'))) $advertiserImage = $user->getFirstMedia('logo')->getAvailableUrl(['optimized']);
											elseif(!is_null($user->getFirstMedia('avatar'))) $advertiserImage = $user->getFirstMedia('avatar')->getAvailableUrl(['optimized']);
										}
										elseif(!is_null($user->getFirstMedia('avatar'))) $advertiserImage = $user->getFirstMedia('avatar')->getAvailableUrl(['optimized']);
									@endphp

									@if(is_null($advertiserImage))
										<div class="shrink-0 flex justify-center items-center size-12 rounded-full bg-gray-100 text-gray-500 text-xl font-semibold mr-3">
											@if($user->type == 'Professionnel')
												{{ \Illuminate\Support\Str::acronym($user->values['company_name']) }}
											@else
												{{ \Illuminate\Support\Str::acronym($user->name) }}
											@endif
										</div>
									@else
										<div class="aspect-square rounded-full shadow-md bg-white flex justify-center items-center">
											<div class="w-2/3 aspect-square flex items-center">
												<img src="{{ $advertiserImage }}" class="object-contain" />
											</div>
										</div>
									@endif

									<a href="{{ route('profile', ['user' => $user]) }}" target="_blank">
										<div class="text-base xl:text-lg font-semibold truncate" :class="hoverOn ? 'text-annonces-blue': 'text-black'">
											@if($user->type == 'Professionnel')
												<span title="{{ $user->values['company_name'] }}">
													{{ $user->values['company_name'] }}
												</span>
											@else
												<span title="{{ $user->name }}">
													{{ $user->name }}
												</span>
											@endif
										</div>
									</a>
								</div>

								<div>
									{{-- Follow --}}
									@if(Auth::user()->isFollowing($user))
										<x-front.secondary-button :class="'px-4 py-1 mr-2 hover:bg-annonces-blue hover:text-white font-semibold'">
											<a href="{{ route('space.favorites.follow', ['user' => $user]) }}">
												{{ __('Unfollow') }}
											</a>
										</x-front.secondary-button>
									@else
										<x-front.secondary-button :class="'px-4 py-1 mr-2 hover:bg-annonces-blue hover:text-white font-semibold'">
											<a href="{{ route('space.favorites.follow', ['user' => $user]) }}">
												{{ __('Follow') }}
											</a>
										</x-front.secondary-button>
									@endif
								</div>
							</div>

							<div class="flex flex-row w-full mt-4 gap-6">
								<div class="flex flex-row gap-2">
									<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-annonces-blue">
										<path d="M11 21C9.02219 21 7.08883 20.4135 5.44434 19.3147C3.79985 18.2159 2.51811 16.6541 1.76123 14.8268C1.00436 12.9996 0.806291 10.9889 1.19214 9.0491C1.57799 7.10929 2.53043 5.32746 3.92896 3.92894C5.32748 2.53041 7.10927 1.578 9.04908 1.19215C10.9889 0.8063 12.9996 1.00433 14.8268 1.76121C16.6541 2.51808 18.2159 3.79981 19.3147 5.4443C20.4135 7.08879 21 9.02219 21 11C21 13.6522 19.9464 16.1957 18.071 18.0711C16.1957 19.9464 13.6522 21 11 21Z" stroke="#0082FF" stroke-width="1.5"/>
										<path d="M6.14453 16.1786C6.16683 15.6501 6.33404 15.1379 6.62801 14.6981C6.92198 14.2583 7.33137 13.9079 7.8112 13.6852C9.85879 12.8735 12.1389 12.8735 14.1865 13.6852C14.6663 13.908 15.0756 14.2584 15.3695 14.6982C15.6635 15.1379 15.8308 15.6501 15.8532 16.1786" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M8.40626 8.42597C8.40798 8.9394 8.56189 9.44081 8.84857 9.86676C9.13524 10.2927 9.54185 10.6241 10.0169 10.819C10.4919 11.0139 11.0139 11.0636 11.5172 10.9617C12.0204 10.8599 12.4822 10.6111 12.844 10.2468C13.2058 9.88253 13.4516 9.41915 13.5501 8.91525C13.6485 8.41134 13.5954 7.88954 13.3973 7.41585C13.1992 6.94215 12.8651 6.53782 12.4373 6.254C12.0094 5.97017 11.507 5.81959 10.9936 5.8213C10.6527 5.82244 10.3154 5.89071 10.0008 6.02223C9.6863 6.15374 9.40075 6.34591 9.1605 6.58778C8.92024 6.82964 8.72993 7.11647 8.60052 7.43186C8.47111 7.74726 8.40512 8.08506 8.40626 8.42597Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>

									{{ __('Member since :date', ['date' => \Carbon\Carbon::parse($user->created_at)->translatedFormat('F Y')]) }}
								</div>

								@if($user->address)
									@php
										if($user->address->city || $user->address->custom_city) {
											$street = $user->address->street ? $user->address->street.',' : '';
											$city = $user->address->city ? $user->address->city->name : $user->address->custom_city;
											$code = $user->address->city->zip_code ? $user->address->city->zip_code : (($user->address->custom_city && $user->address->custom_postcode) ? $user->address->custom_postcode : '');

											$location = $street.' '.$city.', '.$code.', '.$user->address->country->name;
										}
										elseif($user->address->department) $location = $user->address->department->name.' ('.$user->address->department->code.')';
										elseif($user->address->region) $location = $user->address->region->name;
										elseif($user->address->country) $location = $user->address->country->name;
										else $location = __('Unknown location');
									@endphp

									<div class="flex flex-row gap-2">
										<svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-annonces-blue">
											<path d="M19 10C19 17 10 24 10 24C10 24 1 17 1 10C1 5.03 5.03 1 10 1C14.97 1 19 5.03 19 10Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M10 14C12.2091 14 14 12.2091 14 10C14 7.79086 12.2091 6 10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ $location }}
									</div>
								@endif
							</div>
						</article>
					@endforeach
				@endif

				@if($favorites->isEmpty() && $followed->isEmpty())
					<div class="flex flex-col flex-wrap justify-center content-center h-full bg-annonces-lightblue max-h-[177px]">
						<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M68.8984 15.1345L53.8984 0.147461H61.9974C65.8034 0.147461 68.8984 3.22746 68.8984 7.04246V15.1475" fill="#002C6A"/>
							<path d="M65.125 54.0316L50.125 69.0186H58.224C62.03 69.0186 65.125 65.9386 65.125 62.1236V54.0186" fill="#0082FF"/>
							<path d="M1 20.1305L21 0.147461H10.201C5.126 0.147461 1 4.25346 1 9.34146V20.1475" fill="#0082FF"/>
							<path d="M30.2969 59.7461H44.8343V22.3875H15.7773V38.2389" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M49.0068 48.3157H55.1819V12H26.125V18.2158" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M22.7188 31.0323H38.2093" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M24.8047 40.743H38.2094" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M31.0625 50.4537H38.2097" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M19.533 51.361C19.533 49.2856 17.8508 47.6023 15.7743 47.6023C13.6979 47.6023 12.0156 49.2856 12.0156 51.361V55.9874C12.0156 58.0628 13.6989 59.7461 15.7743 59.7461C17.8497 59.7461 19.533 58.0628 19.533 55.9874V51.361Z" stroke="#002C6A" stroke-width="2"/>
							<path d="M15.7746 65.4091C22.2783 65.4091 27.5493 60.1371 27.5493 53.6345C27.5493 47.1319 22.2773 41.8599 15.7746 41.8599C9.27199 41.8599 4 47.1308 4 53.6334C4 60.1361 9.27199 65.4091 15.7746 65.4091Z" stroke="#002C6A" stroke-width="2" stroke-linecap="round"/>
						</svg>

						<p class="mb-8 text-center">
							{{ __('You have no favorites nor followed anyone') }}
						</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
