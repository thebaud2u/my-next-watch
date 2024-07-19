<x-app-layout>
	@push('seo')
		<title>{{ __('My space') }}</title>
		<meta name="description" content="{{ __('With its candidate space :siteName allows you to apply for a job of driver, deliveryman, driver, forklift operator, technician, engineer and more', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="{{ __(':siteName, logistics transport professions, transport, logistics, employment transport, logistics job, jobs, offers, announcements, research, employment, work, paycheck, profession, jobs, job-search, CDI, CDD, internship, alternation, learning, recruiting, interim, teacher, road, maritime, rail, fluvial, registered, multi modal, schools, training centre, chauffeur, driver, pilot, deliveryman, road, director, responsible, chief, agent, quay, commissionaire, commercial, controller, engineer, deckhand, officer, freight, storekeeper, cargo handler, mechanic, loader, truck driver, engineer, manager, logistician, preparer', ['siteName' => env('APP_NAME')]) }}" />
		<meta name="robots" content="max-snippet:-1">
	@endpush

	<div class="py-5 px-4 lg:px-6">
		<div class="flex flex-col s:flex-row lg:min-h-[600px]">
			<div class="flex-1">
				<div class="w-full shadow-lg px-6 py-10 mb-6">
					<div class="flex justify-between">
						<div class="flex flex-row items-center">
							@php
								if(!is_null(Auth::guard('web')->user()->getFirstMedia('avatar'))) $avatar = Auth::guard('web')->user()->getFirstMedia('avatar')->getAvailableUrl(['optimized']);
							@endphp

							@if(is_null($avatar))
								<div class="shrink-0 flex justify-center items-center size-12 rounded-full bg-gray-100 text-gray-500 text-xl font-semibold mr-3">
									{{ \Illuminate\Support\Str::acronym(Auth::guard('web')->user()->nickname) }}
								</div>
							@else
								<div class="aspect-square rounded-full shadow-md bg-white flex justify-center items-center">
									<div class="w-2/3 aspect-square flex items-center">
										<img src="{{ $avatar }}" class="object-contain" />
									</div>
								</div>
							@endif

							<div class="text-base xl:text-lg font-semibold truncate">
								<span title="{{ Auth::guard('web')->user()->nickname }}">
									{{ Auth::guard('web')->user()->nickname }}
								</span>
							</div>
						</div>

						<div class="flex flex-col items-end">
							<div class="text-annonces-blue">
								<a href="{{ route('profile', ['user' => Auth::guard('web')->user() ]) }}" target="_blank">
									{{ __('See my profile') }}
								</a>
							</div>

							<div class=" text-annonces-red">
								<form method="post" action="{{ route('logout') }}">
									@csrf

									<a href="#" onclick="event.preventDefault();this.closest('form').submit();" class="hover:text-annonces-red focus:text-annonces-red text-annonces-red">
										{{ __('Log out') }}
									</a>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="flex flex-row w-full gap-6">
					<a href="{{ route('space.account') }}">
						<div class="basis-1/3 shadow-lg p-6">
							<div class="flex flex-row w-full">
								<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="17.5" cy="17.5" r="17" stroke="#262423"/>
									<path d="M17.2227 17.5C19.3973 17.5 21.1602 15.7371 21.1602 13.5625C21.1602 11.3879 19.3973 9.625 17.2227 9.625C15.048 9.625 13.2852 11.3879 13.2852 13.5625C13.2852 15.7371 15.048 17.5 17.2227 17.5Z" fill="#0082FF" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M24.1659 24.6936C24.1659 21.7625 21.1034 19.3918 17.3329 19.3918C13.5625 19.3918 10.5 21.7625 10.5 24.6936" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>

							<div class="flex flex-col w-full">
								<h2 class="text-base font-bold">
									{{ __('Account & profile') }}
								</h2>

								{{ __('Update info') }}
							</div>
						</div>
					</a>

					<a href="{{ route('space.posts.my-posts') }}">
						<div class="basis-1/3 shadow-lg p-6">
							<div class="flex flex-row w-full">
								<svg width="41" height="36" viewBox="0 0 41 36" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M17.6875 32.2434H25.3953V24.5356L17.6875 32.2434Z" fill="#0082FF"/>
									<path d="M34.4913 2.93569L16.2145 21.2387L14.6113 27.18L20.5448 25.5739L38.8216 7.27083C40.0165 6.07305 40.0165 4.13249 38.8216 2.93569C37.6267 1.73791 35.6872 1.73791 34.4913 2.93569Z" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M31.666 5.89233L36.4921 10.7253C37.5946 11.8307 37.5946 13.6215 36.4921 14.7259L31.7817 19.4432" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M14.6083 27.1799L13.0527 28.7384" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M28.5606 21.5285V35.0278H1V1H28.5606V4.88986" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M6.30273 7.64136H20.8034" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M6.30273 14.5947H14.5666" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M6.30273 21.5469H11.0452" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M6.30273 28.5012H9.26898" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
								</svg>
							</div>

							<div class="flex flex-col w-full">
								<h2 class="text-base font-bold">
									{{ __('My posts') }}
								</h2>

								{{ __('Manage my created posts') }}
							</div>
						</div>
					</a>

					<a href="https://boutique.ash.tm.fr/user/{{ request()->session()->get('ssoUserId') }}/factures" target="_blank">
						<div class="basis-1/3 shadow-lg p-6">
							<div class="flex flex-row w-full">
								<svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M28.0966 36.0001C32.4614 36.0001 35.9998 32.4617 35.9998 28.0968C35.9998 23.732 32.4614 20.1936 28.0966 20.1936C23.7318 20.1936 20.1934 23.732 20.1934 28.0968C20.1934 32.4617 23.7318 36.0001 28.0966 36.0001Z" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M7.77344 6.64514V32.6129C7.77344 33.2339 8.2815 33.7419 8.90247 33.7419H19.6565" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M4.38672 1H29.2254C30.1625 1 31.0093 1.37823 31.619 1.99355C32.2343 2.60323 32.6125 3.45 32.6125 4.3871V19.0024" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M7.77419 6.64516V4.3871C7.77419 3.99194 7.70645 3.61371 7.57661 3.25806C7.4129 2.77823 7.13629 2.34355 6.78065 1.99355C6.17097 1.37823 5.32419 1 4.3871 1C2.51855 1 1 2.51855 1 4.3871V8.33871C1 8.95968 1.50806 9.46774 2.12903 9.46774H5.51613" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M11.2422 10.5767H29.7099" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M29.4615 16.2822H11.2422" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M18.2161 21.9879H11.2422" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M17.6363 27.6936H11.2422" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M31.6841 25.153C30.0515 23.5197 27.4043 23.5197 25.7716 25.1524C24.139 26.7851 24.1383 29.4328 25.7716 31.0655C27.4043 32.6988 30.0515 32.6988 31.6841 31.0655" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M23.9023 27.1447H29.6919" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M23.9023 29.0745H29.6919" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M30.112 8.33868V3.74182H10.8379L30.112 8.33868Z" fill="#0082FF"/>
								</svg>
							</div>

							<div class="flex flex-col w-full">
								<h2 class="text-base font-bold">
									{{ __('My invoicing') }}
								</h2>

								{{ __('Manage and view your invoices') }}
							</div>
						</div>
					</a>
				</div>

				<div class="flex flex-row w-full gap-6">
					<a href="{{ route('faq') }}">
						<div class="basis-1/3 shadow-lg p-6">
							<div class="flex flex-row w-full">
								<svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.5 36C28.165 36 36 28.165 36 18.5C36 8.83502 28.165 1 18.5 1C8.83502 1 1 8.83502 1 18.5C1 28.165 8.83502 36 18.5 36Z" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M21.6922 29.819C13.6909 29.819 7.18162 23.3094 7.18162 15.3081C7.18162 12.1201 8.21742 9.17099 9.96687 6.77393C6.34779 9.41523 3.99023 13.6861 3.99023 18.4993C3.99023 26.5005 10.4998 33.0098 18.5008 33.0098C23.314 33.0098 27.5851 30.6523 30.2264 27.0332C27.8294 28.7826 24.8803 29.8184 21.6922 29.8184V29.819Z" fill="#0082FF"/>
									<path d="M18.545 25.6943C18.545 25.8641 18.4091 26 18.2393 26C18.0695 26 17.9336 25.8641 17.9336 25.6943C17.9336 25.5244 18.0695 25.3885 18.2393 25.3885C18.4091 25.3885 18.545 25.5244 18.545 25.6943Z" fill="#262423" stroke="#262423" stroke-miterlimit="10"/>
									<path d="M13.9414 14.2892C13.9414 11.884 15.9148 9.9446 18.3297 10.0012C20.6039 10.053 22.4576 11.9131 22.5142 14.1873C22.5595 16.0022 21.4709 17.5679 19.9116 18.236C18.8975 18.6727 18.2278 19.6594 18.2278 20.7657V21.5761" stroke="#262423" stroke-miterlimit="10" stroke-linecap="round"/>
								</svg>
							</div>

							<div class="flex flex-col w-full">
								<h2 class="text-base font-bold">
									{{ __('Need help') }} ?
								</h2>

								{{ __('Take a look at our FAQ or contact our team') }}
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
