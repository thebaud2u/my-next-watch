@props(['active'])

@php
	$classes = 'flex items-center justify-center text-center gap-x-2 h-[68px] text-jobboard-deepblue bg-jobboard-cream p-5 rounded-3xl font-semibold text-sm focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'underline decoration-jobboard-deepblue decoration-2 underline-offset-[14px]'
			: 'hover:text-jobboard-deepblue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
