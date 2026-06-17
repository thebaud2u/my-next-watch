<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@if(!request()->routeIs('users.index') && !request()->routeIs('users.show'))
		<title>{{ __('Your space') }} {{ __(':siteName', ['siteName' => env('APP_NAME')]) }}</title>
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endif

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

	{{-- <script src="{{ mix('js/tarteaucitron/tarteaucitron.js') }}"></script> --}}
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

	@if(app()->environment('production'))
	@endif

	@livewireStyles

	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/vnd.microsoft.icon" />
</head>

<body class="font-inter text-vj-heavycyan antialiased min-w-[280px] min-h-screen">
	<div class="flex flex-col min-h-screen">
		{{-- Navigation --}}
		<header class="z-10 max-s:sticky max-s:top-0">
			@include('components.front.home.header')
		</header>

		<main>
			<div class="w-full mx-auto">
				{{-- Image (sub)header --}}
				@if(!empty($navCvtheque))
					<div class="mb-6 px-4 md:pl-6 py-5 shadow-md lg:rounded-md bg-mnw-deepblue text-xs xs:text-sm font-medium">
						{{ $navCvtheque }}
					</div>
				@endif

				@if(!empty($returnNav))
					<div>
						{{ $returnNav }}
					</div>
				@endif

				@if(Auth::guard('web')->check() && Auth::guard('admin')->check() && Auth::guard('web')->user()->email != Auth::guard('admin')->user()->email)
					<div class="flex flex-row justify-center items-center">
						<x-front.alert-message :type="'danger'" :color="'danger'" :autoClose="false">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
							</svg>

							<div class="ml-3">
								<span class="font-medium">
									{{ ucfirst(__('warning')) }} !
								</span>

								{!! __('You\'re connected as :name, remember to logout by clicking :here after you\'re done', [
									'name' => Auth::guard('web')->user()->name,
									'here' => '<a href="' . route('admin.sign-out-as-user') . '" class="underline font-bold">' . __('here') . '</a>',
								]) !!}
							</div>
						</x-front.alert-message>
					</div>
				@endif

				{{-- Flash message --}}
				@if((isset($errors) && $errors->any()) || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
					<div class="flex flex-row justify-center items-center">
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('components.front.alerts')
						</div>
					</div>
				@endif


				@if(isset($side_menu))
					<div class="flex flex-col max-md:space-y-4 md:flex-row items-start justify-center w-full max-w-[1440px] mx-auto">
						{{-- Menu de gauche --}}
						<div
							class="hidden xlsm:block flex-none flex-wrap md:flex-col md:w-1/4 md:min-w-fit md:max-w-[339px] bg-white py-5 md:space-y-2">
							{{ $side_menu }}
						</div>

						{{-- Page Content --}}
						<div class="w-full max-w-[1110px]">
							{{ $slot }}
						</div>
					</div>
				@else
					{{-- Page Content --}}
					<div class="w-full">
						{{ $slot }}
					</div>
				@endif

			</div>

		</main>
		@if(Auth::guard('web')->user()->hasRole('recruiter') && !request()->is('espace/breeder-gpt'))
			{{-- <div class="sticky bottom-0 flex justify-end">
				<a href="{{ route('space.profile.breeder-gpt') }}" class="flex flex-col items-center mr-8 mb-8">
					<div class="relative w-[78px]">
						<img src="{{ asset('storage/breeder_avatar_bot.png') }}" class="max-w-[78px] absolute z-30 -top-[55px]" alt="">
					</div>
					<div class="rounded-xl shadow-lg text-mnw-deepblue font-bold text-sm p-2 z-20 flex flex-col items-center">
						<p>{{ __('Une question ?') }}</p>
						{{ __('BreederGPT') }}
					</div>
				</a>
			</div> --}}
			<div class="fixed bottom-8 right-8 z-10">
				<a href="{{ route('space.profile.breeder-gpt') }}" class="flex flex-col items-center">
					<div class="relative w-[78px] h-[78px]">
						<img src="{{ asset('storage/breeder_avatar_bot.png') }}" class="max-w-[78px] absolute top-[17px] z-10" alt="">
					</div>
					<div class="rounded-xl shadow-lg text-mnw-deepblue font-bold text-sm p-2 bg-white flex flex-col items-center">
						<p>{{ __('Une question ?') }}</p>
						{{ __('BreederGPT') }}
					</div>
				</a>
			</div>
		@endif

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

	@include('components.front.analytics')
</body>

</html>
