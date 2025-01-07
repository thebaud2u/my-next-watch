@props([
	'link' => true,
	'href' => route('home')
])

@if(!empty($link))
	<a href="{{ $href }}">
@endif
	My Next Watch :)
@if(!empty($link))
	</a>
@endif
