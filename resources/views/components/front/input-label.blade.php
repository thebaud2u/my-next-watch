@props([
	'value',
	'required' => false
])

<label {{ $attributes->merge(['class' => 'font-medium text-sm text-mnw-deepblue']) }}>
	{{ $value ?? $slot }}

	@if($required)
		<span class="text-mnw-violet">*</span>
	@endif
</label>
