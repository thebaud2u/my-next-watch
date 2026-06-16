@extends('admin.layouts.app')

@section('body')
	<h1 class="text-gray-700 text-3xl font-medium">{{ __('Dashboard') }}</h1>

	<div class="mt-4">
		<div class="flex flex-wrap gap-y-4">
			<div class="px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
				<a href="{{ route('admin.posts.index') }}">
					<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
						<button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
							</svg>
						</button>

						<div class="mx-5">
							<h4 class="text-2xl font-semibold text-gray-700">
								{{ $countPosts }}
							</h4>

							<div class="text-gray-500">
								{{ __('Currently published posts') }}
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
				<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
					<button type="button" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
						</svg>
					</button>

					<div class="mx-5">
						<h4 class="text-2xl font-semibold text-gray-700">
							{{ $countUsers }}
						</h4>

						<div class="text-gray-500">
							{{ __('Users') }}
						</div>
					</div>
				</div>
			</div>

			<div class="px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
				<a href="{{ route('admin.moderations.index') }}">
					<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
						<button type="button" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
							</svg>
						</button>

						<div class="mx-5">
							<h4 class="text-2xl font-semibold text-gray-700">
								{{ $countModerations }}
							</h4>

							<div class="text-gray-500">
								{{ __($countModerations > 1 ? 'Moderations waiting' : 'Moderation waiting') }}
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
				<a href="{{ route('admin.companies.index') }}">
					<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
						<button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
							</svg>
						</button>

						<div class="mx-5">
							<h4 class="text-2xl font-semibold text-gray-700">
								{{ $countCompanies }}
							</h4>

							<div class="text-gray-500">
								{{ __('Currently published companies') }}
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
				<a href="{{ route('admin.subscriptions.index') }}">
					<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
						<button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
							</svg>
						</button>

						<div class="mx-5">
							<h4 class="text-2xl font-semibold text-gray-700">
								{{ $countSubscriptions }}
							</h4>

							<div class="text-gray-500">
								{{ __('Subscriptions') }}
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="mt-8">
		<h1 class="text-gray-700 text-3xl font-medium">
			{{ __('Users') }}
		</h1>

		<div class="container mt-4">
			<livewire:admin.users />
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ asset('js/datepicker.js') }}"></script>
@endpush
