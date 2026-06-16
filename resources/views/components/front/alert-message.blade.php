@props([
	'type' => 'info',
	'color' => 'info',
	'autoClose' => true
])

<div x-data="{ show: true }" x-init="() => { if(@js($autoClose)) setTimeout(() => show = false, 5000) }" x-show="show" x-transition class="flex items-center p-4 mb-4 text-sm rounded-lg text-{{ $color }}-700 bg-{{ $color }}-100" role="alert">
	<span class="sr-only">
		{{ ucfirst(__(':type alert', ['type' => __($type)])) }}
	</span>

	{{ $slot }}

	<button type="button" x-on:click="show = false" class="inline-flex h-8 w-8 ml-auto -mx-1.5 -my-1.5 bg-{{ $color }}-100 text-{{ $color }}-500 rounded-lg focus:ring-2 focus:ring-{{ $color }}-400 p-1.5 hover:bg-{{ $color }}-200" aria-label="{{ __('Close') }}" x-on:click="$refs.alert.remove()">
		<span class="sr-only">
			{{ __('Close') }}
		</span>

		<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
		</svg>
	</button>
</div>
