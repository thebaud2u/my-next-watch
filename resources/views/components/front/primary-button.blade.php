@props(['centered' => false])

@php
	$classes = 'inline-flex items-center gap-x-2 px-5 py-3 whitespace-nowrap ' .
			   'rounded-full text-sm ' .
			   'focus:outline-none focus:ring-0 transition ease-in-out duration-150 ' .
			   'text-jobboard-cream font-bold bg-jobboard-deepblue border-jobboard-deepblue hover:bg-jobboard-deepbluehover hover:border-jobboard-deepbluehover';

	if ($centered) {
		$classes .= ' justify-center w-full text-center';
	}
@endphp

<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => $classes
]) }}>
	{{ $slot }}
</button>
