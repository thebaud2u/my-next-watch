<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@stack('seo')

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
					{{-- Admin is logged as other account --}}
					@if(Auth::guard('web')->check() && Auth::guard('admin')->check())
						@if(Auth::guard('web')->user()->email != Auth::guard('admin')->user()->email)
							<x-front.alert-message :type="'danger'" :color="'danger'">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
								</svg>
								<div>
									<span class="font-medium ml-3">{{ ucfirst(__('warning')) }} !</span>
									{!! __('You\'re connected as :name, remember to logout by clicking :here after you\'re done', ['name' => Auth::guard('web')->user()->name, 'here' => '<a href="'.route('admin.check').'" class="underline font-bold">'.__('here').'</a>']) !!}
								</div>
							</x-front.alert-message>
						@endif

						@role('registered')
							@if(Auth::guard('web')->user()->hasInvitationPending() > 0)
								@foreach(Auth::guard('web')->user()->getPendingInvitation() as $invitation)
									<x-front.alert-message :type="'info'" :color="'info'">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
										</svg>

										<div class="ml-3">
											<span class="font-medium">{{ __('Action needed') }} !</span>
											{!! __('You are invited to collaborate with the “x” company page and manage its ads. You can reply to this invitation directly in the email you received or : do you :accept or :refuse this invitation', ['company' => $invitation->company->name, 'accept' => '<a href="'.route('space.companies.invitation', ['type' => 'member', 'element' => $invitation->id, 'decision' => 'accept']).'" class="underline font-bold text-success-700">'.__('Accept').'</a>', 'refuse' => '<a href="'.route('space.companies.invitation', ['type' => 'member', 'element' => $invitation->id, 'decision' => 'refuse']).'" class="underline font-bold text-danger-700">'.__('Refuse').'</a>']) !!} ?
										</div>
									</x-front.alert-message>
								@endforeach
							@endif
						@endrole
					@endif

					{{-- Flash message --}}
					@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('front.alert-message')
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

	{{-- @include('components.front.analytics') --}}
	@if (app()->environment('production'))
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-FC5ZV43" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	@endif

	{{-- div generation background header --}}
	@if(!empty($headerBackground))
		<div class="d-none bg-[url('/storage/header_background/background-1.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-2.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-3.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-4.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-5.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-6.jpg')]"></div>
		<div class="d-none bg-[url('/storage/header_background/background-7.jpg')]"></div>
		<div class="d-none bg-[url('/storage/hands.png')]"></div>
	@endif
</body>
</html>
