<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@stack('seo')

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	@stack('styles')

	<script src="{{ mix('js/tarteaucitron/tarteaucitron.js') }}"></script>
	<script src="{{ mix('js/app.js') }}"></script>

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter text-black antialiased min-w-[280px]">
	<div class="flex flex-col min-h-screen">
		{{-- Navigation --}}
		<header class="z-50">
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

		<main class="mb-auto flex flex-col flex-wrap">
			<div class="flex flex-col flex-wrap w-full">
				<div class="max-w-screen-xl mx-auto lg:px-6">
					{{-- Flash message --}}
					@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('components.alert-message')
						</div>
					@endif
				</div>

				{{-- Page main title --}}
				@if(!empty($mainTitle))
					{{ $mainTitle }}
				@endif
			</div>

			{{-- Page Content --}}
			<div class="w-full flex flex-col justify-center items-center">
				{{ $slot }}
			</div>
		</main>

		{{-- Pre-footer --}}
		@stack('prefooter')

		{{-- Footer --}}
		<div class="text-white">
			<footer class="w-full">
				@include('components.front.home.footer')
			</footer>
		</div>
	</div>

	{{-- Scripts --}}
	@livewireScripts

	@stack('scripts')
</body>
</html>
