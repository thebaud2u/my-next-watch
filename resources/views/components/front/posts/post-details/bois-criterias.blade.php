@if($post->category)
	<div class="flex inline-block gap-2">
		<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M2.8613 4.99959C3.9662 4.99959 4.86213 4.10366 4.86213 2.99876C4.86213 1.89385 3.96414 1 2.8613 1C1.75847 1 0.860474 1.89592 0.860474 3.00083C0.860474 4.10573 1.7564 5.00165 2.8613 5.00165V4.99959Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M2.8613 12.9987C3.9662 12.9987 4.86213 12.1028 4.86213 10.9979C4.86213 9.89299 3.9662 8.99707 2.8613 8.99707C1.7564 8.99707 0.860474 9.89506 0.860474 11C0.860474 12.1049 1.7564 13.0008 2.8613 13.0008V12.9987Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M2.8613 20.9997C3.9662 20.9997 4.86213 20.1038 4.86213 18.9989C4.86213 17.894 3.9662 16.998 2.8613 16.998C1.7564 16.998 0.860474 17.894 0.860474 18.9989C0.860474 20.1038 1.7564 20.9997 2.8613 20.9997Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M7.52722 3.66699H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M7.52722 11.666H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M7.52722 19.665H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		<div class="flex flex-col">
			<div class="flex flex-row">
				{{ __('Category') }} : {{ $post->category->name}}
			</div>
		</div>
	</div>
@endif
