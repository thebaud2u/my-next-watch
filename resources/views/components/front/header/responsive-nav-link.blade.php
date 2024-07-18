@props(['active'])

@php
	$classes = 'block w-full text-base focus:outline-none transition duration-150 ease-in-out text-left '.
		(($active ?? false)
			? 'text-annonces-blue'
			: 'hover:text-annonces-blue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
