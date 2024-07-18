<div>
	@if($posts->isNotEmpty())
		<div class="my-10">
			@php
				$countPosts = count($posts);
			@endphp

			<div class="mt-4 flex flex-row justify-center items-center font-bold text-xl">
				{{ trans_choice('Last-published-post', $countPosts) }}
			</div>

			<div x-data="{
				checkResponsive:function() {
					width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
					if (width > 668 && width < 1024) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-recently-published-post');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						if (thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-recently-published-post');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-published-post');
						}
					}
					if (width < 668) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-recently-published-post');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						let secondResponsiveVisibleElement = visibleResponsiveElements[1];
						if (thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-recently-published-post');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-published-post');
							secondResponsiveVisibleElement.classList.remove('visible-recently-published-post');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-published-post');
						}
						if (secondResponsiveVisibleElement) {
							secondResponsiveVisibleElement.classList.remove('visible-recently-published-post');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-published-post');
						}
					}
				},
				previousElement:function() {
					let visibleElements = document.getElementsByClassName('visible-recently-published-post');
					let firstVisibleElement = visibleElements[0];

					let hiddenElements = document.getElementsByClassName('hidden-recently-published-post');
					let firstHiddenElement = hiddenElements[0];

					firstVisibleElement.classList.remove('visible-recently-published-post');
					firstVisibleElement.classList.add('hidden', 'hidden-recently-published-post');

					firstHiddenElement.classList.remove('hidden', 'hidden-recently-published-post');
					firstHiddenElement.classList.add('visible-recently-published-post');

					document.getElementById('recently-published-cards').appendChild(firstVisibleElement);
				},
				nextElement:function() {
					let visibleElements = document.getElementsByClassName('visible-recently-published-post');
					let lastVisibleElement = visibleElements[visibleElements.length - 1];

					let hiddenElements = document.getElementsByClassName('hidden-recently-published-post');
					let lastHiddenElement = hiddenElements[hiddenElements.length - 1];

					lastVisibleElement.classList.remove('visible-recently-published-post');
					lastVisibleElement.classList.add('hidden', 'hidden-recently-published-post');

					lastHiddenElement.classList.remove('hidden', 'hidden-recently-published-post');
					lastHiddenElement.classList.add('visible-recently-published-post');

					document.getElementById('recently-published-cards').prepend(lastHiddenElement);
				}
			}" class="flex flex-row justify-center items-center" x-init="checkResponsive();">
				{{-- Previous button --}}
				@if($countPosts > 3)
					<div x-on:click="nextElement();" class="mr-10 cursor-pointer">
						<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.5 1.5L1 9L8.5 16.5" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M1 9H21" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				@endif

				<div id="recently-published-cards" class="grid grid-cols-1 @if($countPosts > 3)lg:grid-cols-3 @else lg:grid-cols-{{ $countPosts }} @endif sm:grid-cols-2 gap-6 mt-6 max-w-[810px] justify-items-center items-stretch">
					@foreach($posts as $index => $post)
						<div id="{{ $index }}" class="@if($index > 2)hidden hidden-recently-published-post @else visible-recently-published-post @endif">
							<x-front.posts.post-card :post="$post" :viewedEffect="false" wire:key="recently-published-post-{{ $post->id }}" :widthMobile="'w-[266px]'" :maxWidthMobile="'max-w-[266px]'"/>
						</div>
					@endforeach
				</div>

				{{-- Next button --}}
				@if($countPosts > 3)
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
