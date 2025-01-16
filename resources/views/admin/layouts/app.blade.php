<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@stack('seo')

	<link rel="stylesheet" href="{{ mix('css/flowbite.css') }}">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	@stack('styles')

	{{-- <script src="{{ mix('js/tarteaucitron/tarteaucitron.js') }}"></script> --}}
	<script src="{{ mix('js/app.js') }}"></script>

	@if (app()->environment('production'))

	@endif

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter antialiased">
	<div class="flex h-screen bg-gray-200 font-roboto" x-data="{ open: false }">
		@if(Auth::guard('admin')->check())
			@include('admin.partials.sidebar')
		@endif

		<div class="flex-1 flex flex-col overflow-hidden">
			<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
				<div class="max-w-screen-xl mx-auto lg:px-6">
					{{-- Flash message --}}
					@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('front.alert-message')
						</div>
					@endif
				</div>

				@if(Auth::guard('admin')->check())
					<div class="flex flex-row justify-end items-end relative z-40">
						<button class="m-4 p-2 rounded-md text-mnw-blue hover:text-mnw-darklightblue hover:bg-mnw-lightblue focus:outline-none focus:bg-mnw-lightblue focus:text-mnw-blue transition duration-150 ease-in-out" x-on:click="open = !open">
							<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
								<path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
								<path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
				@endif

				<div class="container mx-auto px-6 py-2">
					@yield('body')
				</div>
			</main>
		</div>
	</div>

	{{-- Scripts --}}
	@livewireScripts

	@stack('scripts')

	<script src="{{ mix('js/flowbite.min.js') }}"></script>

	@if (app()->environment('production'))

	@endif
</body>
</html>
