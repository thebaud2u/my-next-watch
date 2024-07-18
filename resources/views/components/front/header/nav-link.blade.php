@props(['active'])

@php
	$classes = 'flex items-center font-semibold pt-1 whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'underline decoration-annonces-blue decoration-2 underline-offset-[14px]'
			: 'hover:text-annonces-blue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
