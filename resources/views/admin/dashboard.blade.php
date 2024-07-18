@extends('admin.layouts.app')

@section('body')
	@include('admin.partials.messages')

	<h1 class="text-gray-700 text-3xl font-medium">{{ __('Dashboard') }}</h1>

	<div class="mt-4">
		<div class="flex flex-wrap -mx-6">
			<div class="px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
				<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
					<button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
						</svg>
					</button>

					<div class="mx-5">
						<h4 class="text-2xl font-semibold text-gray-700">{{ $countPosts }}</h4>
						<div class="text-gray-500">{{ __('Posts') }}</div>
					</div>
				</div>
			</div>

			<div class="px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
				<div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
					<button type="button" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
						</svg>
					</button>

					<div class="mx-5">
						<h4 class="text-2xl font-semibold text-gray-700">{{ $countUsers }}</h4>
						<div class="text-gray-500">{{ __('Users') }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="mt-8">
		<h1 class="text-gray-700 text-3xl font-medium">{{ __('Users') }}</h1>

		<div class="container mt-4">
			<livewire:admin.users />
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{!! Theme::asset('js/datepicker.js') !!}"></script>
@endpush
