@php
	$classes = 'mb-10 text-base lg:text-xl font-semibold leading-6 text-mnw-blue';
@endphp

<h1 {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</h1>
