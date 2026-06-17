<x-space-layout>
	@push('seo')
		<title>{{ __('My space') }}</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, ', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<x-slot name="side_menu">
		@include('components.front.space.profile.side-menu')
	</x-slot>

	<div class="flex-1">
		<div class="w-full">
			<!-- Optins -->
			<div class="flex flex-col gap-y-8 w-full p-6 border border-mnw-greige rounded-md mt-8">
				<livewire:front.space.profile.optins-newsletters />

				<hr>

				<!-- Password -->
				<div class="flex flex-row w-full justify-between">
					<h2 class="mb-1 text-base md:text-[24px] font-bold text-mnw-deepblue">
						{{ __('Password') }}
					</h2>

					<a href="{{ route('space.profile.settings.change-password') }}" class="flex flex-row justify-end cursor-pointer font-bold text-mnw-deepblue text-sm items-center gap-x-1">
						<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>

						{{ __('Update') }}
					</a>
				</div>

				<hr>

				<!-- Delete account -->
				<div class="flex flex-col gap-4 md:flex-row w-full justify-between">
					<div class="text-mnw-deepblue">
						<h2 class="mb-4 text-base md:text-[24px] font-bold text-mnw-deepblue">
							{{ __('Delete my account') }}
						</h2>

						<a href="{{ route('contact') }}" class="font-bold hover:underline hover:underline-offset-4 flex-nowrap">
							{{ __('Contact us') }}
						</a> {{ __('if you need help or information') }}
					</div>

					<div class="flex flex-row justify-end cursor-pointer font-bold text-mnw-deepblue text-sm items-center gap-x-1 max-dc:mb-4" x-data="" x-on:click="$dispatch('open-modal', 'delete_account')">
						<svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14 26.2125C20.9036 26.2125 26.5 20.6161 26.5 13.7125C26.5 6.80896 20.9036 1.21252 14 1.21252C7.09644 1.21252 1.5 6.80896 1.5 13.7125C1.5 20.6161 7.09644 26.2125 14 26.2125Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M9.97729 17.7352L18.0227 9.68979" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M9.97729 9.68979L18.0227 17.7352" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>

						{{ __('Delete my account') }}
					</div>
				</div>
			</div>
		</div>

	</div>

	{{-- @if($user->hasRole('applicant')) --}}
		@include('components.front.space.sticky-nav-bottom-adopter')
	{{-- @endif --}}

	<x-front.modal name="delete_account" :class="'w-full max-w-2xl'" focusable>
		<h2 class="mt-8 mb-1 text-base md:text-[24px] font-bold text-mnw-deepblue">
			{{ __('We\'re sorry to see you go ...') }}
		</h2>

		<form method="POST" action="{{ route('space.profile.settings.delete-account') }}">
			@csrf

			<div class="flex flex-col gap-y-4">
				<p class="text-mnw-deepblue text-sm mt-2">
					{{ __('In order to delete your account, we must make sure it\'s you') }}.
				</p>

				<p class="text-mnw-deepblue text-sm mt-2">
					{{ __('The deletion of your account is final. In case of purchased credits, no refund will be issued.') }}.
				</p>

				<p class="text-mnw-deepblue text-sm mt-2">
					<a href="{{ route('contact') }}">
						{{ __('If you need any help regarding the modification of your personnal information, don\'t hesitate to contact us') }}.
					</a>
				</p>

				{{-- Current password --}}
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="current_password" :value="__('Write your password to delete your account')" :required="true" :class="'pl-4'"/>
					</div>

					<x-front.text-input type="password" name="current_password" id="current_password" required placeholder="{{ __('Current password of your account') }}" :class="'mt-1 block bg-white w-full'" />

					@error('current_password')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-end mt-10">
				<x-front.primary-button>
					{{ __('Delete my account') }}
				</x-front.primary-button>
			</div>
		</form>
	</x-front.modal>
</x-space-layout>
