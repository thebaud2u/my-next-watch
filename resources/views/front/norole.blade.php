<x-app-layout>
	@push('seo')
		<title>{{ __('What do you want to do on :siteName', ['siteName' => env('APP_NAME')]) }} ?</title>
		<meta name="robots" content="max-snippet:-1">
	@endpush
	{{-- Page main title (home) --}}
	<x-slot name="mainTitle">
		<h1 class="mb-4 text-xl sm:text-2xl lg:text-3xl xl:text-4xl text-center font-bold">
			{{ __('What do you want to do on :siteName', ['siteName' => env('APP_NAME')]) }} ?
		</h1>

		<p class="mb-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight">
			{{ __('The recruitment platform specializing in the taste professions') }}
		</p>
	</x-slot>

	<div class="w-full bg-white pt-8">
		<div class="mb-12 max-w-screen-xl mx-auto flex flex-col items-center">
			@if(! empty(Auth::guard('web')->user()?->id))
				<h3 class="mb-8 text-center leading-10 text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold">
					{{ __('Welcome on :siteName :x', ['siteName' => env('APP_NAME'),'x' => Auth::guard('web')->user()?->first_name ?? '']) }}
				</h3>

				@if(! auth('web')->user()?->hasAnyRole(['applicant', 'registered']))
					<p class="mb-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight">
						{{ __('To complete the creation of your user account, please select your profile') }}:
					</p>
				@endif
			@else
				<p class="my-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight">
					{{ __('In order to create your user account, please first select your profile') }} :
				</p>
			@endif
		</div>
	</div>

	@if(empty(Auth::guard('web')->user()?->id) || ! auth('web')->user()?->hasRole('applicant'))
		<div class="w-full bg-annonces-blue pt-12">
			<div class="mb-12 max-w-screen-xl mx-auto flex flex-col items-center">
				<h2 class="mb-8 text-center leading-10 text-xl sm:text-2xl lg:text-3xl xl:text-4xl text-white font-bold">
					{{ __('I\'m a registered, looking for talent') }}.
				</h2>

				<p class="mb-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight text-white">
					{{ __('Create your registered space on') }} <span class="font-bold">{{ env('APP_NAME') }} JOB</span>, {{ __('post your jobs and recruit motivated applicants') }}.
				</p>

				<div class="mb-4">
					@if(auth('web')->user()?->hasRole('registered'))
						<a href="{{ route('space.dashboard') }}">
							<x-front.quaternary-button :class="'text-center px-8'">
								{{ __('My registered space') }}
							</x-front.quaternary-button>
						</a>
					@elseif(! empty(Auth::guard('web')->user()?->id))
						<a href="{{ route('register.role.registered') }}">
							<x-front.quaternary-button :class="'text-center px-8'">
								{{ __('Create my registered space') }}
							</x-front.quaternary-button>
						</a>
					@else
						<a href="{{ route('login').'?'.http_build_query(['r' => request()->get('r') ?? route('space.dashboard', [], false), 't' => '2']) }}">
							<x-front.quaternary-button :class="'text-center px-8'">
								{{ __('Create my registered space') }}
							</x-front.quaternary-button>
						</a>
					@endif
				</div>
			</div>
		</div>
	@endif
	@if(empty(Auth::guard('web')->user()?->id) || ! auth('web')->user()?->hasRole('registered'))
		<div class="w-full bg-white pt-8">
			<div class="max-w-screen-xl mx-auto mb-12 flex flex-col items-center">
				<h2 class="mb-8 text-center leading-10 text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-bold">
					{{ __('I am a candidate, in active research or simply listening to the market') }}.
				</h2>

				<p class="mb-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight">
					{{ __('Give visibility to your CV by creating or depositing it on') }} <span class="font-bold">{{ env('APP_NAME') }} JOB</span> {{ __('and access unique and targeted opportunities') }}.
				</p>

				<div class="mb-4">
					@if(auth('web')->user()?->hasRole('applicant'))
						<a href="{{ route('space.dashboard') }}">
							<x-front.secondary-button :class="'text-center px-8'">
								{{ __('My applicant space') }}
							</x-front.secondary-button>
						</a>
					@elseif(! empty(Auth::guard('web')->user()?->id))
						<a href="{{ route('register.role.applicant') }}">
							<x-front.secondary-button :class="'text-center px-8'">
								{{ __('Create my applicant space') }}
							</x-front.secondary-button>
						</a>
					@else
						<a href="{{ route('login', ['userType' => 'applicant']).'?'.http_build_query(['r' => request()->get('r') ?? route('space.dashboard', [], false), 't' => '1']) }}">
							<x-front.secondary-button :class="'text-center px-8'">
								{{ __('Create my applicant space') }}
							</x-front.secondary-button>
						</a>
					@endif
				</div>
			</div>
		</div>
	@endif
</x-app-layout>
