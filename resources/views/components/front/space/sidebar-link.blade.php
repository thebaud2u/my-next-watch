@props(['active'])

@php
	$classes = 'inline md:block p-2 max-md:ml-2 whitespace-nowrap border-l-4 text-xs lg:text-sm max-md:leading-10 focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'border-annonces-darkblue bg-annonces-lighterdarkblue font-semibold'
			: 'border-transparent hover:font-medium hover:bg-annonces-lighterblue hover:border-annonces-lightblue focus:bg-annonces-lighterdarkblue focus:border-annonces-darkblue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
