@if($post->postType->slug != 'appel-offre' && $post->postType->slug != 'tractionnaire')
	<div class="inline-flex items-center mr-4">
		<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
			<path d="M10.9969 21C16.5198 21 20.9969 16.5228 20.9969 11C20.9969 5.47715 16.5198 1 10.9969 1C5.4741 1 0.996948 5.47715 0.996948 11C0.996948 16.5228 5.4741 21 10.9969 21Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M15.4738 7.32233C13.4434 5.29113 10.1514 5.29113 8.121 7.32153C6.0906 9.35193 6.0898 12.6447 8.121 14.6751C10.1514 16.7063 13.4434 16.7063 15.4738 14.6751" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M5.797 9.80078H12.997" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M5.797 12.1992H12.997" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		{{ $post->values_web['price'] }}€
	</div>
@endif

<div class="inline-flex items-center mr-4">
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
		<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
		<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
	</svg>

	{{ $location }}
</div>

<div class="inline-flex items-center mr-4">
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
		<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
	</svg>

	{{ ucfirst($post->published_at->diffForHumans()) }}
</div>

@if($post->postType->slug == 'appel-offre')
	@if(!is_null($post->values_web['closing_date']))
		<div class="inline-flex items-center mr-4">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
			</svg>

			{{ \Carbon\Carbon::parse($post->values_web['closing_date'])->format('d/m/Y') }}
		</div>
	@endif
@endif
