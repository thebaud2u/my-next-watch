<x-app-layout>
	@push('seo')
		<title>{{ __('Find your job in transport and logistics') }}</title>
		<meta name="description" content="{{ __('With its candidate space :siteName allows you to apply for a job of driver, deliveryman, driver, forklift operator, technician, engineer and more', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, logistics transport professions, transport, logistics, employment transport, logistics job, jobs, offers, announcements, research, employment, work, paycheck, profession, jobs, job-search, CDI, CDD, internship, alternation, learning, recruiting, interim, teacher, road, maritime, rail, fluvial, registered, multi modal, schools, training centre, chauffeur, driver, pilot, deliveryman, road, director, responsible, chief, agent, quay, commissionaire, commercial, controller, engineer, deckhand, officer, freight, storekeeper, cargo handler, mechanic, loader, truck driver, engineer, manager, logistician, preparer', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1">
	@endpush

	<div class="py-5 px-4 lg:px-6">
		<div class="flex flex-col s:flex-row lg:min-h-[600px]">
			<div class="flex-1">
				<div class="w-full shadow-lg px-6 py-10 mb-6">
					<div class="flex justify-between">
						<div class="flex flex-row items-center">
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

							<div class="text-base xl:text-lg font-semibold truncate">
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
						</div>

						<div class="flex flex-row items-end">
							{{-- Follow --}}
							@if(Auth::guard('web')->check())
								@role('registered')
									@if(Auth::guard('web')->user()->id != $user->id)
										@if(Auth::user()->isFollowing($user))
											<x-secondary-button :class="'px-4 py-1 mr-2 hover:bg-mnw-blue hover:text-white font-semibold'">
												<a href="{{ route('space.favorites.follow', ['user' => $user]) }}">
													{{ __('Unfollow') }}
												</a>
											</x-secondary-button>
										@else
											<x-secondary-button :class="'px-4 py-1 mr-2 hover:bg-mnw-blue hover:text-white font-semibold'">
												<a href="{{ route('space.favorites.follow', ['user' => $user]) }}">
													{{ __('Follow') }}
												</a>
											</x-secondary-button>
										@endif
									@endif
								@endrole
							@endif
						</div>
					</div>

					<div class="flex flex-row w-full mt-4 gap-6">
						<div class="flex flex-row gap-2">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
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
								<svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-mnw-blue">
									<path d="M19 10C19 17 10 24 10 24C10 24 1 17 1 10C1 5.03 5.03 1 10 1C14.97 1 19 5.03 19 10Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M10 14C12.2091 14 14 12.2091 14 10C14 7.79086 12.2091 6 10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>

								{{ $location }}
							</div>
						@endif
					</div>
				</div>

				<div class="flex flex-row justify-end text-mnw-gray mb-4">
					{{ trans_choice('Total-post', $user->posts()->count(), ['total' => $user->posts()->count()]) }}
				</div>

				@if($user->posts->isNotEmpty())
					@foreach($user->posts as $post)
						<x-front.posts.post-list :post="$post" />
					@endforeach
				@else
					<div class="flex flex-col justify-center items-center w-full shadow-lg px-6 py-10 mb-6 gap-2">
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

						<div class="font-bold">
							{{ __('0 published posts') }}
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</x-app-layout>
