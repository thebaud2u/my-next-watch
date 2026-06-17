<x-app-layout>
	@push('seo')
		<title>{{ env('APP_NAME') }}</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
		<meta property="og:title" content="{{ env('APP_NAME') }}">
		<meta property="og:description" content="">
		<meta property="og:image" content="">
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
							{{ __('What is the principle ?') }}
						</h1>

						<div class="flex flex-col gap-y-2 max-lg:items-center">
							<p class="text-jobboard-deepblue">
								{{ __(':site allows you to find the watch that matchs your criterias.', ['site' => env('APP_NAME')]) }}<br/>
								{{ __('Follow our steps to help you find your next watch !') }}
							</p>

							<div class="flex gap-x-5">
								@php
									$route = route('lets-find-my-next-watch');

									if(Auth::guard('web')->check()) {
										if(Auth::guard('web')->user()->experience) {
											if(Auth::guard('web')->user()->experience->name != 'Beginner') $route = route('search');
										}
									}
								@endphp

								<a href="{{ $route }}">
									<x-front.primary-button :class="'px-4 py-1 mr-2 bg-mnw-blue text-white hover:bg-mnw-blue hover:text-white font-semibold'">
										<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
											<path d="M9 16.5C13.4183 16.5 17 12.9183 17 8.5C17 4.08172 13.4183 0.5 9 0.5C4.58172 0.5 1 4.08172 1 8.5C1 12.9183 4.58172 16.5 9 16.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M5.36353 8.5H12.6363" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M9 4.86377V12.1365" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('Find my next watch !') }}
									</x-front.primary-button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
	
	@if (session('gtm'))
		<script>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push(@json(session('gtm')));
		</script>
	@endif
</x-app-layout>
