<x-app-layout>
	@push('seo')
		<title>{{ __('Cookies') }}</title>

		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
	@endpush

</x-app-layout>
