<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ __('Back-office of :siteName', ['siteName' => env('APP_NAME')]) }}</title>
	<meta name="description" content="{{ __('Back-office of :siteName', ['siteName' => env('APP_NAME')]) }}">
	<meta name="keywords" content="{{ __('back-office') }}" />
	<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>

	<link rel="stylesheet" href="{{ mix('css/flowbite.css') }}">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	@stack('styles')

	<script src="{{ mix('js/app.js') }}"></script>

	@if(app()->environment('production'))
		
	@endif

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter text-vj-heavycyan antialiased">
	<div class="flex h-screen bg-gray-200 font-roboto" x-data="{ open: false }">
		@if(!request()->routeIs('admin.index'))
			@include('admin.partials.sidebar')
		@endif

		<div class="flex-1 flex flex-col overflow-hidden">
			<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
				@if(!request()->routeIs('admin.index'))
					<div class="flex flex-row justify-end items-end relative z-40">
						<button class="m-4 p-2 rounded-md text-jobboard-deepblue  focus:outline-none transition duration-150 ease-in-out" x-on:click="open = !open">
							<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
								<path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
								<path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
				@endif

				<div class="container mx-auto px-6 py-2">
					{{-- Flash message --}}
					@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('components.front.alerts')
						</div>
					@endif

					@yield('body')
				</div>
			</main>
		</div>
	</div>

	{{-- Scripts --}}
	@livewireScripts

	@stack('scripts')

	<script src="{{ mix('js/flowbite.min.js') }}"></script>
</body>
</html>
