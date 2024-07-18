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
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-FC5ZV43');
		</script>
	@endif

	@if (!empty($scriptSmartad))
		{{ $scriptSmartad }}
	@endif

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter text-vj-heavycyan antialiased">
	<div class="flex h-screen bg-gray-200 font-roboto" x-data="{ open: false }">
		@include('admin.partials.sidebar')

		<div class="flex-1 flex flex-col overflow-hidden">
			<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
				<div class="flex flex-row justify-end items-end relative z-40">
					<button class="m-4 p-2 rounded-md text-annonces-blue hover:text-annonces-darklightblue hover:bg-annonces-lightblue focus:outline-none focus:bg-annonces-lightblue focus:text-annonces-blue transition duration-150 ease-in-out" x-on:click="open = !open">
						<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
							<path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							<path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				<div class="container mx-auto px-6 py-2">
					@yield('body')
				</div>
			</main>
		</div>
	</div>

	{{-- Scripts --}}
	@livewireScripts
	<script>
		window.livewire.onError(status => {
			if (status === 419) {
				confirm("{{ __('This page has expired. Would you like to refresh the page ?') }}") && window.location.reload();
				return false;
			}
		});
	</script>

	@stack('scripts')

	<script src="{{ mix('js/flowbite.min.js') }}"></script>

	{{-- @include('components.front.home.home.analytics') --}}
	@if (app()->environment('production'))
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-FC5ZV43" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	@endif

</body>
</html>
