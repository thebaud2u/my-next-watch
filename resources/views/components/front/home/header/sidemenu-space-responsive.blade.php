@php
	$user = Auth::guard('web')->user();
	$isBreederOrPro = ($user && method_exists($user, 'hasRole') && $user->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']));
	$isBreederOrProRoute = (request()->is('professionnels*') || request()->is('eleveurs*'));
@endphp
<div class="flex flex-col items-start p-6 gap-y-6 w-full">
	<div class="flex justify-between items-center w-full">
		<x-front.space.sidebar-link :href="route('space.profile.dashboard')" :active="request()->routeIs('space.profile.dashboard')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
			<svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M8.5 26V13.5H16V26M1 9.75L12.25 1L23.5 9.75V23.5C23.5 24.163 23.2366 24.7989 22.7678 25.2678C22.2989 25.7366 21.663 26 21 26H3.5C2.83696 26 2.20107 25.7366 1.73223 25.2678C1.26339 24.7989 1 24.163 1 23.5V9.75Z"
					stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>

			{{ __('Dashboard') }}
		</x-front.space.sidebar-link>

		<button
			class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out @if($isBreederOrPro || $isBreederOrProRoute) text-jobboard-cream @else text-jobboard-deepblue @endif"
			x-on:click="openSpaceNav = !openSpaceNav">
			<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
				<path :class="{ 'hidden': !openSpaceNav, 'inline-flex': openSpaceNav }" class="hidden" stroke-linecap="round"
					stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
	</div>

	@if($user)
		@if($user->hasRole(['professionnal_breeder', 'individual_breeder', 'adopter']))
			<x-front.space.sidebar-link :href="route('space.responses.my-messages')" :active="request()->routeIs('space.responses.my-messages')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M24.1087 20.512C25.3043 18.599 26 16.349 26 13.925C26 7.02287 20.4021 1.42505 13.5 1.42505C6.59779 1.42505 1 7.02287 1 13.925C1 20.8272 6.59779 26.425 13.5 26.425C15.9239 26.425 18.1739 25.7294 20.0869 24.5337L26 26.425L24.1087 20.512Z"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M8.6084 11.2078H18.391" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M8.6084 16.6426H15.1301" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>

				{{ __('Messaging') }}
			</x-front.space.sidebar-link>

			<x-front.space.sidebar-link :href="route('space.appointments.my-appointments')" :active="request()->routeIs('space.responses.my-appointments')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M19.0556 1.42505V6.42505M7.94444 1.42505V6.42505M1 11.425H26M3.77778 3.92505H23.2222C24.7563 3.92505 26 5.04434 26 6.42505V23.925C26 25.3058 24.7563 26.425 23.2222 26.425H3.77778C2.24365 26.425 1 25.3058 1 23.925V6.42505C1 5.04434 2.24365 3.92505 3.77778 3.92505Z"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>

				{{ __('Appointments') }}
			</x-front.space.sidebar-link>

			@if($user && $user->hasRole(['professionnal_breeder', 'individual_breeder', 'breeder']))
				<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">
				
				<x-front.space.sidebar-link :href="route('space.posts.my-posts')" :active="request()->routeIs('space.posts.*')" :textColor="'text-jobboard-cream'">
					<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_2502_18211)">
							<path d="M19.5653 15.6557C19.5653 15.6557 12.6619 14.7228 8.75619 16.983L5.71755 18.7398C4.03915 19.7103 1.8937 19.1342 0.925516 17.4535C-0.0426649 15.7728 0.531198 13.6228 2.20961 12.6523L5.24824 10.8955C9.15505 8.63644 11.8005 2.18076 11.8005 2.18076M7.36187 17.7887L11.0141 21.8387C11.4982 22.3751 12.28 22.4819 12.88 22.1341C12.9698 22.0819 13.0573 22.0194 13.1369 21.9466C13.7528 21.3887 13.8016 20.4364 13.2448 19.8194L10.1221 16.3569M7.45278 17.7353C6.49369 18.2898 4.93119 17.3762 3.96301 15.6955C2.99369 14.0148 2.98574 12.2023 3.94483 11.6478M13.4391 7.91371L14.6119 7.57735C15.0539 7.45007 15.5255 7.64212 15.755 8.04098L16.4766 9.29439C16.7062 9.69212 16.6369 10.1955 16.3073 10.516L15.43 11.3705M19.5709 6.78417L22.305 5.20235M21.5244 10.8717L24.5448 10.691M17.0141 3.04553L18.6812 0.515991M17.853 7.66629C20.067 11.5087 21.0837 15.0719 20.1239 15.6249C19.1641 16.1779 16.5913 13.5113 14.3773 9.66893C12.1634 5.82653 11.1467 2.26334 12.1065 1.71033C13.0663 1.15731 15.6391 3.82389 17.853 7.66629Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</g>
						<defs>
							<clipPath id="clip0_2502_18211">
								<rect width="25" height="22.7272" fill="white" transform="translate(0 0.0614014)"/>
							</clipPath>
						</defs>
					</svg>
					{{ __('My posts') }}
				</x-front.space.sidebar-link>

				<x-front.space.sidebar-link :href="route('space.companies.my-company')" :active="request()->routeIs('space.companies.*')" :textColor="'text-jobboard-cream'">
					<svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.2275 10.5168C13.8664 10.4154 15.2006 11.4138 16.3037 13.1038L16.5303 13.4651C16.7551 13.8418 16.9558 14.2507 17.208 14.6731C17.2924 14.8146 17.381 14.9585 17.4805 15.1018C17.5472 15.1982 17.6177 15.2951 17.6934 15.3918L17.9336 15.679L17.9355 15.6819C19.4678 17.3832 20.6627 18.1648 20.7275 20.2708C20.7308 20.3785 20.7313 20.4897 20.7285 20.6047C20.7274 20.6519 20.7258 20.6998 20.7236 20.7483C20.6483 22.3927 20.0558 23.4864 19.2705 24.0803C18.4912 24.6697 17.4015 24.859 16.126 24.4573H16.124C15.7453 24.3391 15.3605 24.1421 14.8945 23.9084C14.4573 23.6892 13.9421 23.4344 13.4023 23.2991L13.4004 23.2981L13.1777 23.2512C12.0765 23.0534 11.1262 23.4369 10.3516 23.7981C9.57213 24.1615 8.98458 24.4832 8.36035 24.5959L8.08984 24.6311C6.93116 24.7196 6.00911 24.3796 5.37012 23.7375C4.7647 23.1291 4.34318 22.1776 4.28223 20.8655L4.27441 20.5979C4.25764 18.6717 5.13978 17.7465 6.36133 16.4514L6.9043 15.8694L6.90527 15.8684C7.48879 15.2287 7.90579 14.5083 8.2793 13.8635C8.61658 13.2813 8.92007 12.7574 9.29785 12.2893L9.46387 12.093L9.46582 12.0911C10.1828 11.2772 11.1799 10.6319 12.0332 10.5383L12.2275 10.5168ZM2.57812 6.80981C3.21648 6.72064 3.74646 6.95811 4.18848 7.45337C4.64831 7.96875 4.99106 8.75059 5.14746 9.63208C5.20486 9.95572 5.23556 10.2833 5.23926 10.6038C5.24514 11.1515 5.17256 11.6797 5.02344 12.137C4.81637 12.7718 4.48537 13.2118 4.06348 13.4436L3.87695 13.5295C3.40206 13.7121 3.00039 13.7052 2.65918 13.592C2.47462 13.5308 2.29379 13.4325 2.12012 13.3C1.96392 13.1805 1.8134 13.0329 1.67188 12.8567C1.10111 12.1458 0.742684 11.0597 0.75 9.96216L0.756836 9.74243C0.762746 9.62665 0.774718 9.50903 0.791016 9.39087C0.869952 8.82037 1.06684 8.23463 1.3584 7.76099C1.69707 7.21104 2.10404 6.89891 2.5166 6.81763L2.57812 6.80981ZM22.3545 6.80981C22.7782 6.87072 23.2368 7.13324 23.6045 7.67017L23.7559 7.91724L23.7568 7.91821C24.3957 9.07486 24.3915 10.7314 23.8496 12.0061C23.5829 12.6333 23.2104 13.1085 22.79 13.3831C22.5396 13.5466 22.2582 13.6485 21.9395 13.6643C21.7493 13.6734 21.5454 13.6523 21.3271 13.594H21.3281C20.4421 13.3571 19.8721 12.4191 19.7852 11.0237C19.7015 9.68114 20.11 8.28379 20.7568 7.52759L20.8086 7.47095C21.2551 6.98052 21.7397 6.78978 22.1729 6.79517C22.2345 6.79605 22.2952 6.8013 22.3545 6.80981ZM16.4355 1.33521C16.8593 1.3962 17.3169 1.65963 17.6846 2.19653L17.8359 2.4436L17.8369 2.44458C18.4756 3.60107 18.4723 5.25688 17.9307 6.53149C17.6639 7.15897 17.2906 7.63481 16.8701 7.90942C16.4694 8.17109 15.9896 8.27664 15.4033 8.12036H15.4043C14.5206 7.88369 13.9523 6.94611 13.8652 5.55005C13.7811 4.20077 14.1922 2.796 14.8428 2.04224L14.8848 1.99634C15.3956 1.43544 15.9582 1.26659 16.4355 1.33521ZM8.57129 1.1936C9.2095 1.10455 9.73873 1.34198 10.1807 1.83716C10.6406 2.35258 10.9842 3.13423 11.1406 4.01587C11.2964 4.89438 11.2534 5.79954 11.0166 6.52563C10.8095 7.16063 10.4777 7.60056 10.0557 7.83228L9.86914 7.91821C9.39422 8.10071 8.99258 8.09303 8.65137 7.97974C8.30018 7.86312 7.96135 7.61708 7.66211 7.24438C7.09215 6.53446 6.73482 5.44865 6.74219 4.35083L6.74902 4.1311V4.13013C6.78354 3.45546 6.99949 2.7204 7.35156 2.14868C7.66288 1.64323 8.03127 1.33794 8.40918 1.22876L8.57129 1.1936Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
					</svg>
					{{ __('My company') }}
				</x-front.space.sidebar-link>

				<x-front.space.sidebar-link :href="route('space.professionnal-activities.my-professionnal-activities')" :active="request()->routeIs('space.professionnal-activities.*')" :textColor="'text-jobboard-cream'">
					<svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.8902 25.6558L3.63883 21.0428C2.61771 20.5314 2.20924 19.1715 2.7198 18.0074L7.22293 7.75868C7.50884 7.09502 8.06026 6.60543 8.70357 6.44223L15.0754 4.77764C15.9842 4.53829 16.893 4.99524 17.3014 5.88737L20.181 12.165C20.4669 12.796 20.4669 13.5576 20.181 14.2212L15.6779 24.4699C15.1673 25.634 13.9215 26.1671 12.9004 25.6558H12.8902Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M7.36719 18.8995L10.7573 11.1858" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M11.4512 21.0755L14.8413 13.3618" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M15.2563 8.93375C15.0214 9.47773 14.4088 9.71708 13.8982 9.45597C13.3876 9.20574 13.163 8.55296 13.408 8.00897C13.6429 7.46499 14.2556 7.22563 14.7661 7.48675C15.2767 7.73698 15.5013 8.38976 15.2563 8.93375Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M19.781 6.09409C21.9049 4.14663 23.0179 1.92717 22.2623 1.13295C21.5067 0.338735 19.1784 1.27439 17.0443 3.22185C14.9204 5.16932 13.8073 7.38878 14.563 8.18299" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					@if(Auth::guard('web')->user()->hasRole('recruiter'))
						{{ __('My side hustle') }}
					@endif
				</x-front.space.sidebar-link>
			@endif

			@if($user && $user->hasRole('applicant'))
				<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">

				<x-front.space.sidebar-link :href="route('space.animals.my-animals')" :active="request()->routeIs('space.animals.*')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
					<svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12.2275 10.5168C13.8664 10.4154 15.2006 11.4138 16.3037 13.1038L16.5303 13.4651C16.7551 13.8418 16.9558 14.2507 17.208 14.6731C17.2924 14.8146 17.381 14.9585 17.4805 15.1018C17.5472 15.1982 17.6177 15.2951 17.6934 15.3918L17.9336 15.679L17.9355 15.6819C19.4678 17.3832 20.6627 18.1648 20.7275 20.2708C20.7308 20.3785 20.7313 20.4897 20.7285 20.6047C20.7274 20.6519 20.7258 20.6998 20.7236 20.7483C20.6483 22.3927 20.0558 23.4864 19.2705 24.0803C18.4912 24.6697 17.4015 24.859 16.126 24.4573H16.124C15.7453 24.3391 15.3605 24.1421 14.8945 23.9084C14.4573 23.6892 13.9421 23.4344 13.4023 23.2991L13.4004 23.2981L13.1777 23.2512C12.0765 23.0534 11.1262 23.4369 10.3516 23.7981C9.57213 24.1615 8.98458 24.4832 8.36035 24.5959L8.08984 24.6311C6.93116 24.7196 6.00911 24.3796 5.37012 23.7375C4.7647 23.1291 4.34318 22.1776 4.28223 20.8655L4.27441 20.5979C4.25764 18.6717 5.13978 17.7465 6.36133 16.4514L6.9043 15.8694L6.90527 15.8684C7.48879 15.2287 7.90579 14.5083 8.2793 13.8635C8.61658 13.2813 8.92007 12.7574 9.29785 12.2893L9.46387 12.093L9.46582 12.0911C10.1828 11.2772 11.1799 10.6319 12.0332 10.5383L12.2275 10.5168ZM2.57812 6.80981C3.21648 6.72064 3.74646 6.95811 4.18848 7.45337C4.64831 7.96875 4.99106 8.75059 5.14746 9.63208C5.20486 9.95572 5.23556 10.2833 5.23926 10.6038C5.24514 11.1515 5.17256 11.6797 5.02344 12.137C4.81637 12.7718 4.48537 13.2118 4.06348 13.4436L3.87695 13.5295C3.40206 13.7121 3.00039 13.7052 2.65918 13.592C2.47462 13.5308 2.29379 13.4325 2.12012 13.3C1.96392 13.1805 1.8134 13.0329 1.67188 12.8567C1.10111 12.1458 0.742684 11.0597 0.75 9.96216L0.756836 9.74243C0.762746 9.62665 0.774718 9.50903 0.791016 9.39087C0.869952 8.82037 1.06684 8.23463 1.3584 7.76099C1.69707 7.21104 2.10404 6.89891 2.5166 6.81763L2.57812 6.80981ZM22.3545 6.80981C22.7782 6.87072 23.2368 7.13324 23.6045 7.67017L23.7559 7.91724L23.7568 7.91821C24.3957 9.07486 24.3915 10.7314 23.8496 12.0061C23.5829 12.6333 23.2104 13.1085 22.79 13.3831C22.5396 13.5466 22.2582 13.6485 21.9395 13.6643C21.7493 13.6734 21.5454 13.6523 21.3271 13.594H21.3281C20.4421 13.3571 19.8721 12.4191 19.7852 11.0237C19.7015 9.68114 20.11 8.28379 20.7568 7.52759L20.8086 7.47095C21.2551 6.98052 21.7397 6.78978 22.1729 6.79517C22.2345 6.79605 22.2952 6.8013 22.3545 6.80981ZM16.4355 1.33521C16.8593 1.3962 17.3169 1.65963 17.6846 2.19653L17.8359 2.4436L17.8369 2.44458C18.4756 3.60107 18.4723 5.25688 17.9307 6.53149C17.6639 7.15897 17.2906 7.63481 16.8701 7.90942C16.4694 8.17109 15.9896 8.27664 15.4033 8.12036H15.4043C14.5206 7.88369 13.9523 6.94611 13.8652 5.55005C13.7811 4.20077 14.1922 2.796 14.8428 2.04224L14.8848 1.99634C15.3956 1.43544 15.9582 1.26659 16.4355 1.33521ZM8.57129 1.1936C9.2095 1.10455 9.73873 1.34198 10.1807 1.83716C10.6406 2.35258 10.9842 3.13423 11.1406 4.01587C11.2964 4.89438 11.2534 5.79954 11.0166 6.52563C10.8095 7.16063 10.4777 7.60056 10.0557 7.83228L9.86914 7.91821C9.39422 8.10071 8.99258 8.09303 8.65137 7.97974C8.30018 7.86312 7.96135 7.61708 7.66211 7.24438C7.09215 6.53446 6.73482 5.44865 6.74219 4.35083L6.74902 4.1311V4.13013C6.78354 3.45546 6.99949 2.7204 7.35156 2.14868C7.66288 1.64323 8.03127 1.33794 8.40918 1.22876L8.57129 1.1936Z"
							stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
					</svg>

					{{ __('My animals') }}
				</x-front.space.sidebar-link>
			@endif

			<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">
			
			<x-front.space.sidebar-link :href="route('space.favorites.my-favorites')" :active="request()->routeIs('space.favorites.my-favorites')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M13.5 26.425C20.4035 26.425 26 20.8286 26 13.9251C26 7.02149 20.4035 1.42505 13.5 1.42505C6.59643 1.42505 1 7.02149 1 13.9251C1 20.8286 6.59643 26.425 13.5 26.425Z"
						stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
					<path
						d="M19.8548 9.67776C18.3346 8.15754 15.8745 8.15754 14.3542 9.67776L13.5033 10.5287L12.6524 9.67776C11.1322 8.15754 8.6721 8.15754 7.15188 9.67776C5.63166 11.198 5.63166 13.6581 7.15188 15.1783L13.5069 21.5334L19.8619 15.1783C21.3821 13.6581 21.3821 11.198 19.8619 9.67776H19.8548Z"
						stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
				</svg>

				{{ __('Favorites') }}
			</x-front.space.sidebar-link>

			<x-front.space.sidebar-link :href="route('space.alerts.my-alerts')" :active="request()->routeIs('space.alerts.*')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.13901 22.738C8.13901 24.3991 9.48987 25.75 11.1511 25.75C12.8123 25.75 14.1631 24.3991 14.1631 22.738M21.3644 21.095L20.0044 19.1144C19.1738 17.9096 18.7265 16.4765 18.7265 15.007V11.8855C18.7265 8.39878 16.3717 5.45975 13.1679 4.57439V2.77629C13.1679 1.65361 12.2643 0.75 11.1417 0.75C10.019 0.75 9.11537 1.65361 9.11537 2.77629V4.57439C5.91165 5.45975 3.55677 8.39878 3.55677 11.8855V15.007C3.55677 16.4765 3.10953 17.9096 2.27894 19.1144L0.918949 21.095C0.489961 21.7157 0.937204 22.5645 1.69478 22.5645H20.5885C21.3461 22.5645 21.7842 21.7157 21.3644 21.095Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
				</svg>

				{{ __('Alerts') }}
			</x-front.space.sidebar-link>

			<x-front.space.sidebar-link :href="route('space.benefits.my-benefits')" :active="request()->routeIs('space.benefits.*')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M7.35077 12.675L12.4314 1.42505C13.442 1.42505 14.4112 1.82013 15.1258 2.52339C15.8404 3.22665 16.2419 4.18047 16.2419 5.17502V10.175H23.4309C23.7992 10.1709 24.1639 10.2456 24.4999 10.394C24.8358 10.5424 25.135 10.7609 25.3766 11.0344C25.6183 11.3079 25.7966 11.6298 25.8993 11.9778C26.0019 12.3258 26.0265 12.6917 25.9712 13.05L24.2184 24.2999C24.1266 24.896 23.8189 25.4394 23.3521 25.8299C22.8852 26.2204 22.2907 26.4317 21.6781 26.4249H7.35077M7.35077 12.675V26.4249M7.35077 12.675H3.54031C2.86658 12.675 2.22044 12.9384 1.74404 13.4072C1.26764 13.876 1 14.5119 1 15.175V23.9249C1 24.5879 1.26764 25.2238 1.74404 25.6927C2.22044 26.1615 2.86658 26.4249 3.54031 26.4249H7.35077"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>

				{{ __('My benefits') }}
			</x-front.space.sidebar-link>
		@elseif($user->hasRole('professionnal'))
			<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">
			
			<x-front.space.sidebar-link :href="route('space.benefits.my-benefits')" :active="request()->routeIs('space.benefits.*')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M7.35077 12.675L12.4314 1.42505C13.442 1.42505 14.4112 1.82013 15.1258 2.52339C15.8404 3.22665 16.2419 4.18047 16.2419 5.17502V10.175H23.4309C23.7992 10.1709 24.1639 10.2456 24.4999 10.394C24.8358 10.5424 25.135 10.7609 25.3766 11.0344C25.6183 11.3079 25.7966 11.6298 25.8993 11.9778C26.0019 12.3258 26.0265 12.6917 25.9712 13.05L24.2184 24.2999C24.1266 24.896 23.8189 25.4394 23.3521 25.8299C22.8852 26.2204 22.2907 26.4317 21.6781 26.4249H7.35077M7.35077 12.675V26.4249M7.35077 12.675H3.54031C2.86658 12.675 2.22044 12.9384 1.74404 13.4072C1.26764 13.876 1 14.5119 1 15.175V23.9249C1 24.5879 1.26764 25.2238 1.74404 25.6927C2.22044 26.1615 2.86658 26.4249 3.54031 26.4249H7.35077"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>

				{{ __('My benefits') }}
			</x-front.space.sidebar-link>
			
			<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">
			
			<x-front.space.sidebar-link :href="route('space.responses.my-messages')" :active="request()->routeIs('space.responses.my-messages')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M24.1087 20.512C25.3043 18.599 26 16.349 26 13.925C26 7.02287 20.4021 1.42505 13.5 1.42505C6.59779 1.42505 1 7.02287 1 13.925C1 20.8272 6.59779 26.425 13.5 26.425C15.9239 26.425 18.1739 25.7294 20.0869 24.5337L26 26.425L24.1087 20.512Z"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M8.6084 11.2078H18.391" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M8.6084 16.6426H15.1301" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>

				{{ __('Messaging') }}
			</x-front.space.sidebar-link>
			
			<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">
			
			<x-front.space.sidebar-link :href="route('space.professionnal-activities.my-professionnal-activities')" :active="request()->routeIs('space.professionnal-activities.*')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg width="25" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.8902 25.6558L3.63883 21.0428C2.61771 20.5314 2.20924 19.1715 2.7198 18.0074L7.22293 7.75868C7.50884 7.09502 8.06026 6.60543 8.70357 6.44223L15.0754 4.77764C15.9842 4.53829 16.893 4.99524 17.3014 5.88737L20.181 12.165C20.4669 12.796 20.4669 13.5576 20.181 14.2212L15.6779 24.4699C15.1673 25.634 13.9215 26.1671 12.9004 25.6558H12.8902Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M7.36719 18.8995L10.7573 11.1858" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M11.4512 21.0755L14.8413 13.3618" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M15.2563 8.93375C15.0214 9.47773 14.4088 9.71708 13.8982 9.45597C13.3876 9.20574 13.163 8.55296 13.408 8.00897C13.6429 7.46499 14.2556 7.22563 14.7661 7.48675C15.2767 7.73698 15.5013 8.38976 15.2563 8.93375Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M19.781 6.09409C21.9049 4.14663 23.0179 1.92717 22.2623 1.13295C21.5067 0.338735 19.1784 1.27439 17.0443 3.22185C14.9204 5.16932 13.8073 7.38878 14.563 8.18299" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>

				{{ __('My products & services') }}
			</x-front.space.sidebar-link>
		@endif
	@endif

	<hr class="w-full border-t max-md:hidden md:block @if($isBreederOrPro || $isBreederOrProRoute) border-jobboard-cream @else border-jobboard-greige @endif">

	<x-front.space.sidebar-link :href="route('space.profile.my-profile')" :active="request()->routeIs('space.profile.my-profile')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
		<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path
			d="M13.5001 15.8481C16.1553 15.8481 18.3078 13.6956 18.3078 11.0404C18.3078 8.38515 16.1553 6.23267 13.5001 6.23267C10.8449 6.23267 8.69238 8.38515 8.69238 11.0404C8.69238 13.6956 10.8449 15.8481 13.5001 15.8481Z"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			<path
			d="M5.28809 23.3482C6.14624 21.9395 7.35234 20.7753 8.79041 19.9676C10.2285 19.1597 11.8502 18.7354 13.4996 18.7354C15.1491 18.7354 16.7708 19.1597 18.2088 19.9676C19.647 20.7753 20.8529 21.9395 21.7112 23.3482"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			<path
			d="M13.5 26.425C20.4037 26.425 26 20.8287 26 13.925C26 7.02149 20.4037 1.42505 13.5 1.42505C6.59644 1.42505 1 7.02149 1 13.925C1 20.8287 6.59644 26.425 13.5 26.425Z"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
		
		@if($user && $user->hasRole('applicant'))
			{{ __('My profile') }}
		@else
			{{ __('My account') }}
		@endif
	</x-front.space.sidebar-link>

	<x-front.space.sidebar-link :href="route('space.profile.my-orders')" :active="request()->routeIs('space.profile.my-orders')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
		<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M19.2692 6.76923V22.1538C19.2692 23.1739 18.864 24.1522 18.1427 24.8735C17.4214 25.5948 16.4431 26 15.4231 26H1C2.02006 26 2.99835 25.5948 3.71964 24.8735C4.44094 24.1522 4.84615 23.1739 4.84615 22.1538V4.84615C4.84615 3.82609 5.25137 2.84781 5.97267 2.12651C6.69396 1.40522 7.67224 1 8.69231 1H22.6346" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M22.6347 1C23.5272 1 24.3832 1.35457 25.0144 1.9857C25.6455 2.61683 26.0001 3.47283 26.0001 4.36538V5.80769C26.0001 6.06271 25.8988 6.30728 25.7184 6.4876C25.5381 6.66793 25.2935 6.76923 25.0385 6.76923H19.2693V4.36538C19.2693 3.47283 19.6239 2.61683 20.255 1.9857C20.8861 1.35457 21.7421 1 22.6347 1V1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M11.5769 7.73047H14.4615" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M9.65381 13.5H14.4615" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M9.65381 19.2695H14.4615" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		{{ __('Orders and invoices') }}
	</x-front.space.sidebar-link>

	<x-front.space.sidebar-link :href="route('space.profile.settings')" :active="request()->routeIs('space.profile.settings')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
		<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M9.79269 4.79019L10.6933 2.65557C10.8452 2.29416 11.1125 1.98329 11.46 1.76367C11.8076 1.54406 12.2193 1.42595 12.6412 1.4248H14.3588C14.7807 1.42595 15.1924 1.54406 15.54 1.76367C15.8875 1.98329 16.1548 2.29416 16.3067 2.65557L17.2073 4.79019L20.2653 6.40557L22.7369 6.05942C23.1484 6.00813 23.5673 6.07033 23.9402 6.23812C24.3132 6.4059 24.6234 6.6717 24.8314 7.00173L25.6692 8.34788C25.8839 8.68317 25.9828 9.07034 25.9529 9.45831C25.923 9.84627 25.7656 10.2168 25.5016 10.521L23.9726 12.3094V15.5402L25.5435 17.3287C25.8075 17.6328 25.9649 18.0033 25.9948 18.3913C26.0247 18.7793 25.9258 19.1664 25.7111 19.5017L24.8733 20.8479C24.6652 21.1779 24.355 21.4437 23.9821 21.6115C23.6091 21.7793 23.1903 21.8415 22.7788 21.7902L20.3072 21.444L17.2492 23.0594L16.3486 25.194C16.1967 25.5554 15.9294 25.8663 15.5819 26.0859C15.2343 26.3055 14.8226 26.4237 14.4006 26.4248H12.6412C12.2193 26.4237 11.8076 26.3055 11.46 26.0859C11.1125 25.8663 10.8452 25.5554 10.6933 25.194L9.79269 23.0594L6.73468 21.444L4.26314 21.7902C3.8516 21.8415 3.43275 21.7793 3.0598 21.6115C2.68685 21.4437 2.37665 21.1779 2.16861 20.8479L1.3308 19.5017C1.11612 19.1664 1.01721 18.7793 1.04712 18.3913C1.07704 18.0033 1.23437 17.6328 1.49837 17.3287L3.02737 15.5402V12.3094L1.45648 10.521C1.19248 10.2168 1.03515 9.84627 1.00523 9.45831C0.975315 9.07034 1.07423 8.68317 1.28891 8.34788L2.12672 7.00173C2.33476 6.6717 2.64496 6.4059 3.01791 6.23812C3.39085 6.07033 3.80971 6.00813 4.22125 6.05942L6.69279 6.40557L9.79269 4.79019ZM9.31095 13.9248C9.31095 14.6855 9.55663 15.4291 10.0169 16.0616C10.4772 16.6941 11.1315 17.1871 11.8969 17.4782C12.6624 17.7693 13.5046 17.8455 14.3172 17.6971C15.1298 17.5487 15.8763 17.1823 16.4621 16.6444C17.048 16.1066 17.4469 15.4212 17.6086 14.6752C17.7702 13.9291 17.6872 13.1557 17.3702 12.4529C17.0531 11.7502 16.5162 11.1495 15.8273 10.7268C15.1384 10.3042 14.3285 10.0787 13.5 10.0787C12.389 10.0787 11.3235 10.4839 10.5379 11.2052C9.75229 11.9265 9.31095 12.9047 9.31095 13.9248V13.9248Z"
				stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
		</svg>

		{{ __('Settings') }}
	</x-front.space.sidebar-link>

	<form method="post" action="{{ route('logout') }}" class="flex gap-x-3 items-center @if($isBreederOrPro || $isBreederOrProRoute) text-jobboard-cream @else text-jobboard-deepblue @endif">
		@csrf
		<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M13.5 26.4248C20.4036 26.4248 26 20.8284 26 13.9248C26 7.02125 20.4036 1.4248 13.5 1.4248C6.59644 1.4248 1 7.02125 1 13.9248C1 20.8284 6.59644 26.4248 13.5 26.4248Z"
				stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			<path d="M9.47754 17.9473L17.5229 9.90186" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
			<path d="M9.47754 9.90186L17.5229 17.9473" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
		</svg>

		<button type="submit" class="">
			{{ __('Log out') }}
		</button>
	</form>
</div>
