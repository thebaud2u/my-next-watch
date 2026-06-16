<x-app-layout>
	@push('seo')
		<title>{{ env('APP_NAME') }}</title>
		<meta name="description" content="{{ __(':siteName', ['siteName' => env('APP_NAME')]) }}">
		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
	@endpush

	<x-slot name="mainTitle">
		<div class="h-[450px] flex flex-col lg:flex-row lg:items-center lg:justify-center">
			<div class="py-5 px-4 lg:px-6">
				<h1 class="text-xl leading-7 text-gray-800">
					<div class="flex flex-row justify-center items-center font-semibold text-jobboard-deepblue">
						<h1 class="mb-2 lg:mb-4 text-3xl text-center font-bold">
							410
						</h1>
					</div>

					<p class="mb-2 lg:mb-4 text-center text-sm sm:text-base lg:text-xl lg:tracking-tight font-thin max-w-[650px] mx-auto text-jobboard-deepblue">
						{{ __('Oops! The page you are looking for does not exist.') }}
					</p>

					<div class="w-full flex flex-col justify-center items-center lg:pt-8 lg:pb-4">
						<a href="{{ route('home') }}" class="mt-6 inline-block text-blue-500 hover:underline">
							<x-front.primary-button>
								{{ __('Back to homepage') }}
							</x-front.primary-button>
						</a>
					</div>
				</h1>
			</div>
		</div>
	</x-slot>
</x-app-layout>
