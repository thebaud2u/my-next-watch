<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@if(!request()->routeIs('users.index') && !request()->routeIs('users.show'))
		<title>{{ __('Your space - :siteName', ['siteName' => env('APP_NAME')]) }}</title>
		<meta name="robots" content="max-snippet:-1">
	@endif

	@stack('seo')

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	@stack('styles')

	<script src="{{ mix('js/tarteaucitron/tarteaucitron.js') }}"></script>
	<script src="{{ mix('js/app.js') }}"></script>

	@if (app()->environment('production'))

	@endif

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter text-vj-heavycyan antialiased min-w-[280px]">
	<div class="flex flex-col min-h-screen bg-annonces-lightgray">
		{{-- Navigation --}}
		<header class="z-10">
			@include('components.front.home.header')
		</header>

		<main class="mb-8 mt-[100px]">
			<div class="max-w-screen-xl mx-auto lg:px-6">
				{{-- Image (sub)header --}}
				@if(!empty($navCvtheque))
					<div class="mb-6 px-4 md:pl-6 py-5 shadow-md lg:rounded-md bg-annonces-blue text-xs xs:text-sm font-medium">
						{{ $navCvtheque }}
					</div>
				@endif

				@if(!empty($returnNav))
					<div>
						{{ $returnNav }}
					</div>
				@endif

				@if(Auth::guard('web')->check() && Auth::guard('admin')->check())
					@if(Auth::guard('web')->user()->email != Auth::guard('admin')->user()->email)
						<x-front.alert-message :type="'danger'" :color="'danger'">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
							</svg>

							<div class="ml-3">
								<span class="font-medium">
									{{ ucfirst(__('warning')) }} !
								</span>

								{!! __('You\'re connected as :name, remember to logout by clicking :here after you\'re done', ['name' => Auth::guard('web')->user()->name, 'here' => '<a href="'.route('admin.check').'" class="underline font-bold">'.__('here').'</a>']) !!}
							</div>
						</x-front.alert-message>
					@endif
				@endif

				<div class="flex flex-col max-md:space-y-4 md:flex-row md:space-x-4">
					{{-- Menu de gauche --}}
					@if(isset($side_menu))
						<div class="hidden s:block flex-none flex-wrap md:flex-col md:w-1/4 md:min-w-fit md:max-w-[280px] shadow-lg md:rounded-r-md lg:rounded-l-md bg-white px-4 py-5 md:space-y-2">
							{{ $side_menu }}
						</div>
					@endif

					{{-- Page Content --}}
					<div class="grow shadow-md md:rounded-l-md lg:rounded-r-md bg-white text-sm lg:text-base">
						{{ $slot }}
					</div>
				</div>
			</div>
		</main>

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

	{{-- @include('components.front.analytics') --}}
	@if (app()->environment('production'))

	@endif
</body>
</html>
