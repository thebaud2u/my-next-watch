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

	<div x-data="{}" class="flex-1 text-mnw-deepblue max-w-[1080px] py-10 max-lg:px-6 md:pr-6 xlmd:pr-0">
		<div class="w-full bg-white mb-6 flex flex-row s:justify-between s:items-center max-s:flex-col">
			<div class="flex flex-col sm:flex-row gap-x-2 sm:items-center">
				<svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_787_14912" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="30">
						<path d="M31 0H0V30H31V0Z" fill="white" />
					</mask>

					<g mask="url(#mask0_787_14912)">
						<path d="M4.18593 7.62203C4.99524 7.0748 6.21549 7.17935 6.9425 7.76039L6.10909 6.58792C5.43816 5.66199 5.67875 4.66063 6.63587 4.0104C7.59352 3.36277 10.3066 5.10382 10.3066 5.10382C9.62988 4.16905 9.7562 2.98408 10.7222 2.32812C11.6883 1.67477 13.0212 1.90054 13.6984 2.83739L22.671 15.1038L21.5273 25.8331L11.9834 22.4649L3.65916 10.521C2.97618 9.58 3.21205 8.28265 4.18542 7.62254L4.18593 7.62203Z" fill="#F7F6EF" />
						<path d="M2.32016 14.4465C2.32016 14.4465 1.34521 13.0717 2.76727 12.1291C4.18722 11.1865 5.16112 12.5608 5.16112 12.5608L9.68306 18.9425C9.83874 18.6907 10.0096 18.4426 10.1999 18.1976L3.92409 9.34193C3.92409 9.34193 2.9502 7.96762 4.3712 7.02504C5.79116 6.08247 6.76506 7.45681 6.76506 7.45681L12.6682 15.7875C12.8878 15.6143 13.1127 15.44 13.3443 15.2694L6.50088 5.61016C6.50088 5.61016 5.52699 4.23584 6.94799 3.29378C8.36795 2.35121 9.34183 3.72551 9.34183 3.72551L16.1853 13.3833C16.4369 13.234 16.6859 13.1049 16.9354 12.9681L10.539 3.94141C10.539 3.94141 9.56513 2.56707 10.9851 1.62449C12.405 0.681921 13.3789 2.05625 13.3789 2.05625L20.1422 11.6011L21.1706 13.0529C16.9097 15.8812 16.504 21.2021 18.9387 24.6379C19.4252 25.3256 20.1359 24.8548 20.1359 24.8548C17.2142 20.7308 18.1064 16.0965 22.3678 13.2688L21.1114 7.1837C21.1114 7.1837 20.6423 5.58051 22.2981 5.12535C23.955 4.67123 24.4251 6.27442 24.4251 6.27442L25.876 10.4442C26.451 12.0973 27.0632 13.7453 27.8736 15.3032C30.1616 19.7029 28.7951 25.1716 24.4807 28.0358C19.7748 31.1584 13.3412 29.9974 10.1139 25.4442L2.32172 14.4465H2.32016Z" fill="#FFA244" />
						<path d="M10.3332 26.7016C6.8889 26.7016 3.40795 23.3334 3.40795 20.0001C3.40795 19.5392 3.05938 19.1667 2.58292 19.1667C2.10645 19.1667 1.68555 19.5392 1.68555 20.0001C1.68555 25.0001 5.16599 28.3683 10.3327 28.3683C10.8086 28.3683 11.1939 27.961 11.1939 27.5001C11.1939 27.0392 10.8096 26.7016 10.3332 26.7016Z" fill="#0E1954" />
						<path d="M6.02787 28.3329C3.44479 28.3329 1.7224 26.6662 1.7224 24.1662C1.7224 23.7054 1.33766 23.3329 0.861201 23.3329C0.384738 23.3329 0 23.7054 0 24.1662C0 27.4996 2.58307 29.9996 6.02787 29.9996C6.50381 29.9996 6.88907 29.6271 6.88907 29.1662C6.88907 28.7054 6.50433 28.3329 6.02787 28.3329ZM20.6667 1.66626C20.1913 1.66626 19.8055 2.03975 19.8055 2.49959C19.8055 2.95943 20.1913 3.33292 20.6667 3.33292C24.1109 3.33292 27.5557 6.32396 27.5557 9.99957C27.5557 10.4594 27.9415 10.8329 28.4169 10.8329C28.8923 10.8329 29.2781 10.4594 29.2781 9.99957C29.2781 5.40479 25.8339 1.66626 20.6672 1.66626H20.6667Z" fill="#0E1954" />
						<path d="M24.9725 0.0349121C24.4971 0.0349121 24.1113 0.373017 24.1113 0.833379C24.1113 1.29374 24.4971 1.70157 24.9725 1.70157C27.5556 1.70157 29.2418 3.5555 29.2418 5.83338C29.2418 6.29322 29.6627 6.66674 30.1392 6.66674C30.6157 6.66674 30.9642 6.29322 30.9642 5.83338C30.9642 2.63581 28.4173 0.0349121 24.9725 0.0349121Z" fill="#0E1954" />
					</g>
				</svg>

				<h2 class="text-[25px] sm:text-[40px] font-bold break-words !mb-0">
					{{ __('Hello :name', ['name' => $user->firstname]) }}
				</h2>
			</div>

			<div class="flex">
				<div class="flex flex-col items-center">
					{{-- Displays percentage bar if the profile isn't fully completed --}}
					@if($profileCompletionPercentage < 100)
						{{-- picto --}}

						<div class="flex max-md:flex-col gap-2 items-center">
							<div class="flex items-center justify-center p-4">
								<div class="relative w-24 h-24">
									<!-- Cercle de progression -->
									<div class="absolute inset-0 rounded-full bg-gray-200"
										style="background: conic-gradient(#FFA244 {{ $profileCompletionPercentage * 3.6 }}deg, #E5E7EB {{ $profileCompletionPercentage * 3.6 }}deg);">
										<!-- Cercle intérieur pour masquer le centre -->
										<div class="absolute inset-2 bg-white rounded-full"></div>
									</div>
									<!-- Texte du pourcentage -->
									<div class="absolute inset-0 flex items-center justify-center">
										<span class="text-lg font-bold text-gray-700">
											{{ is_numeric($profileCompletionPercentage) ? number_format($profileCompletionPercentage, 0) . '%' : 'N/A' }}
										</span>
									</div>
								</div>
							</div>

							<div class="flex flex-col font-medium">
								@if($user->hasRole('recruiter'))
									{{ __('Company profile completed at :percentage', ['percentage' => $profileCompletionPercentage]) }}%
								@elseif($user->hasRole('applicant'))
									{{ __('Profile completed at :percentage', ['percentage' => $profileCompletionPercentage]) }}%
								@endif

								<a href="{{ route('space.profile.complete-my-profile') }}">
									<button class="font-bold">
										{{ __('Complete') }}
									</button>
								</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>

		<livewire:front.space.profile.stats :key="'dashboard-stats-component'" />
	</div>
</x-space-layout>
