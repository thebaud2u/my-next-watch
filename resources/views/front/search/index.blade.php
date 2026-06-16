<x-app-layout>
	@push('seo')
		<title>My Next Watch</title>
		<meta name="description" content="{{ __(':site allows you to find the watch that matchs your criterias', ['site' => env('APP_NAME')]) }}">
		<meta name="robots" content="max-snippet:-1">
	@endpush

	{{-- Page main title (home) --}}
	<x-slot name="mainTitle">
		<livewire:front.search.finder :wire:key="'finder'" />
	</x-slot>

	{{-- Recently viewed watches --}}
	@if(Auth::guard('web')->check())
		<div class="w-full bg-mnw-lightblue">
			<livewire:front.watches.recently-viewed :wire:key="'recently-viewed'" />
		</div>
	@endif
</x-app-layout>
