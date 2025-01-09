<div>
	@if($posts->isNotEmpty())
		<div class="my-10">
			@php
				$countPosts = count($posts);
			@endphp

			<div class="mt-4 flex flex-row justify-center items-center font-bold text-xl">
				{{ trans_choice('Last-viewed-post', $countPosts) }}
			</div>

			<div x-data="{
				checkResponsive:function() {
					width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
					if (width > 668 && width < 1024) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-recently-viewed-post');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						if (thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-recently-viewed-post');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');
						}
					}
					if (width < 668) {
						let visibleResponsiveElements = document.getElementsByClassName('visible-recently-viewed-post');
						let thirdResponsiveVisibleElement = visibleResponsiveElements[2];
						let secondResponsiveVisibleElement = visibleResponsiveElements[1];
						if (thirdResponsiveVisibleElement) {
							thirdResponsiveVisibleElement.classList.remove('visible-recently-viewed-post');
							thirdResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');
							secondResponsiveVisibleElement.classList.remove('visible-recently-viewed-post');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');
						}
						if (secondResponsiveVisibleElement) {
							secondResponsiveVisibleElement.classList.remove('visible-recently-viewed-post');
							secondResponsiveVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');
						}
					}
				},
				previousElement:function() {
					let visibleElements = document.getElementsByClassName('visible-recently-viewed-post');
					let firstVisibleElement = visibleElements[0];

					let hiddenElements = document.getElementsByClassName('hidden-recently-viewed-post');
					let firstHiddenElement = hiddenElements[0];

					firstVisibleElement.classList.remove('visible-recently-viewed-post');
					firstVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');

					firstHiddenElement.classList.remove('hidden', 'hidden-recently-viewed-post');
					firstHiddenElement.classList.add('visible-recently-viewed-post');

					document.getElementById('recently-viewed-cards').appendChild(firstVisibleElement);
				},
				nextElement:function() {
					let visibleElements = document.getElementsByClassName('visible-recently-viewed-post');
					let lastVisibleElement = visibleElements[visibleElements.length - 1];

					let hiddenElements = document.getElementsByClassName('hidden-recently-viewed-post');
					let lastHiddenElement = hiddenElements[hiddenElements.length - 1];

					lastVisibleElement.classList.remove('visible-recently-viewed-post');
					lastVisibleElement.classList.add('hidden', 'hidden-recently-viewed-post');

					lastHiddenElement.classList.remove('hidden', 'hidden-recently-viewed-post');
					lastHiddenElement.classList.add('visible-recently-viewed-post');

					document.getElementById('recently-viewed-cards').prepend(lastHiddenElement);
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

				<div id="recently-viewed-cards" class="lg:grid @if($countPosts > 3)lg:grid-cols-3 @else lg:grid-cols-{{ $countPosts }} @endif gap-6 mt-6 max-w-[810px] justify-items-center items-stretch">
					@foreach($posts as $index => $post)
						<div id="{{ $index }}" class="@if($index > 2)hidden hidden-recently-viewed-post @else visible-recently-viewed-post @endif">
							<x-front.posts.post-card :post="$post" :viewedEffect="false" wire:key="recently-viewed-post-{{ $post->id }}" :widthMobile="'w-[266px]'" :maxWidthMobile="'max-w-[266px]'" />
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
