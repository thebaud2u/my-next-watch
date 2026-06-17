@props(['active', 'textColor' => 'text-mnw-deepblue'])

@php
	$classes = 'flex gap-x-3 items-center whitespace-nowrap text-base hover:underline hover:underline-offset-[5px] cursor-pointer '.$textColor.
		(($active ?? false)
			? ' font-bold'
			: ' hover:font-bold'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
