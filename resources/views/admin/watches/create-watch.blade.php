@extends('admin.layouts.app')

@section('body')
	<div class="mt-12">
		<h1 class="text-gray-700 text-3xl font-medium">
			{{ __('Add a watch') }}
		</h1>

		<div class="container mt-4">
			<livewire:admin.watches.create-watch />
		</div>
	</div>
@endsection
