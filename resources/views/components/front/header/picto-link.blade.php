@props(['active'])

@php
	$classes = 'flex flex-col text-mnw-headergray text-sm px-1 pt-1 whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'text-mnw-blue'
			: 'hover:text-mnw-blue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
