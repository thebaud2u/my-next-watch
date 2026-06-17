@props([
	'name' => 'modal',
	'show' => false,
	'ref' => null,
	'focusable' => false,
	'show_var' => 'show',
	'noClose' => false,
])

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
		if(value) {
			document.body.classList.add('overflow-y-hidden');
			{{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100);' : '' }}
		} else {
			document.body.classList.remove('overflow-y-hidden');
		}
	})"
	x-on:open-modal.window="if($event.detail == '{{ $name }}') { {{ $show_var }} = true }"
	x-on:close.stop="{{ $show_var }} = false"
	x-on:keydown.escape.window="{{ $show_var }} = false"
	x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
	x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
	x-show="{{ $show_var }}"
	class="fixed inset-0 overflow-y-auto px-4 py-6 z-50 flex items-center"
	style="display: {{ $show ? 'block' : 'none' }};"
>
	<div
		x-show="{{ $show_var }}"
		class="fixed inset-0 transform transition-all"
		@if(!$noClose)
			x-on:click="{{ $show_var }} = false"
		@endif
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
		{{ $attributes->merge([
			'class' => 'relative max-h-screen bg-white rounded-lg shadow overflow-x-hidden overflow-y-auto shadow-xl transform transition-all mx-auto'
		]) }}
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
		@if(!$noClose)
			<button type="button" x-on:click="$dispatch('close');"class="absolute top-3 right-2.5 inline-flex items-center justify-center rounded-md p-1.5 ml-auto text-sm text-mnw-deepblue hover:text-mnw-deepblue focus:outline-none focus:text-mnw-deepblue">
				<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.4773 17.5227L17.5227 9.47726M9.4773 9.47726L17.5227 17.5227M26 13.5C26 20.4036 20.4036 26 13.5 26C6.59644 26 1 20.4036 1 13.5C1 6.59644 6.59644 1 13.5 1C20.4036 1 26 6.59644 26 13.5Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>

				<span class="sr-only">
					{{ __('Close') }}
				</span>
			</button>
		@endif

		<div class="p-4 sm:p-6">
			{{ $slot }}
		</div>
	</div>
</div>
