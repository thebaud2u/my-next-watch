<div class="flex flex-col
@if ((Route::is('home.breeder') || Route::is('home.pro'))
	|| Auth::guard('web')->user()?->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']))
	bg-jobboard-deepblue @else bg-white @endif
px-4 h-screen overflow-y-auto overscroll-contain">
	@php
		if(Auth::guard('web')->check()) {
			$route = route('space.posts.show-offers');
		} else {
			$route = route('register');
		}
	@endphp

	<div class="w-full flex flex-col gap-y-1 mt-6">
		@if ((Route::is('home.breeder') || Route::is('home.pro'))	|| Auth::guard('web')->user()?->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']))
			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('pages.quisommesnous')" :active="request()->routeIs('pages.quisommesnous')" :textColor="'text-jobboard-cream'" :svgArrows="false">
					{{ __('About') }}
				</x-front.header.nav-link-mobile>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('post-search.dog-posts-with-post-type', ['postType' => 'etalon'])" :active="request()->routeIs('post-search.dog-posts*')" :textColor="'text-jobboard-cream'" :svgArrows="true">
					<svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.814 0.298082C9.93011 -0.570356 8.10483 0.709982 7.21685 1.01231C4.81192 1.83002 2.2261 2.05525 0.75025 4.36838C-1.72252 8.24795 2.38026 16.8329 6.32682 13.9314C8.43987 12.3771 6.45837 8.20331 8.07811 5.92062C8.72764 5.00754 9.93011 4.66057 10.5632 3.504C10.9517 2.79586 11.4327 0.904772 10.8119 0.296053L10.814 0.298082ZM28.4666 3.364C26.9928 1.90916 25.1038 1.87669 23.2909 1.27C21.5992 0.705924 18.4029 -1.6762 18.8983 2.15873C19.2312 4.73564 22.0514 5.07855 22.4892 7.13602C22.9353 9.2361 21.5868 13.6148 24.4234 14.3554C26.5488 14.9094 27.8931 13.4079 28.7852 11.7501C30.1644 9.18741 30.7462 5.61017 28.4687 3.364H28.4666ZM10.3967 6.97979C8.82631 7.29835 9.29291 9.7941 10.7215 9.73322C12.6064 9.65206 12.5694 6.53948 10.3967 6.97979ZM18.1089 9.32741C19.3854 10.6544 21.5067 8.45289 20.1048 7.25574C18.703 6.05859 17.0031 8.17693 18.1089 9.32741ZM6.5447 14.6557V23.4822C6.5447 23.612 7.04008 23.9671 7.27029 23.9914C9.0853 24.1862 8.05344 20.9519 8.19116 19.9313C10.3207 21.6763 12.7708 22.3012 14.8983 20.1504C17.0976 22.1836 19.2641 21.727 21.5498 20.1342V23.2792C21.5498 24.2552 23.3998 24.0868 23.3998 23.4822V14.6557C21.1984 14.5746 21.6958 15.8427 21.1819 17.2347C20.5427 18.9614 18.2261 20.7287 16.5283 19.1075C15.8602 18.4704 15.5663 16.6361 15.7924 15.8143C15.8911 15.4532 17.704 14.9499 17.4019 13.3896C16.9455 11.0379 12.4234 11.3544 12.52 13.7264C12.5838 15.2807 14.1274 15.6723 14.1603 15.8062C14.8469 18.6347 12.3001 21.1426 9.82734 18.8234C8.15827 17.257 9.15519 14.4508 6.5447 14.6578V14.6557Z" fill="#FF7E71"/>
						<path d="M10.814 0.298202C11.4347 0.906921 10.9517 2.79801 10.5652 3.50615C9.93215 4.66272 8.72762 5.00969 8.08014 5.92276C6.45835 8.20343 8.43985 12.3792 6.32886 13.9335C2.38024 16.833 -1.72254 8.24807 0.750231 4.3685C2.22608 2.05537 4.8119 1.83014 7.21683 1.01243C8.10481 0.710101 9.93009 -0.572266 10.814 0.298202Z" fill="#FF7E71"/>
						<path d="M28.4667 3.36399C30.7442 5.61017 30.1625 9.1874 28.7832 11.7501C27.8911 13.4058 26.5468 14.9094 24.4215 14.3554C21.5828 13.6148 22.9333 9.2361 22.4872 7.13602C22.0494 5.07855 19.2293 4.73564 18.8963 2.15873C18.4009 -1.6762 21.5972 0.705922 23.2889 1.27C25.1018 1.87669 26.9908 1.90916 28.4646 3.36399H28.4667Z" fill="#FF7E71"/>
						<path d="M6.54492 14.6557C9.15541 14.4508 8.15849 17.2549 9.82755 18.8214C12.2983 21.1406 14.845 18.6327 14.1605 15.8041C14.1277 15.6702 12.584 15.2786 12.5203 13.7244C12.4237 11.3524 16.9457 11.0358 17.4021 13.3875C17.7042 14.9479 15.8913 15.4531 15.7926 15.8123C15.5686 16.634 15.8625 18.4683 16.5285 19.1054C18.2263 20.7287 20.5429 18.9593 21.1821 17.2326C21.6981 15.8407 21.1986 14.5725 23.4 14.6537V23.4801C23.4 24.0847 21.5501 24.2532 21.5501 23.2772V20.1321C19.2644 21.7249 17.0979 22.1815 14.8985 20.1484C12.771 22.2992 10.3209 21.6742 8.19138 19.9292C8.05366 20.9498 9.08552 24.1862 7.27051 23.9894C7.0403 23.965 6.54492 23.6099 6.54492 23.4801V14.6537V14.6557Z" fill="#FF7E71"/>
						<path d="M18.1089 9.32746C17.003 8.17698 18.6762 6.03835 20.1047 7.25579C21.5333 8.47323 19.3853 10.6545 18.1089 9.32746Z" fill="#FF7E71"/>
						<path d="M10.3965 6.97988C12.5713 6.53957 12.6062 9.65418 10.7213 9.73331C9.29275 9.79419 8.82615 7.29844 10.3965 6.97988Z" fill="#FF7E71"/>
					</svg>
					
					{{ __('Dogs') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col bg-jobboard-deepblue text-jobboard-cream pl-4" x-show="deployItem">
					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'etalon']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Stallions for company') }}
					</a>

					<a href="{{ route('company-search.dog-companies') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dog breeders') }}
					</a>
					
					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'portee']) }}" class="font-medium hover:font-bold hover:border-l-3 border-jobboard-coral p-4 ">
						{{ __('Puppies to adopt') }}
					</a>

					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'adulte-retraite']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dogs to adopt') }}
					</a>

					<a href="{{ route('breed-search.dog-breeds') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dogs breeds') }}
					</a>
				</div>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('post-search.cat-posts-with-post-type', ['postType' => 'etalon'])" :active="request()->routeIs('post-search.cat-posts*')" :textColor="'text-jobboard-cream'" :svgArrows="true">
					<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_1439_5721)">
							<path d="M16.5551 16.1234C16.2029 15.9003 14.3102 16.2136 13.716 16.0902C13.3423 17.0848 14.4611 17.5477 14.3461 18.229C14.0011 20.2872 12.1229 19.5584 12.0246 20.4819C11.9072 21.5928 13.1051 21.3911 13.855 21.0919C14.3797 20.883 14.8636 20.1756 15.0649 20.14C15.2901 20.0997 17.59 22.3928 18.3998 20.8403C18.8622 19.9572 16.464 19.9596 16.0232 18.4118C15.7549 17.467 17.4726 16.7026 16.5551 16.1234Z" fill="#3DD8AC"/>
							<path d="M21.0233 15.6178C19.3726 15.6178 17.5973 12.5839 17.0655 11.2308C16.6199 10.0985 16.2222 7.40648 15.834 6.75603C14.0037 4.90202 14.0492 9.51211 13.5461 10.5804C12.9615 12.6599 11.4929 15.0907 9.28637 15.6178L2.92556 13.9465C2.80817 12.7074 4.55949 11.048 4.80865 10.2243C5.11291 9.22013 4.05398 4.96137 4.13543 3.51093C4.15699 3.11924 4.06356 0.424874 5.33332 0.0497995C6.32039 -0.242189 7.39609 0.818939 7.72911 1.13704C12.341 5.52398 10.6496 5.59045 15.2495 4.72161C18.2394 4.15662 18.8575 5.59283 19.3439 5.17502C21.0041 2.56375 25.834 -3.58225 25.9371 3.27354C26.0952 5.09906 25.2495 9.17027 25.5034 10.2124C25.5945 10.5827 26.7876 12.2397 27.1062 12.9186C27.2523 13.2296 27.3458 13.9086 27.3865 13.9442M9.81823 10.9103C8.08608 11.4041 8.71377 14.1863 10.4292 13.918C12.5806 13.5833 11.9864 10.2907 9.81823 10.9103ZM21.0736 11.1786C19.5355 9.93941 17.353 12.2112 19.2337 13.5905C20.8077 14.7465 22.4632 12.2991 21.0736 11.1786Z" fill="#3DD8AC"/>
							<path d="M7.72177 19.0314C8.76873 18.8391 9.34611 19.9311 8.62019 20.3061C7.99729 20.6266 4.85402 21.9061 4.76538 21.6996C4.67673 21.4931 6.25555 23.321 6.54784 23.5512C11.8928 27.9382 21.6269 27.4824 25.4554 21.5548C24.6983 21.3317 22.2953 20.7311 21.8593 20.2492C21.4975 19.8503 21.4808 19.1073 22.0102 18.9578C22.9254 19.0456 26.694 20.4319 27.8488 20.8403C23.0404 30.8367 7.51574 29.9275 2.21387 20.8403C2.21387 20.8403 6.82815 19.1952 7.71938 19.0314H7.72177Z" fill="#3DD8AC"/>
							<path d="M16.5551 16.1234C17.4726 16.705 15.7549 17.467 16.0232 18.4119C16.464 19.9596 18.8622 19.9573 18.3998 20.8403C17.59 22.3929 15.2901 20.0997 15.0649 20.14C14.8636 20.1757 14.3773 20.8807 13.855 21.092C13.1051 21.3911 11.9072 21.5952 12.0246 20.4819C12.1229 19.5608 14.0011 20.2872 14.3461 18.2291C14.4611 17.5478 13.3423 17.0849 13.716 16.0902C14.4036 15.6154 16.2053 15.9003 16.5551 16.1234Z" fill="#3DD8AC"/>
							<path d="M7.46696 16.4538L0.650714 16.8503C0.2703 16.8724 -0.0199805 17.1959 0.0023537 17.5729C0.0246879 17.9498 0.351179 18.2375 0.731593 18.2153L7.54784 17.8188C7.92825 17.7967 8.21853 17.4732 8.1962 17.0962C8.17386 16.7193 7.84737 16.4317 7.46696 16.4538Z" fill="#3DD8AC"/>
							<path d="M22.451 17.818L29.2673 18.2146C29.6477 18.2367 29.9742 17.9491 29.9965 17.5721C30.0188 17.1952 29.7285 16.8717 29.3481 16.8496L22.5319 16.453C22.1515 16.4309 21.825 16.7185 21.8026 17.0955C21.7803 17.4724 22.0706 17.7959 22.451 17.818Z" fill="#3DD8AC"/>
							<path d="M21.3158 15.617L29.2503 13.9788C29.6234 13.9018 29.8628 13.5397 29.785 13.1701C29.7073 12.8004 29.3419 12.5632 28.9688 12.6402L21.0343 14.2784C20.6612 14.3554 20.4218 14.7175 20.4996 15.0871C20.5773 15.4568 20.9427 15.694 21.3158 15.617Z" fill="#3DD8AC"/>
							<path d="M9.32778 14.2774L1.39325 12.6392C1.0202 12.5622 0.65476 12.7994 0.577028 13.1691C0.499296 13.5387 0.738704 13.9008 1.11176 13.9778L9.04628 15.616C9.41934 15.693 9.78478 15.4558 9.86251 15.0861C9.94024 14.7165 9.70083 14.3544 9.32778 14.2774Z" fill="#3DD8AC"/>
						</g>

						<defs>
							<clipPath id="clip0_1439_5721">
								<rect width="30" height="28" fill="white"/>
							</clipPath>
						</defs>
					</svg>
					
					{{ __('Cats') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col bg-jobboard-deepblue text-jobboard-cream pl-4" x-show="deployItem">
					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'etalon']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Stallions for company') }}
					</a>

					<a href="{{ route('company-search.cat-companies') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cat breeders') }}
					</a>

					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'portee']) }}" class="font-medium hover:font-bold hover:border-l-3 border-jobboard-coral p-4 ">
						{{ __('Kittens to adopt') }}
					</a>

					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'adulte-retraite']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cats to adopt') }}
					</a>

					<a href="{{ route('breed-search.cat-breeds') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cats breeds') }}
					</a>
				</div>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('professionnal-activity-search.professionnal-activities')" :active="request()->routeIs('professionnal-activity-search.professionnal-activities')" :active="request()->routeIs('professionnal-activity-search.professionnal-activities')" :textColor="'text-jobboard-cream'" :svgArrows="false">
					{{ __('Products & Services') }}
				</x-front.header.nav-link-mobile>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('article.index')" :active="request()->routeIs('article.index')" :textColor="'text-jobboard-cream'">
					{{ __('Articles & advices') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col gap-4 bg-jobboard-deepblue text-jobboard-cream p-4 ml-4 mr-4" x-show="deployItem" x-data="{deployNavOwner: false, deployNavBreeder: false, deployNavPro: false}">
					<a href="{{ route('article.index', ['arg1' => 'nutrition']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Nutrition') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'sante']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Santé') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'conseils-entretien']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Conseils & entretien') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'education-comportement']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						<span class="whitespace-nowrap">{{ __('Éducation & comportement') }}</span>
					</a>

					<a href="{{ route('article.index', ['arg1' => 'reproduction-genetique']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Reproduction & génétique') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'prevention']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Prevention') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'gestion-elevage']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Gestion d\'entreprise') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'legislation']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Legislation') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'produits']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Products') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'marches-entreprises']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Markets & businesses') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'agenda']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Agenda') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'inspiration']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Inspiration') }}
					</a>
				</div>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('professionnal') ? route('home.pro') : route('home.offer')" :active="Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('professionnal') ? request()->routeIs('home.pro') : request()->routeIs('home.offer')" :textColor="'text-jobboard-cream'" :svgArrows="false">
					{{ __('Our offers') }}
				</x-front.header.nav-link-mobile>
			</div>
		@else
			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('post-search.dog-posts')" :active="request()->routeIs('post-search.dog-posts*')">
					<svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.814 0.298082C9.93011 -0.570356 8.10483 0.709982 7.21685 1.01231C4.81192 1.83002 2.2261 2.05525 0.75025 4.36838C-1.72252 8.24795 2.38026 16.8329 6.32682 13.9314C8.43987 12.3771 6.45837 8.20331 8.07811 5.92062C8.72764 5.00754 9.93011 4.66057 10.5632 3.504C10.9517 2.79586 11.4327 0.904772 10.8119 0.296053L10.814 0.298082ZM28.4666 3.364C26.9928 1.90916 25.1038 1.87669 23.2909 1.27C21.5992 0.705924 18.4029 -1.6762 18.8983 2.15873C19.2312 4.73564 22.0514 5.07855 22.4892 7.13602C22.9353 9.2361 21.5868 13.6148 24.4234 14.3554C26.5488 14.9094 27.8931 13.4079 28.7852 11.7501C30.1644 9.18741 30.7462 5.61017 28.4687 3.364H28.4666ZM10.3967 6.97979C8.82631 7.29835 9.29291 9.7941 10.7215 9.73322C12.6064 9.65206 12.5694 6.53948 10.3967 6.97979ZM18.1089 9.32741C19.3854 10.6544 21.5067 8.45289 20.1048 7.25574C18.703 6.05859 17.0031 8.17693 18.1089 9.32741ZM6.5447 14.6557V23.4822C6.5447 23.612 7.04008 23.9671 7.27029 23.9914C9.0853 24.1862 8.05344 20.9519 8.19116 19.9313C10.3207 21.6763 12.7708 22.3012 14.8983 20.1504C17.0976 22.1836 19.2641 21.727 21.5498 20.1342V23.2792C21.5498 24.2552 23.3998 24.0868 23.3998 23.4822V14.6557C21.1984 14.5746 21.6958 15.8427 21.1819 17.2347C20.5427 18.9614 18.2261 20.7287 16.5283 19.1075C15.8602 18.4704 15.5663 16.6361 15.7924 15.8143C15.8911 15.4532 17.704 14.9499 17.4019 13.3896C16.9455 11.0379 12.4234 11.3544 12.52 13.7264C12.5838 15.2807 14.1274 15.6723 14.1603 15.8062C14.8469 18.6347 12.3001 21.1426 9.82734 18.8234C8.15827 17.257 9.15519 14.4508 6.5447 14.6578V14.6557Z" fill="#FF7E71"/>
						<path d="M10.814 0.298202C11.4347 0.906921 10.9517 2.79801 10.5652 3.50615C9.93215 4.66272 8.72762 5.00969 8.08014 5.92276C6.45835 8.20343 8.43985 12.3792 6.32886 13.9335C2.38024 16.833 -1.72254 8.24807 0.750231 4.3685C2.22608 2.05537 4.8119 1.83014 7.21683 1.01243C8.10481 0.710101 9.93009 -0.572266 10.814 0.298202Z" fill="#FF7E71"/>
						<path d="M28.4667 3.36399C30.7442 5.61017 30.1625 9.1874 28.7832 11.7501C27.8911 13.4058 26.5468 14.9094 24.4215 14.3554C21.5828 13.6148 22.9333 9.2361 22.4872 7.13602C22.0494 5.07855 19.2293 4.73564 18.8963 2.15873C18.4009 -1.6762 21.5972 0.705922 23.2889 1.27C25.1018 1.87669 26.9908 1.90916 28.4646 3.36399H28.4667Z" fill="#FF7E71"/>
						<path d="M6.54492 14.6557C9.15541 14.4508 8.15849 17.2549 9.82755 18.8214C12.2983 21.1406 14.845 18.6327 14.1605 15.8041C14.1277 15.6702 12.584 15.2786 12.5203 13.7244C12.4237 11.3524 16.9457 11.0358 17.4021 13.3875C17.7042 14.9479 15.8913 15.4531 15.7926 15.8123C15.5686 16.634 15.8625 18.4683 16.5285 19.1054C18.2263 20.7287 20.5429 18.9593 21.1821 17.2326C21.6981 15.8407 21.1986 14.5725 23.4 14.6537V23.4801C23.4 24.0847 21.5501 24.2532 21.5501 23.2772V20.1321C19.2644 21.7249 17.0979 22.1815 14.8985 20.1484C12.771 22.2992 10.3209 21.6742 8.19138 19.9292C8.05366 20.9498 9.08552 24.1862 7.27051 23.9894C7.0403 23.965 6.54492 23.6099 6.54492 23.4801V14.6537V14.6557Z" fill="#FF7E71"/>
						<path d="M18.1089 9.32746C17.003 8.17698 18.6762 6.03835 20.1047 7.25579C21.5333 8.47323 19.3853 10.6545 18.1089 9.32746Z" fill="#FF7E71"/>
						<path d="M10.3965 6.97988C12.5713 6.53957 12.6062 9.65418 10.7213 9.73331C9.29275 9.79419 8.82615 7.29844 10.3965 6.97988Z" fill="#FF7E71"/>
					</svg>

					{{ __('Dogs') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col bg-jobboard-cream text-jobboard-deepblue" x-show="deployItem">
					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'portee']) }}" class="font-medium hover:font-bold hover:border-l-3 border-jobboard-coral p-4 ">
						{{ __('Puppies to adopt') }}
					</a>

					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'adulte-retraite']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dogs to adopt') }}
					</a>

					<a href="{{ route('company-search.dog-companies') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dog breeders') }}
					</a>

					<a href="{{ route('breed-search.dog-breeds') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Dogs breeds') }}
					</a>

					<a href="{{ route('post-search.dog-posts-with-post-type', ['postType' => 'etalon']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Stallions for company') }}
					</a>
				</div>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('post-search.cat-posts')" :active="request()->routeIs('post-search.cat-posts*')">
					<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_1439_5721)">
							<path d="M16.5551 16.1234C16.2029 15.9003 14.3102 16.2136 13.716 16.0902C13.3423 17.0848 14.4611 17.5477 14.3461 18.229C14.0011 20.2872 12.1229 19.5584 12.0246 20.4819C11.9072 21.5928 13.1051 21.3911 13.855 21.0919C14.3797 20.883 14.8636 20.1756 15.0649 20.14C15.2901 20.0997 17.59 22.3928 18.3998 20.8403C18.8622 19.9572 16.464 19.9596 16.0232 18.4118C15.7549 17.467 17.4726 16.7026 16.5551 16.1234Z" fill="#3DD8AC"/>
							<path d="M21.0233 15.6178C19.3726 15.6178 17.5973 12.5839 17.0655 11.2308C16.6199 10.0985 16.2222 7.40648 15.834 6.75603C14.0037 4.90202 14.0492 9.51211 13.5461 10.5804C12.9615 12.6599 11.4929 15.0907 9.28637 15.6178L2.92556 13.9465C2.80817 12.7074 4.55949 11.048 4.80865 10.2243C5.11291 9.22013 4.05398 4.96137 4.13543 3.51093C4.15699 3.11924 4.06356 0.424874 5.33332 0.0497995C6.32039 -0.242189 7.39609 0.818939 7.72911 1.13704C12.341 5.52398 10.6496 5.59045 15.2495 4.72161C18.2394 4.15662 18.8575 5.59283 19.3439 5.17502C21.0041 2.56375 25.834 -3.58225 25.9371 3.27354C26.0952 5.09906 25.2495 9.17027 25.5034 10.2124C25.5945 10.5827 26.7876 12.2397 27.1062 12.9186C27.2523 13.2296 27.3458 13.9086 27.3865 13.9442M9.81823 10.9103C8.08608 11.4041 8.71377 14.1863 10.4292 13.918C12.5806 13.5833 11.9864 10.2907 9.81823 10.9103ZM21.0736 11.1786C19.5355 9.93941 17.353 12.2112 19.2337 13.5905C20.8077 14.7465 22.4632 12.2991 21.0736 11.1786Z" fill="#3DD8AC"/>
							<path d="M7.72177 19.0314C8.76873 18.8391 9.34611 19.9311 8.62019 20.3061C7.99729 20.6266 4.85402 21.9061 4.76538 21.6996C4.67673 21.4931 6.25555 23.321 6.54784 23.5512C11.8928 27.9382 21.6269 27.4824 25.4554 21.5548C24.6983 21.3317 22.2953 20.7311 21.8593 20.2492C21.4975 19.8503 21.4808 19.1073 22.0102 18.9578C22.9254 19.0456 26.694 20.4319 27.8488 20.8403C23.0404 30.8367 7.51574 29.9275 2.21387 20.8403C2.21387 20.8403 6.82815 19.1952 7.71938 19.0314H7.72177Z" fill="#3DD8AC"/>
							<path d="M16.5551 16.1234C17.4726 16.705 15.7549 17.467 16.0232 18.4119C16.464 19.9596 18.8622 19.9573 18.3998 20.8403C17.59 22.3929 15.2901 20.0997 15.0649 20.14C14.8636 20.1757 14.3773 20.8807 13.855 21.092C13.1051 21.3911 11.9072 21.5952 12.0246 20.4819C12.1229 19.5608 14.0011 20.2872 14.3461 18.2291C14.4611 17.5478 13.3423 17.0849 13.716 16.0902C14.4036 15.6154 16.2053 15.9003 16.5551 16.1234Z" fill="#3DD8AC"/>
							<path d="M7.46696 16.4538L0.650714 16.8503C0.2703 16.8724 -0.0199805 17.1959 0.0023537 17.5729C0.0246879 17.9498 0.351179 18.2375 0.731593 18.2153L7.54784 17.8188C7.92825 17.7967 8.21853 17.4732 8.1962 17.0962C8.17386 16.7193 7.84737 16.4317 7.46696 16.4538Z" fill="#3DD8AC"/>
							<path d="M22.451 17.818L29.2673 18.2146C29.6477 18.2367 29.9742 17.9491 29.9965 17.5721C30.0188 17.1952 29.7285 16.8717 29.3481 16.8496L22.5319 16.453C22.1515 16.4309 21.825 16.7185 21.8026 17.0955C21.7803 17.4724 22.0706 17.7959 22.451 17.818Z" fill="#3DD8AC"/>
							<path d="M21.3158 15.617L29.2503 13.9788C29.6234 13.9018 29.8628 13.5397 29.785 13.1701C29.7073 12.8004 29.3419 12.5632 28.9688 12.6402L21.0343 14.2784C20.6612 14.3554 20.4218 14.7175 20.4996 15.0871C20.5773 15.4568 20.9427 15.694 21.3158 15.617Z" fill="#3DD8AC"/>
							<path d="M9.32778 14.2774L1.39325 12.6392C1.0202 12.5622 0.65476 12.7994 0.577028 13.1691C0.499296 13.5387 0.738704 13.9008 1.11176 13.9778L9.04628 15.616C9.41934 15.693 9.78478 15.4558 9.86251 15.0861C9.94024 14.7165 9.70083 14.3544 9.32778 14.2774Z" fill="#3DD8AC"/>
						</g>

						<defs>
							<clipPath id="clip0_1439_5721">
								<rect width="30" height="28" fill="white"/>
							</clipPath>
						</defs>
					</svg>

					{{ __('Cats') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col bg-jobboard-cream text-jobboard-deepblue" x-show="deployItem">
					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'portee']) }}" class="font-medium hover:font-bold hover:border-l-3 border-jobboard-coral p-4 ">
						{{ __('Kittens to adopt') }}
					</a>

					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'adulte-retraite']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cats to adopt') }}
					</a>

					<a href="{{ route('company-search.cat-companies') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cat breeders') }}
					</a>

					<a href="{{ route('breed-search.cat-breeds') }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Cats breeds') }}
					</a>

					<a href="{{ route('post-search.cat-posts-with-post-type', ['postType' => 'etalon']) }}" class="font-medium hover:font-bold hover:border-l-2 border-jobboard-coral p-4 ">
						{{ __('Stallions for company') }}
					</a>
				</div>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('professionnal-activity-search.professionnal-activities')" :active="request()->routeIs('professionnal-activity-search.professionnal-activities')" :svgArrows="false">
					{{ __('Products & Services') }}
				</x-front.header.nav-link-mobile>
			</div>

			<div x-data="{deployItem: false}">
				<x-front.header.nav-link-mobile :href="route('article.index')" :active="request()->routeIs('space.responses.my-messages')">
					{{ __('Articles & advices') }}
				</x-front.header.nav-link-mobile>

				<div class="w-full flex flex-col gap-4 bg-jobboard-cream text-jobboard-deepblue p-4 ml-4 mr-4 mb-4" x-show="deployItem" x-data="{deployNavOwner: false, deployNavBreeder: false, deployNavPro: false}">
					<a href="{{ route('article.index', ['arg1' => 'nutrition']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Nutrition') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'sante']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Santé') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'conseils-entretien']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Conseils & entretien') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'education-comportement']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						<span class="whitespace-nowrap">{{ __('Éducation & comportement') }}</span>
					</a>

					<a href="{{ route('article.index', ['arg1' => 'reproduction-genetique']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Reproduction & génétique') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'prevention']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Prevention') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'gestion-elevage']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Gestion d\'entreprise') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'legislation']) }}" class="flex justify-between items-center font-medium hover:border-l-4 hover:pl-2 hover:font-bold border-jobboard-orange text-base w-full">
						{{ __('Legislation') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'produits']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Products') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'marches-entreprises']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Markets & businesses') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'agenda']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Agenda') }}
					</a>

					<a href="{{ route('article.index', ['arg1' => 'inspiration']) }}" class="flex justify-between items-center font-medium hover:pl-2 hover:border-l-4 hover:font-bold border-jobboard-orange">
						{{ __('Inspiration') }}
					</a>
				</div>
			</div>
		@endif

		@if(Auth::guard('web')->check())
			@if(Auth::guard('web')->user()->hasRole(['adopter', 'breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal', 'admin']))
				@php
					$user = Auth::guard('web')->user();
					$notReadNotifications = $user->getNotReadNotifications();
					$isBreederOrPro = ($user && method_exists($user, 'hasRole') && $user->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']));
					$isBreederOrProRoute = (request()->is('professionnels*') || request()->is('eleveurs*'));
					$svgColor = 'currentColor';
					$isBreeder = false;
					$isPro = false;
					if($isBreederOrPro) {
						if($user->hasRole('recruiter')) {
							$svgColor = '#C68CFF';
							$isBreeder = true;
						}
						elseif($user->hasRole('professionnal')) {
							$svgColor = '#FFA244';
							$isPro = true;
						}
						else {
							$svgColor = '#F7F6EF';
						}
					}
				@endphp

				<x-front.header.picto-link :href="route('space.profile.my-notifications')" :activeColor="'text-jobboard-violet'" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'" :class="'relative'">
					<svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.49936 22.988C8.49936 24.6491 9.85022 26 11.5114 26C13.1726 26 14.5235 24.6491 14.5235 22.988M21.7247 21.345L20.3647 19.3644C19.5341 18.1596 19.0869 16.7265 19.0869 15.257V12.1355C19.0869 8.64878 16.732 5.70975 13.5283 4.82439V3.02629C13.5283 1.90361 12.6247 1 11.502 1C10.3793 1 9.47573 1.90361 9.47573 3.02629V4.82439C6.272 5.70975 3.91713 8.64878 3.91713 12.1355V15.257C3.91713 16.7265 3.46988 18.1596 2.63929 19.3644L1.2793 21.345C0.850312 21.9657 1.29756 22.8145 2.05513 22.8145H20.9489C21.7065 22.8145 22.1446 21.9657 21.7247 21.345Z" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-miterlimit="10"/>
					</svg>

					{{ __('Notifications') }}

					@if($notReadNotifications->isNotEmpty())
						<span class="absolute bottom-[33px] left-[50.33%] w-[10px] h-[10px] rounded-full bg-jobboard-coral"></span>
					@endif
				</x-front.header.picto-link>

				<x-front.header.picto-link :href="route('space.responses.my-messages')" :active="request()->routeIs('space.responses.my-messages')" :activeColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-violet' : 'text-jobboard-deepblue'" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'" :class="'relative'">
					<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M23.8587 19.837C25.0543 17.9239 25.75 15.6739 25.75 13.25C25.75 6.34783 20.1521 0.75 13.25 0.75C6.34779 0.75 0.75 6.34783 0.75 13.25C0.75 20.1522 6.34779 25.75 13.25 25.75C15.6739 25.75 17.9239 25.0543 19.8369 23.8587L25.75 25.75L23.8587 19.837Z" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.35938 10.5327H18.142" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.35938 15.9673H14.8811" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					@if(Auth::guard('web')->user()->countUnreadMessages() > 0)
						<span class="absolute bottom-[33px] left-[50.33%] w-[10px] h-[10px] rounded-full bg-jobboard-coral"></span>
					@endif

					{{ __('Messaging') }}
				</x-front.header.picto-link>

				<x-front.header.picto-link :href="route('space.favorites.my-favorites')">
					<svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M27.7156 3.18856C24.7975 0.27048 20.0569 0.27048 17.1291 3.18856L15.4907 4.82695L13.8523 3.18856C10.9342 0.27048 6.19355 0.27048 3.27547 3.18856C0.357394 6.10664 0.357394 10.8473 3.27547 13.7751L15.5004 26L27.7253 13.7751C30.6434 10.857 30.6434 6.11634 27.7253 3.18856H27.7156Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
					</svg>

					{{ __('Favorites') }}
				</x-front.header.picto-link>
			@endif
		@endif
	</div>
</div>
