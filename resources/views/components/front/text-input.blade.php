@props([
	'disabled' => false,
	'readonly' => false
])

<input type="{{ $attributes['type'] ?? 'text' }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 '.(($disabled || $readonly) ? 'focus:border-gray-300 focus:ring-0 focus:ring-offset-0' : 'focus:border-annonces-blue focus:ring-annonces-blue').' rounded-md shadow-sm text-gray-400 placeholder:text-gray-400']) !!}>
