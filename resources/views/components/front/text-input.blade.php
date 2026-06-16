@props([
	'disabled' => false,
	'readonly' => false
])

<input type="{{ $attributes['type'] ?? 'text' }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge(['class' => 'border-jobboard-greige '.(($disabled || $readonly) ? 'focus:border-jobboard-greige focus:ring-0 focus:ring-offset-0' : 'focus:border-jobboard-deepblue focus:ring-jobboard-deepblue').' rounded-md shadow-sm text-jobboard-deepblue placeholder:text-jobboard-greige']) !!}>
