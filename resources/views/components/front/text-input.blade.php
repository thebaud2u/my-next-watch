@props([
	'disabled' => false,
	'readonly' => false
])

<input type="{{ $attributes['type'] ?? 'text' }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge(['class' => 'border-mnw-greige '.(($disabled || $readonly) ? 'focus:border-mnw-greige focus:ring-0 focus:ring-offset-0' : 'focus:border-mnw-deepblue focus:ring-mnw-deepblue').' rounded-md shadow-sm text-mnw-deepblue placeholder:text-mnw-greige']) !!}>
