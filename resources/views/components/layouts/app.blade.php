<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@stack('seo')

	<link rel="stylesheet" href="{{ mix('css/flowbite.css') }}">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

	@stack('styles')

	

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

	<body class="font-inter text-mnw-deepblue antialiased min-w-[280px]" x-init="init()">
		@php
			$errors = $errors ?? session('errors') ?? new \Illuminate\Support\ViewErrorBag();
		@endphp
		<div class="flex flex-col min-h-screen">
			{{-- Navigation --}}
			<header class="z-50 max-s:sticky max-s:top-0">
				@include('components.front.home.header')
			</header>

		{{-- Image (sub)header --}}
		@if(!empty($imgHeader))
			<div class="w-full max-w-screen-xl mx-auto">
				{{ $imgHeader }}
			</div>
		@endif

		{{-- Image (sub)header --}}
		@if(!empty($imgHeaderCompany))
			<div class="w-full flex flex-col justify-center bg-white">
				{{ $imgHeaderCompany }}
			</div>
		@endif

		<main class="mb-auto flex flex-col">
			<div class="flex flex-col w-full">
				{{-- Gestion des erreurs à tester pour chaque situation --}}
				<div class="w-full flex justify-center bg-mnw-cream">
					<div class="max-w-[1100px] mx-auto lg:px-6">
						{{-- Admin is logged as other account --}}
						@if(Auth::guard('web')->check() && Auth::guard('admin')->check() && Auth::guard('web')->user()->email != Auth::guard('admin')->user()->email)
							<x-front.alert-message :type="'danger'" :color="'danger'" :autoClose="false">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
								</svg>

								<div>
									<span class="font-medium ml-3">{{ ucfirst(__('warning')) }} !</span>
									{!! __('You\'re connected as :name, remember to logout by clicking :here after you\'re done', ['name' => Auth::guard('web')->user()->name, 'here' => '<a href="'.route('admin.sign-out-as-user').'" class="underline font-bold">'.__('here').'</a>']) !!}
								</div>
							</x-front.alert-message>
						@endif
					</div>
				</div>

				{{-- Page main title --}}
				@if(!empty($mainTitle))
					{{ $mainTitle }}
				@endif

				{{-- Page main title --}}
				@if(!empty($headerAd))
					{{ $headerAd }}
				@endif
			</div>

			{{-- Page Content --}}
			{{-- <x-breadcrumbs :items="$breadcrumbs" /> --}}

			<div class="w-full flex flex-col justify-center items-center">
				{{ $slot }}
			</div>
		</main>

		{{-- Pre-footer --}}
		@stack('prefooter')

		{{-- Footer --}}
		<footer class="w-full">
			{{-- Footer home --}}
				@if(!empty($footerHome))
					{{$footerHome}}
				@endif
			{{-- END Footer home --}}
			@include('components.front.home.footer')
		</footer>
	</div>

	{{-- Scripts --}}
	@livewireScripts

	@stack('scripts')

	@include('components.front.analytics')
</body>
</html>
