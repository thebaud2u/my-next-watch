@props(['active', 'textColor' => 'text-mnw-deepblue', 'activeColor'])

@php
	$classes = 'flex flex-col items-center text-sm font-semibold px-1 pt-1 whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer ';
	$classes .= $textColor;	
	if (!empty($active ?? false) && !empty($activeColor ?? null)) {
        $classes .= ' ' . $activeColor;
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
