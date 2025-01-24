@props([
	'name' => 'modal',
	'show' => false,
	'ref' => null,
	'focusable' => false,
	'title' => null
])

@php
	$show_var = 'show';
@endphp

<div
	x-data="{
		{{ $show_var }}: (window.location.hash.indexOf('{{ $name }}') != -1) ?? @js($show),
		focusables() {
			// All focusable element types...
			let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
			return [...$el.querySelectorAll(selector)]
				// All non-disabled elements...
				.filter(el => ! el.hasAttribute('disabled'))
		},
		firstFocusable() { return this.focusables()[0] },
		lastFocusable() { return this.focusables().slice(-1)[0] },
		nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
		prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
		nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
		prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
	}"
	x-init="$watch('{{ $show_var }}', value => {
		if (value) {
			document.body.classList.add('overflow-y-hidden');
			{{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100);' : '' }}
		} else {
			document.body.classList.remove('overflow-y-hidden');
		}
	})"
	x-on:open-modal.window="if ($event.detail == '{{ $name }}') { {{ $show_var }} = true }"
	x-on:close.stop="{{ $show_var }} = false"
	x-on:keydown.escape.window="{{ $show_var }} = false"
	x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
	x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
	x-show="{{ $show_var }}"
	class="fixed inset-0 overflow-y-auto px-4 py-6 z-50 flex items-center"
	{{ $attributes->merge([
		'class' => 'relative max-h-screen bg-white rounded-lg shadow overflow-x-hidden overflow-y-auto shadow-xl transform transition-all mx-auto w-full max-w-[750px]'
	]) }}
	style="display: {{ $show ? 'block' : 'none' }};"
>
	<div
		x-show="{{ $show_var }}"
		class="fixed inset-0 transform transition-all"
		x-on:click="{{ $show_var }} = false"
		x-transition:enter="ease-out duration-200"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
	>
		<div class="absolute inset-0 bg-gray-600 opacity-75"></div>
	</div>

	<div
		x-show="{{ $show_var }}"
		class="relative max-h-screen bg-white rounded-lg shadow overflow-x-hidden overflow-y-auto shadow-xl transform transition-all mx-auto w-full max-w-[750px]"
		x-transition:enter="ease-out duration-200"
		x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
		x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
		x-transition:leave="ease-in duration-200"
		x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
		x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
		@if(!empty($ref))
			x-ref="{{ $ref }}"
		@endif
	>
		<button type="button" x-on:click="$dispatch('close')"class="absolute top-3 right-2.5 inline-flex items-center justify-center rounded-md p-1.5 ml-auto text-sm text-mnw-blue hover:text-mnw-blue hover:bg-mnw-lightblue focus:outline-none focus:bg-mnw-lightblue focus:text-mnw-blue">
			<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
			</svg>

			<span class="sr-only">
				{{ __('Close') }}
			</span>
		</button>

		<div class="mt-8 p-4 sm:p-6">
			{{ $title }}

			<div class="max-w-screen-xl mx-auto lg:px-6">
				{{-- Flash message --}}
				@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
					<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
						@include('components.alert-message')
					</div>
				@endif
			</div>

			{{ $slot }}
		</div>
	</div>
</div>
