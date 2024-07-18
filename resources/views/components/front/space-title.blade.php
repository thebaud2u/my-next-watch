@php
	if (empty($attributes['class'])) {
		$attributes['class'] = 'text-base lg:text-xl font-semibold text-annonces-blue';
	}
@endphp
	<h1 {{ $attributes->merge(['class' => 'mb-1']) }}>{{ $slot }}</h1>
