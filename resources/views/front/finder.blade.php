<x-app-layout>
	@push('seo')
		<title>{{ env('APP_NAME') }}</title>
		<meta name="description" content="{{ __(':site allows you to find the watch that matchs your criterias', ['site' => env('APP_NAME')]) }}">
		<meta name="robots" content="max-snippet:-1">
	@endpush

	{{-- Page main title (home) --}}
	<x-slot name="mainTitle">
		<livewire:front.finder.index :wire:key="'finder'" />
	</x-slot>

	{{-- Recently viewed watches --}}
	@if(Auth::guard('web')->check())
		<div class="w-full bg-mnw-lightblue">
			<livewire:front.watches.recently-viewed
				:mode="'watches'"
				:wire:key="'recently-viewed'" />
		</div>
	@endif
</x-app-layout>
