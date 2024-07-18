@props(['active'])

@php
	$classes = 'flex flex-col text-annonces-headergray text-sm px-1 pt-1 whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'text-annonces-blue'
			: 'hover:text-annonces-blue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
