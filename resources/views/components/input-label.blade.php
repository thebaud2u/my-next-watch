@props([
	'value',
	'required' => false
])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-black']) }}>
	{{ $value ?? $slot }}

	@if($required)
		<span class="text-red-500">*</span>
	@endif
</label>
