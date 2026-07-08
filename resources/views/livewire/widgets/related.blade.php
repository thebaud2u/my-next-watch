<div>
	@if($results->isNotEmpty())
		@php
			$countResults = count($results);
		@endphp
		<div class="my-10">
			<div class="flex flex-row justify-center items-center font-bold text-xl">
				{{ trans_choice('Other watch from the '.$type, $countResults, ['typeName' => $typeName]) }}
			</div>

			<div x-data="{
				checkResponsive:function() {
					width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
					if(width > 668 && width < 1024) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-watches-from-same-{{ $type }}');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						if(thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');
						}
					}
					if(width < 668) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-watches-from-same-{{ $type }}');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						let secondResponsiveVisibleElement = visibleResponsiveElements[1];
						if(thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');
							secondResponsiveVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');
						}
						if(secondResponsiveVisibleElement) {
							secondResponsiveVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');
						}
					}
				},
				previousElement:function() {
					let visibleElements = document.getElementsByClassName('visible-watches-from-same-{{ $type }}');
					let firstVisibleElement = visibleElements[0];

					let hiddenElements = document.getElementsByClassName('hidden-watches-from-same-{{ $type }}');
					let firstHiddenElement = hiddenElements[0];

					firstVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
					firstVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');

					firstHiddenElement.classList.remove('hidden', 'hidden-watches-from-same-{{ $type }}');
					firstHiddenElement.classList.add('visible-watches-from-same-{{ $type }}');

					document.getElementById('watches-from-same-{{ $type }}').appendChild(firstVisibleElement);
				},
				nextElement:function() {
					let visibleElements = document.getElementsByClassName('visible-watches-from-same-{{ $type }}');
					let lastVisibleElement = visibleElements[visibleElements.length - 1];

					let hiddenElements = document.getElementsByClassName('hidden-watches-from-same-{{ $type }}');
					let lastHiddenElement = hiddenElements[hiddenElements.length - 1];

					lastVisibleElement.classList.remove('visible-watches-from-same-{{ $type }}');
					lastVisibleElement.classList.add('hidden', 'hidden-watches-from-same-{{ $type }}');

					lastHiddenElement.classList.remove('hidden', 'hidden-watches-from-same-{{ $type }}');
					lastHiddenElement.classList.add('visible-watches-from-same-{{ $type }}');

					document.getElementById('watches-from-same-{{ $type }}').prepend(lastHiddenElement);
				}
			}" class="flex flex-row justify-center items-center" x-init="checkResponsive();">
				{{-- Previous button --}}
				@if($countResults > 3)
					<div x-on:click="nextElement();" class="mr-10 cursor-pointer">
						<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.5 1.5L1 9L8.5 16.5" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M1 9H21" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				@else
					<div class="hidden lg:grid-cols-2"></div>
				@endif

				<div id="watches-from-same-{{ $type }}" class="grid grid-cols-1 sm:grid-cols-2 @if($countResults > 3)lg:grid-cols-3 @else lg:grid-cols-{{ $countResults }} @endif gap-6 mt-6 max-w-[810px] justify-items-center items-stretch">
					@foreach($results as $index => $result)
						<div id="{{ $index }}" class="@if($index > 2)hidden hidden-watches-from-same-{{ $type }} @else visible-watches-from-same-{{ $type }} @endif">
							<x-widgets.inline-cards :type="'watch'" :result="$result" :viewedEffect="false" wire:key="watches-from-same-{{ $type }}-{{ $result->id }}" />
						</div>
					@endforeach
				</div>

				{{-- Next button --}}
				@if($countResults > 3)
					<div x-on:click="previousElement();" class="ml-10 cursor-pointer">
						<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.5 16.5L21 9L13.5 1.5" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 9H1" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				@endif
			</div>
		</div>
	@endif
</div>
