@props([
	'value',
	'required' => false
])

<label {{ $attributes->merge(['class' => 'font-medium text-sm text-jobboard-deepblue']) }}>
	{{ $value ?? $slot }}

	@if($required)
		<span class="text-jobboard-violet">*</span>
	@endif
</label>
