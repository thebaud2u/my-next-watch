<x-app-layout>
	@push('seo')
		<title>Eleveurs Online : référencement d'éleveurs de chiens et de chats en France</title>
		<meta name="description" content="Eleveurs de chiens et de chats : Tous les services pour acheter votre chiot ou votre chaton de race issu d'un entreprise sur le 1er réseau animalier de France.">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
		<meta property="og:title" content="Eleveurs Online : référencement d'éleveurs de chiens et de chats en France">
		<meta property="og:description" content="Eleveurs de chiens et de chats : Tous les services pour acheter votre chiot ou votre chaton de race issu d'un entreprise sur le 1er réseau animalier de France.">
		<meta property="og:image" content="{{ asset('/storage/eleveurs_online.jpg') }}">
		<meta property="og:url" content="{{ Request::url() }}">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="{{ env('APP_NAME') }}">
		<meta property="og:locale" content="fr_FR">
	@endpush

	<x-slot name="mainTitle">
		@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
			<div class="bg-jobboard-cream flex justify-center w-full" x-data="{}" x-ref="alert">
				@include('components.front.alerts')
			</div>
		@endif
		<div class="h-[440px] lg:h-[500px] max-s:h-[390px] bg white w-full overflow-hidden">
			<div class="h-[400px] max-s:h-[390px] bg-jobboard-cream w-full px-4">
				<div class="flex flex-col lg:flex-row lg:items-stretch h-full max-w-[1200px] mx-auto">
					<div class="flex flex-col items-center lg:items-start lg:gap-y-3 md:mt-6 lg:mt-12 lg:flex-1">
						<h1 class="text-jobboard-deepblue text-[30px] lg:text-[40px] w-[97%] max-s:w-[350px] md:w-[80%] xlsm:w-[700px] font-bold max-lg:text-center">
							{{ __('Adopt dogs and cats with confidence') }}
						</h1>
						<div class="flex flex-col gap-y-2 max-lg:items-center">
							<p class="text-jobboard-deepblue">
								{{ __("I'm looking for") }} :
							</p>

							<div class="flex gap-x-5">
								<a href="{{ route('post-search.dog-posts') }}">
									<x-front.primary-button>
										<svg width="31" height="25" viewBox="0 0 31 25" fill="none"	xmlns="http://www.w3.org/2000/svg">
											<path d="M11.1426 0.310601C10.2318 -0.594043 8.35108 0.739673 7.43613 1.05461C4.95812 1.90641 2.29373 2.14103 0.773032 4.55059C-1.77487 8.5919 2.45257 17.5348 6.51905 14.5122C8.69631 12.8932 6.6546 8.5454 8.32355 6.16754C8.99283 5.21639 10.2318 4.85496 10.8842 3.65018C11.2845 2.91251 11.7801 0.942584 11.1404 0.308487L11.1426 0.310601ZM29.3316 3.50433C27.813 1.98884 25.8666 1.95502 23.9986 1.32304C22.2555 0.735446 18.9621 -1.74599 19.4725 2.24882C19.8156 4.93316 22.7214 5.29037 23.1726 7.43362C23.6321 9.62125 22.2428 14.1825 25.1655 14.954C27.3555 15.531 28.7407 13.9669 29.6599 12.2401C31.081 9.57052 31.6804 5.84415 29.3337 3.50433H29.3316ZM10.7126 7.27087C9.09449 7.60271 9.57526 10.2025 11.0472 10.1391C12.9894 10.0546 12.9513 6.8122 10.7126 7.27087ZM18.6592 9.71637C19.9744 11.0987 22.1602 8.80538 20.7157 7.55832C19.2713 6.31127 17.5197 8.51792 18.6592 9.71637ZM6.74355 15.2668V24.4612C6.74355 24.5965 7.25398 24.9664 7.49119 24.9917C9.36135 25.1947 8.29813 21.8255 8.44004 20.7623C10.6342 22.5801 13.1588 23.2311 15.3509 20.9906C17.6171 23.1085 19.8495 22.6329 22.2046 20.9737V24.2499C22.2046 25.2665 24.1108 25.0911 24.1108 24.4612V15.2668C21.8425 15.1823 22.355 16.5033 21.8255 17.9533C21.1668 19.752 18.7799 21.593 17.0305 19.9042C16.3421 19.2405 16.0393 17.3298 16.2722 16.4737C16.3739 16.0975 18.2419 15.5733 17.9306 13.9479C17.4604 11.4982 12.8009 11.8279 12.9005 14.2988C12.9661 15.9178 14.5567 16.3258 14.5906 16.4653C15.298 19.4117 12.6738 22.0242 10.1259 19.6083C8.40615 17.9765 9.43336 15.0533 6.74355 15.2689V15.2668Z" fill="#FF7E71" />
											<path d="M11.1426 0.310634C11.7823 0.94473 11.2845 2.91466 10.8864 3.65232C10.234 4.85711 8.99291 5.21854 8.32576 6.16969C6.65469 8.54543 8.6964 12.8953 6.52126 14.5144C2.45266 17.5348 -1.77478 8.59194 0.773119 4.55063C2.29381 2.14106 4.9582 1.90644 7.43621 1.05464C8.35117 0.739706 10.2319 -0.596124 11.1426 0.310634Z" fill="#FF7E71" />
											<path d="M29.3316 3.50427C31.6783 5.84409 31.0789 9.57046 29.6577 12.24C28.7385 13.9647 27.3534 15.531 25.1634 14.9539C22.2385 14.1825 23.63 9.62119 23.1704 7.43355C22.7193 5.29031 19.8135 4.9331 19.4704 2.24876C18.9599 -1.74605 22.2534 0.735382 23.9964 1.32298C25.8645 1.95496 27.8109 1.98878 29.3295 3.50427H29.3316Z" fill="#FF7E71" />
											<path d="M6.74356 15.2668C9.43337 15.0533 8.40616 17.9744 10.1259 19.6061C12.6717 22.022 15.2959 19.4095 14.5906 16.4631C14.5567 16.3236 12.9661 15.9157 12.9005 14.2966C12.8009 11.8257 17.4604 11.496 17.9306 13.9457C18.242 15.5711 16.3739 16.0974 16.2723 16.4716C16.0414 17.3276 16.3443 19.2383 17.0305 19.902C18.7799 21.5929 21.1669 19.7498 21.8255 17.9511C22.3571 16.5011 21.8425 15.1801 24.1108 15.2647V24.4591C24.1108 25.0889 22.2047 25.2644 22.2047 24.2477V20.9715C19.8495 22.6307 17.6172 23.1063 15.3509 20.9884C13.1589 23.2289 10.6342 22.5779 8.44004 20.7602C8.29814 21.8233 9.36136 25.1946 7.4912 24.9896C7.25399 24.9642 6.74356 24.5943 6.74356 24.4591V15.2647V15.2668Z" fill="#FF7E71" />
											<path d="M18.6592 9.71633C17.5197 8.51788 19.2437 6.29009 20.7157 7.55828C22.1877 8.82648 19.9744 11.0987 18.6592 9.71633Z" fill="#FF7E71" />
											<path d="M10.7126 7.27081C12.9534 6.81214 12.9894 10.0566 11.0472 10.139C9.57527 10.2024 9.09449 7.60265 10.7126 7.27081Z" fill="#FF7E71" />
										</svg>

										{{ __('a dog') }}
									</x-front.primary-button>
								</a>

								<a href="{{ route('post-search.cat-posts') }}">
									<x-front.primary-button>
										<svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip0_755_7626)">
												<path d="M15.2591 14.3962C14.9539 14.197 13.3136 14.4767 12.7987 14.3665C12.4747 15.2546 13.4444 15.6679 13.3447 16.2762C13.0457 18.1139 11.4179 17.4632 11.3328 18.2877C11.231 19.2796 12.2692 19.0995 12.9191 18.8324C13.3738 18.6459 13.7932 18.0142 13.9676 17.9825C14.1628 17.9464 16.1561 19.9939 16.8579 18.6077C17.2586 17.8193 15.1802 17.8214 14.7982 16.4394C14.5656 15.5959 16.0544 14.9134 15.2591 14.3962Z" fill="#3DD8AC" />
												<path d="M19.1315 13.9447C17.7009 13.9447 16.1623 11.236 15.7014 10.0278C15.3152 9.0168 14.9705 6.61324 14.6341 6.03248C13.0478 4.37712 13.0873 8.49327 12.6512 9.44707C12.1446 11.3038 10.8718 13.4742 8.95948 13.9447L3.44678 12.4526C3.34504 11.3462 4.86285 9.86462 5.07879 9.12914C5.34249 8.23257 4.42474 4.43011 4.49534 3.13507C4.51402 2.78535 4.43305 0.379665 5.53351 0.0447777C6.38896 -0.215926 7.32124 0.731509 7.60986 1.01553C11.6068 4.93244 10.1409 4.99179 14.1275 4.21604C16.7188 3.71159 17.2545 4.99391 17.676 4.62087C19.1149 2.28937 23.3008 -3.19812 23.3901 2.92312C23.5271 4.55304 22.7942 8.18806 23.0143 9.11854C23.0932 9.44919 24.1272 10.9286 24.4033 11.5348C24.53 11.8125 24.611 12.4187 24.6463 12.4505M9.42043 9.74168C7.91923 10.1825 8.46323 12.6667 9.9499 12.4271C11.8145 12.1283 11.2995 9.18848 9.42043 9.74168ZM19.1751 9.98119C17.8421 8.87479 15.9505 10.9032 17.5805 12.1346C18.9446 13.1669 20.3794 10.9816 19.1751 9.98119Z" fill="#3DD8AC" />
												<path d="M7.60363 16.9926C8.51099 16.821 9.01139 17.796 8.38226 18.1308C7.84241 18.417 5.11824 19.5594 5.04142 19.375C4.96459 19.1906 6.3329 20.8227 6.58622 21.0283C11.2185 24.9452 19.6547 24.5382 22.9727 19.2457C22.3166 19.0465 20.234 18.5102 19.8561 18.08C19.5426 17.7239 19.5281 17.0605 19.987 16.9269C20.7801 17.0054 24.0462 18.2432 25.047 18.6077C20.8798 27.5331 7.42506 26.7213 2.83011 18.6077C2.83011 18.6077 6.82915 17.1389 7.60155 16.9926H7.60363Z" fill="#3DD8AC" />
												<path d="M15.2591 14.3962C16.0544 14.9155 14.5656 15.5958 14.7982 16.4394C15.1802 17.8214 17.2586 17.8192 16.8579 18.6077C16.1561 19.9939 14.1628 17.9464 13.9676 17.9825C13.7932 18.0142 13.3717 18.6437 12.9191 18.8324C12.2692 19.0994 11.231 19.2817 11.3328 18.2877C11.4179 17.4653 13.0457 18.1139 13.3447 16.2762C13.4444 15.6679 12.4747 15.2546 12.7987 14.3665C13.3946 13.9426 14.956 14.1969 15.2591 14.3962Z" fill="#3DD8AC" />
												<path d="M7.38291 14.6911L1.4755 15.0452C1.14581 15.0649 0.894231 15.3538 0.913588 15.6903C0.932944 16.0269 1.2159 16.2837 1.5456 16.2639L7.45301 15.9099C7.7827 15.8901 8.03428 15.6013 8.01492 15.2647C7.99556 14.9282 7.7126 14.6714 7.38291 14.6911Z" fill="#3DD8AC" />
												<path d="M20.3693 15.9093L26.2767 16.2633C26.6064 16.2831 26.8893 16.0262 26.9087 15.6897C26.928 15.3531 26.6765 15.0643 26.3468 15.0445L20.4393 14.6905C20.1097 14.6707 19.8267 14.9275 19.8073 15.2641C19.788 15.6006 20.0396 15.8895 20.3693 15.9093Z" fill="#3DD8AC" />
												<path d="M19.3849 13.9439L26.2615 12.4813C26.5848 12.4125 26.7923 12.0892 26.7249 11.7592C26.6575 11.4291 26.3408 11.2173 26.0175 11.2861L19.1409 12.7487C18.8176 12.8175 18.6101 13.1408 18.6775 13.4708C18.7449 13.8009 19.0616 14.0127 19.3849 13.9439Z" fill="#3DD8AC" />
												<path d="M8.99575 12.7479L2.11917 11.2853C1.79585 11.2165 1.47914 11.4283 1.41177 11.7584C1.34441 12.0884 1.55189 12.4117 1.87521 12.4805L8.7518 13.9431C9.07511 14.0119 9.39182 13.8001 9.45919 13.47C9.52656 13.14 9.31907 12.8167 8.99575 12.7479Z" fill="#3DD8AC" />
											</g>

											<defs>
												<clipPath id="clip0_755_7626">
													<rect width="26" height="25" fill="white" transform="translate(0.91156 0.000274658)" />
												</clipPath>
											</defs>
										</svg>

										{{ __('a cat') }}
									</x-front.primary-button>
								</a>
							</div>
						</div>
					</div>

					<div class="relative w-full h-[300px] lg:h-[600px] lg:flex-1">
						<div class="absolute w-full xlsm:w-[calc(180%)] max-lg:h-[300px] lg:h-full right-0 max-s:-top-[30px]">
							<div class="absolute block lg:hidden xlsm:block w-[440px] max-lg:w-[175px] lg:h-[220px] top-[116px] max-lg:left-[50%] max-lg:transform max-lg:translate-x-[-100%] lg:top-[180px] xlsm:left-[100px] xl:left-[142px] xlmd:left-[161px]">
								<img src="{{ asset('/storage/home_coral_e.png') }}" alt="puppy" class="object-cover xl:w-full">
							</div>

							<div class="absolute w-[579px] max-lg:w-[250px] h-[200px] top-0 lg:top-[107px] max-lg:left-[50%] max-lg:transform max-lg:translate-x-[-50%] lg:-left-[35px] xlsm:left-[230px] xl:left-[273px] xlmd:left-[295px]">
								<div class="absolute top-[79px] lg:-top-[29px] z-[45]">
									<img src="{{ asset('/storage/home_chaton.png') }}" alt="kitty" class="object-cover w-[156px] lg:w-full">
								</div>

								<div class="absolute top-[29px] lg:-top-[160px] right-0 lg:-right-[54px] z-40">
									<img src="{{ asset('/storage/home_chiot.png') }}" alt="puppy" class="object-cover w-[231px] lg:w-full">
								</div>

								<div class="relative block lg:hidden top-[50px] left-[160px] w-[206px] z-30">
									<div class="absolute">
										<img src="{{ asset('/storage/home_green_e.png') }}" alt="puppy" class="w-full">
									</div>
								</div>

								<div class="relative hidden xlsm:block top-[50px] lg:-top-[80px] xlsm:left-[370px] xl:left-[380px] xlmd:left-[405px] z-30 h-[205px] w-full max-w-[100%]">
									<div class="absolute max-w-[100%]">
										<img src="{{ asset('/storage/home_green_e.png') }}" alt="puppy" class="xl:w-full w-[579px] max-lg:w-[206px] h-[205px]">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>

	<nav class="breadcrumb-list hidden">
		<ol class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
				<a itemprop="item" href="/">
					<span itemprop="name">Accueil</span>
				</a>
				<meta itemprop="position" content="0">
			</li>
			<li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem" class="current">
					<span itemprop="name">Home</span>
					<meta itemprop="position" content="1">
			</li>
		</ol>
	</nav>

	@if(auth()->check() && auth()->user()->hasRole('applicant'))
		<livewire:front.space.profile.stats 
			:where="'adopter'"
			:key="'dashboard-stats-component'"
			:isHome="true" />
	@endif

	@if(! auth()->check() || ! auth()->user()->hasRole('applicant'))
		<div class="w-full flex justify-center px-4 my-4 md:my-8">
			<nav class="flex flex-row gap-x-4 md:gap-x-12 bg-white overflow-x-scroll scrollbar-none">
				<x-front.home.nav-link :href="route('post-search.dog-posts')" :active="request()->routeIs('post-search.dog-posts*')" :class="' hover:bg-jobboard-coral w-[159px] shrink-0'">
					<svg width="37" height="30" viewBox="0 0 37 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
						<path d="M13.3372 0.372725C12.2471 -0.712824 9.99594 0.8876 8.90077 1.26551C5.93468 2.28765 2.74551 2.56919 0.925293 5.4606C-2.12445 10.3101 2.93564 21.0413 7.80306 17.4143C10.4092 15.4715 7.96531 10.2543 9.96298 7.40089C10.7641 6.25954 12.2471 5.82583 13.0279 4.38012C13.5071 3.49495 14.1003 1.13109 13.3347 0.370189L13.3372 0.372725ZM35.1088 4.20512C33.2911 2.38657 30.9613 2.34599 28.7254 1.58763C26.639 0.882527 22.6969 -2.09512 23.3078 2.69854C23.7185 5.91968 27.1967 6.34831 27.7367 8.92015C28.2868 11.5453 26.6238 17.0186 30.1222 17.9444C32.7435 18.6368 34.4015 16.7599 35.5017 14.6878C37.2028 11.4844 37.9202 7.01283 35.1113 4.20512H35.1088ZM12.8226 8.72486C10.8858 9.12306 11.4612 12.2427 13.2231 12.1667C15.5478 12.0652 15.5022 8.17447 12.8226 8.72486ZM22.3343 11.6594C23.9087 13.3181 26.5249 10.5662 24.7959 9.0698C23.067 7.57336 20.9705 10.2213 22.3343 11.6594ZM8.07179 18.3198V29.3528C8.07179 29.5151 8.68275 29.959 8.96668 29.9894C11.2052 30.2329 9.93256 26.19 10.1024 24.9142C12.7288 27.0955 15.7507 27.8767 18.3745 25.1882C21.0871 27.7296 23.7591 27.1589 26.5781 25.1679V29.0992C26.5781 30.3192 28.8597 30.1086 28.8597 29.3528V18.3198C26.1446 18.2183 26.7581 19.8035 26.1243 21.5435C25.3359 23.7019 22.4788 25.911 20.3848 23.8845C19.5609 23.0881 19.1984 20.7952 19.4773 19.768C19.599 19.3166 21.8349 18.6876 21.4623 16.7371C20.8995 13.7975 15.3222 14.1932 15.4414 17.1581C15.52 19.101 17.4238 19.5905 17.4644 19.7579C18.3111 23.2935 15.1701 26.4284 12.1204 23.5294C10.0619 21.5714 11.2914 18.0636 8.07179 18.3223V18.3198Z" fill="#0E1954" />
						<path d="M13.3373 0.372752C14.1029 1.13365 13.5072 3.49751 13.0306 4.38269C12.2497 5.8284 10.7642 6.26211 9.9656 7.40346C7.96539 10.2543 10.4092 15.4741 7.80568 17.4169C2.93572 21.0413 -2.12437 10.3101 0.925376 5.46063C2.74559 2.56921 5.93476 2.28768 8.90085 1.26554C9.99602 0.887627 12.2472 -0.715333 13.3373 0.372752Z" fill="#0E1954" />
						<path d="M35.1088 4.20505C37.9177 7.01277 37.2003 11.4843 35.4992 14.6877C34.399 16.7573 32.741 18.6368 30.1197 17.9443C26.6187 17.0186 28.2843 11.5452 27.7342 8.92009C27.1942 6.34825 23.716 5.91961 23.3053 2.69847C22.6943 -2.09519 26.6364 0.882463 28.7228 1.58756C30.9588 2.34592 33.2886 2.38651 35.1063 4.20505H35.1088Z" fill="#0E1954" />
						<path d="M8.07179 18.3197C11.2914 18.0636 10.0619 21.5688 12.1204 23.5268C15.1676 26.4258 18.3086 23.2909 17.4644 19.7553C17.4238 19.5879 15.52 19.0984 15.4414 17.1556C15.3222 14.1906 20.8995 13.7949 21.4623 16.7345C21.8349 18.685 19.599 19.3165 19.4773 19.7654C19.201 20.7927 19.5635 23.0855 20.3849 23.8819C22.4789 25.911 25.3359 23.6993 26.1244 21.5409C26.7607 19.801 26.1446 18.2157 28.8597 18.3172V29.3502C28.8597 30.1061 26.5781 30.3166 26.5781 29.0966V25.1653C23.7591 27.1563 21.0871 27.727 18.3745 25.1856C15.7507 27.8741 12.7288 27.0929 10.1024 24.9117C9.93257 26.1874 11.2052 30.2329 8.96669 29.9869C8.68276 29.9564 8.07179 29.5126 8.07179 29.3502V18.3172V18.3197Z" fill="#0E1954" />
						<path d="M22.3344 11.6593C20.9705 10.2212 23.034 7.54794 24.796 9.06973C26.5579 10.5915 23.9087 13.3181 22.3344 11.6593Z" fill="#0E1954" />
						<path d="M12.8226 8.72478C15.5048 8.1744 15.5479 12.0677 13.2232 12.1666C11.4612 12.2427 10.8858 9.12299 12.8226 8.72478Z" fill="#0E1954" />
					</svg>

					{{ __('Adopt a dog') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('company-search.dog-companies')" :active="request()->routeIs('company-search.dog-companies')" :class="' hover:bg-jobboard-coral w-[120px] shrink-0'">
					{{ __('Dog breeders') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('post-search.cat-posts')" :active="request()->routeIs('post-search.cat-posts*')" :class="' hover:bg-jobboard-green w-[151px] shrink-0'">
					<svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
						<g clip-path="url(#clip0_366_9938)">
							<path d="M17.6585 17.2751C17.2829 17.036 15.264 17.3718 14.6302 17.2395C14.2316 18.3052 15.425 18.8012 15.3023 19.5312C14.9344 21.7363 12.9308 20.9555 12.8261 21.9449C12.7008 23.1352 13.9786 22.919 14.7785 22.5986C15.3381 22.3747 15.8543 21.6168 16.069 21.5786C16.3092 21.5354 18.7625 23.9924 19.6263 22.3289C20.1195 21.3828 17.5614 21.3853 17.0912 19.727C16.805 18.7147 18.6373 17.8957 17.6585 17.2751Z" fill="#0E1954" />
							<path d="M22.4245 16.7333C20.6638 16.7333 18.7702 13.4828 18.2028 12.033C17.7275 10.8198 17.3033 7.93554 16.8893 7.23864C14.9369 5.2522 14.9855 10.1916 14.4488 11.3361C13.8253 13.5642 12.2587 16.1687 9.90513 16.7333L3.12027 14.9428C2.99505 13.6151 4.86313 11.8372 5.1289 10.9546C5.45345 9.87874 4.32392 5.31579 4.4108 3.76174C4.4338 3.34207 4.33414 0.455257 5.68855 0.0533915C6.74142 -0.259453 7.88884 0.877469 8.24406 1.21829C13.1634 5.91859 11.3592 5.9898 16.2658 5.0589C19.455 4.45356 20.1144 5.99235 20.6331 5.5447C22.4041 2.74691 27.556 -3.83809 27.6659 3.5074C27.8345 5.46331 26.9324 9.82533 27.2033 10.9419C27.3004 11.3387 28.5731 13.114 28.913 13.8414C29.0688 14.1746 29.1685 14.9021 29.212 14.9402M10.4725 11.6897C8.62483 12.2187 9.29437 15.1996 11.1241 14.9122C13.4189 14.5536 12.7852 11.0258 10.4725 11.6897ZM22.4782 11.9771C20.8376 10.6494 18.5095 13.0835 20.5156 14.5612C22.1945 15.7999 23.9604 13.1776 22.4782 11.9771Z" fill="#0E1954" />
							<path d="M8.23637 20.3908C9.35312 20.1848 9.969 21.3548 9.19468 21.7566C8.53025 22.1 5.17743 23.4709 5.08288 23.2496C4.98832 23.0284 6.6724 24.9868 6.98417 25.2335C12.6855 29.9338 23.0685 29.4455 27.1522 23.0945C26.3447 22.8554 23.7815 22.2119 23.3164 21.6956C22.9305 21.2683 22.9126 20.4722 23.4774 20.312C24.4536 20.4061 28.4734 21.8914 29.7051 22.3289C24.5763 33.0394 8.01659 32.0652 2.36127 22.3289C2.36127 22.3289 7.28316 20.5663 8.23381 20.3908H8.23637Z" fill="#0E1954" />
							<path d="M17.6585 17.2751C18.6373 17.8982 16.805 18.7147 17.0912 19.727C17.5614 21.3853 20.1195 21.3827 19.6263 22.3289C18.7625 23.9923 16.3092 21.5353 16.069 21.5786C15.8543 21.6167 15.3356 22.3721 14.7785 22.5985C13.9786 22.919 12.7008 23.1377 12.8261 21.9448C12.9308 20.958 14.9344 21.7363 15.3023 19.5311C15.425 18.8011 14.2316 18.3052 14.6302 17.2395C15.3637 16.7308 17.2854 17.036 17.6585 17.2751Z" fill="#0E1954" />
							<path d="M7.96473 17.629L0.69407 18.0539C0.288296 18.0776 -0.021337 18.4242 0.00248621 18.8281C0.0263094 19.2319 0.374567 19.5401 0.780341 19.5164L8.051 19.0915C8.45678 19.0678 8.76641 18.7212 8.74259 18.3173C8.71876 17.9135 8.37051 17.6053 7.96473 17.629Z" fill="#0E1954" />
							<path d="M23.9479 19.0908L31.2186 19.5156C31.6244 19.5393 31.9726 19.2311 31.9964 18.8273C32.0203 18.4234 31.7106 18.0768 31.3049 18.0531L24.0342 17.6282C23.6284 17.6045 23.2802 17.9127 23.2563 18.3166C23.2325 18.7204 23.5421 19.067 23.9479 19.0908Z" fill="#0E1954" />
							<path d="M22.7364 16.7324L31.1999 14.9772C31.5978 14.8947 31.8532 14.5067 31.7703 14.1106C31.6874 13.7146 31.2976 13.4604 30.8996 13.543L22.4362 15.2981C22.0382 15.3807 21.7829 15.7686 21.8658 16.1647C21.9487 16.5607 22.3385 16.8149 22.7364 16.7324Z" fill="#0E1954" />
							<path d="M9.94975 15.2972L1.48626 13.542C1.08833 13.4595 0.698532 13.7136 0.615619 14.1097C0.532705 14.5057 0.788073 14.8937 1.186 14.9762L9.64949 16.7314C10.0474 16.8139 10.4372 16.5598 10.5201 16.1637C10.603 15.7677 10.3477 15.3797 9.94975 15.2972Z" fill="#0E1954" />
						</g>

						<defs>
							<clipPath id="clip0_366_9938">
								<rect width="32" height="30" fill="white" />
							</clipPath>
						</defs>
					</svg>

					{{ __('Adopt a cat') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('company-search.cat-companies')" :active="request()->routeIs('company-search.cat-companies')" :class="' hover:bg-jobboard-green w-[115px] shrink-0'">
					{{ __('Cat breeders') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('pages.quisommesnous')" :active="request()->routeIs('pages.quisommesnous')" :class="' hover:bg-jobboard-orange w-[151px] shrink-0'">

					{{ __('Our guarantees') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('professionnal-activity-search.professionnal-activities')" :active="request()->routeIs('professionnal-activity-search.*')" :class="' hover:bg-jobboard-orange w-[120px] shrink-0'">
					{{ __('Products & services') }}
				</x-front.home.nav-link>

				<x-front.home.nav-link :href="route('article.index')" :active="request()->routeIs('article.*')" :class="' hover:bg-jobboard-orange w-[112px] shrink-0'">
					{{ __('Advices') }}
				</x-front.home.nav-link>
			</nav>
		</div>
	@endif

	<hr class="bg-jobboard-greige border-0 @if(auth()->check() && auth()->user()->hasRole('applicant')) mb-6 mt-12 @else my-2 md:my-6 @endif h-px w-full max-w-[1200px]">

	<div class="max-w-[1200px] w-full mb-8 px-4">
		<livewire:front.animals.litter-animals.recently-published
			:forSpecies="'dog'"
			:showCTA="true"
			:key="'puppies-posts'" />

		<livewire:front.animals.litter-animals.recently-published
			:forSpecies="'cat'"
			:showCTA="true"
			:key="'kitties-posts'" />
	</div>

	<div class="flex flex-col items-center w-full bg-jobboard-deepblue py-8 lg:py-16">
		<div class="max-w-[1200px] w-full flex flex-col gap-y-8 px-2 lg:px-0">
			<h2 class="text-jobboard-cream text-center">
				{{ __(('Top breeds')) }}
			</h2>

			<div class="mx-auto w-full">
				<livewire:front.breeds.top-breeds
					:for="'dog'"
					:mode="5"
					:buttonAllBreeds="true"
					:isHome="true"
					:key="'top-dog-breeds-home'" />
			</div>

			<div class="mx-auto w-full">
				<livewire:front.breeds.top-breeds
					:for="'cat'"
					:mode="5"
					:buttonAllBreeds="true"
					:isHome="true"
					:key="'top-cat-breeds-home'" />
			</div>
		</div>
	</div>

	{{-- Our last advices --}}
	<div class="flex justify-center items-stretch w-full py-20">
		<livewire:front.articles.recently-published
			:key="'last-articles'" />
	</div>
	{{-- End Our last advices --}}

	{{-- Adopter garanties --}}
	@include('components.front.home.adopter-garanties')
	{{-- End Adopter garanties --}}

	{{-- Certified breeders --}}
	<div class="flex flex-col items-center px-4 md:px-8 py-8 lg:py-16 w-full bg-jobboard-cream gap-y-12">
		<h3 class="font-semibold text-jobboard-deepblue text-[25px] md:text-[40px] text-center">
			{{ __('These companies have joined us') }}
		</h3>

		<div class="flex flex-col max-lg:gap-y-12 lg:flex-row lg:justify-between max-w-[1200px] w-full">
			<livewire:front.companies.recently-published
				:forSpecies="'dog'"
				:mode="10"
				:key="'dog-companies'" />

			<livewire:front.companies.recently-published
				:forSpecies="'cat'"
				:mode="10"
				:key="'cat-companies'" />
		</div>

		@if(! auth()->check() || ! auth()->user()->hasRole('applicant'))
			{{-- CTA Create post --}}
			@include('components.front.cta-post-thin')
			{{-- End CTA Create post --}}
		@endif
	</div>
	{{-- End Certified breeders --}}

	{{-- Services --}}
	@include('components.front.home.adopter-services', ['displayShape' => true])
	{{-- End Services --}}

	{{-- Produits --}}
	@include('components.front.home.adopter-products', ['displayShape' => true])
	{{-- End Produits --}}
	{{-- <div class="mx-auto max-w-[1200px] w-full my-8 md:my-10 lg:my-20 px-4"> --}}

	@if(! auth()->check() || ! auth()->user()->hasRole('applicant'))
		<div class="mx-auto max-w-[1200px] w-full flex flex-col md:flex-row items-center max-md:gap-y-4 rounded-md bg-jobboard-orange justify-between px-8 lg:px-20 max-lg:py-8 my-20">
			<div class="flex items-center gap-x-4">
				<div class="relative w-[120px] md:h-[122px] max-lg:hidden">
					<div class="absolute w-[212px] h-[161px] -right-[16px] bottom-[4px]">
						<img src="{{ asset('/storage/home_pro_frame_woman.png') }}" alt="">
					</div>
				</div>

				<div class="flex flex-col max-md:items-center text-jobboard-deepblue">
					<h6 class="font-semibold text-[20px] sm:text-[28px] max-md:text-center">
						{{ __('Are you a professional ?') }}
					</h6>

					<p class="text-[20px] sm:text-base max-md:text-center">
						{{ __('List your products and services in our directory!') }}
					</p>
				</div>
			</div>

			<div class="flex justify-center min-w-[225px]">
				<a href="{{ route('home.pro') }}" class="flex justify-center items-center gap-x-1 rounded-full text-jobboard-cream text-sm font-semibold bg-jobboard-deepblue hover:bg-jobboard-deepbluehover py-4 px-6">
					{{ __('I discover the services') }}

					<svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2.36237 1.5L7.81691 6.5L2.36237 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</a>
			</div>
		</div>
	@endif

	{{-- Best advices --}}
	@include('components.front.best-advice')
	{{-- End Best advices --}}

	{{-- NL inscription --}}
	@include('components.front.nl', ['bgcolor' => 'bg-jobboard-coral'])
	{{-- CTA Create post --}}

	@if(! auth()->check() || ! auth()->user()->hasRole('applicant'))
		@include('components.front.cta-post')
	@endif

	@include('components.front.footer-partner-sitemap')
	
	@if (session('gtm'))
		<script>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push(@json(session('gtm')));
		</script>
	@endif
</x-app-layout>
