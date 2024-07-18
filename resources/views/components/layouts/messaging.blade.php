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

<body class="font-inter text-vj-heavycyan antialiased min-w-[280px]">
	<div class="flex flex-col min-h-screen bg-annonces-lightgray">
		{{-- Navigation --}}
		<header class="z-10">
			@include('components.front.home.header')
		</header>

		@if (!empty($bannersSmartad))
			<div class="w-full max-w-7xl mx-auto flex flex-row justify-center mt-6">
				{{ $bannersSmartad }}
			</div>
		@endif

		<main class="mb-8 mt-[100px]">
			<div class="max-w-screen-xl mx-auto lg:px-6">
				{{-- Image (sub)header --}}
				@if (!empty($navCvtheque))
					<div class="mb-6 px-4 md:pl-6 py-5 shadow-md lg:rounded-md bg-annonces-blue text-xs xs:text-sm font-medium">
						{{ $navCvtheque }}
					</div>
				@endif

				@if (!empty($returnNav))
					<div>
						{{ $returnNav }}
					</div>
				@endif

				@if(Auth::guard('web')->check() && Auth::guard('admin')->check())
					@if (Auth::guard('web')->user()->email != Auth::guard('admin')->user()->email)
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

					@role('registered')
						@if(Auth::guard('web')->user()->hasInvitationPending() > 0)
							@foreach(Auth::guard('web')->user()->getPendingInvitation() as $invitation)
								<x-front.alert-message :type="'info'" :color="'info'">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
									</svg>

									<div class="ml-3">
										<span class="font-medium">
											{{ __('Action needed') }} !
										</span>

										{!! __('You are invited to collaborate with the “x” company page and manage its ads. You can reply to this invitation directly in the email you received or : do you :accept or :refuse this invitation', ['company' => $invitation->company->name, 'accept' => '<a href="'.route('space.companies.invitation', ['type' => 'member', 'element' => $invitation->id, 'decision' => 'accept']).'" class="underline font-bold text-success-700">'.__('Accept').'</a>', 'refuse' => '<a href="'.route('space.companies.invitation', ['type' => 'member', 'element' => $invitation->id, 'decision' => 'refuse']).'" class="underline font-bold text-danger-700">'.__('Refuse').'</a>']) !!} ?
									</div>
								</x-front.alert-message>
							@endforeach
						@endif
					@endrole
				@endif

				{{-- Breadcrumb --}}
				@unless (empty($breadcrumb))
					{{ Breadcrumbs::render($breadcrumb) }}
				@endunless

				{{-- Messaging layout custom --}}
				<div class="flex flex-col lg:items-stretch lg:flex-row max-lg:space-y-4 lg:space-x-4"
					x-data="{ small:true,thread:false,resp:{{ $response?->id ?? 0 }},
						resized:function(){var width=(window.innerWidth>0)?window.innerWidth:screen.width;
						if((!this.small&&width<768)||width>767){this.thread=true}this.small=(width<768)} }"
					x-on:resize.window="resized()" x-init="$nextTick(()=>{resized()})">

					{{-- Left col --}}
					@if (isset($side_menu))
						{{ $side_menu }}
					@endif

					{{-- Page content --}}
					<div class="lg:grow">
						{{ $slot }}
					</div>
				</div>
				{{-- / Messaging layout custom --}}

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
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-FC5ZV43" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	@endif

</body>
</html>
