@props(['active', 'textColor' => 'text-jobboard-deepblue', 'svgArrows' => true, 'activeTextColor' => 'text-jobboard-deepblue'])

@php
	$classes = 'flex flex-row gap-x-3 items-center justify-between font-semibold whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer';
	if($active) $classes = $classes.' '.$activeTextColor;
	else $classes = $classes.' '.$textColor;
@endphp
<div class="{{ $textColor }} flex flex-row mb-1 p-4 items-center justify-between font-semibold whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer @if($active) bg-jobboard-cream @endif">
	<a {{ $attributes->merge(['class' => $classes]) }}>
		{{ $slot }}
	</a>
	@if($svgArrows)
		<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="deployItem == false" x-on:click="deployItem = !deployItem">
			<path d="M12 14L16 18L20 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="deployItem == true" x-on:click="deployItem = !deployItem">
			<path d="M12 18L16 14L20 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	@endif
</div>
