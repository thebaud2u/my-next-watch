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

	{{-- script GAM --}}
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js" crossorigin="anonymous"></script>
	<script>
		window.googletag = window.googletag || { cmd: [] };
	</script>
	{{-- END script GAM --}}
	<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: 'datalayer_ready',
			statut: @auth 'connecte' @else 'non connecte' @endauth,
			user_data: {
				@auth
					@php
						$user = auth()->user();
						$userType = $user->hasRole('applicant') ? 'adoptant' : ($user->hasRole('professionnal') ? 'pro' : 'eleveur');

						$isBreeder = $user->hasRole(["professionnal_breeder", "individual_breeder"]);
						$hasSub = $user->subscriptions()->where("synchronized_with_stripe", true)->exists();
						$condition = ($isBreeder && $hasSub) ? "client" : "membre";
					@endphp

					user_id: {!! json_encode((string)$user->id) !!},
					firstname: {!! json_encode($user->firstname) !!},
					lastname: {!! json_encode($user->lastname) !!},
					email: {!! json_encode($user->email) !!},
					phone: {!! json_encode($user->phone ?? '') !!},
					postal_code: {!! json_encode($user->address?->department?->code ?? '') !!},
					country: {!! json_encode(mb_strtoupper($user->address?->country?->name ?? 'FRANCE')) !!},
					user_type: {!! json_encode($userType) !!},
					condition: {!! json_encode($condition) !!}
				@else
					user_id: "",
					firstname: "",
					lastname: "",
					email: "",
					phone: "",
					postal_code: "",
					country: 'FRANCE',
					user_type: 'non_identifie',
					condition: 'non_identifie'
				@endauth
			}
		});
	</script>

	<script src="{{ mix('js/app.js') }}"></script>

	<script>
		function pushContactEvent(breedName) {
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				event: 'contact_réalisé',
				race: breedName
			});
		}
	</script>

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

	<body class="font-inter text-jobboard-deepblue antialiased min-w-[280px]" x-init="init()">
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
				<div class="w-full flex justify-center bg-jobboard-cream">
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
