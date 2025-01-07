@props(['active'])

@php
	$classes = 'inline md:block p-2 max-md:ml-2 whitespace-nowrap border-l-4 text-xs lg:text-sm max-md:leading-10 focus:outline-none transition duration-150 ease-in-out cursor-pointer '.
		(($active ?? false)
			? 'border-mnw-darkblue bg-mnw-lighterdarkblue font-semibold'
			: 'border-transparent hover:font-medium hover:bg-mnw-lighterblue hover:border-mnw-lightblue focus:bg-mnw-lighterdarkblue focus:border-mnw-darkblue'
		);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
