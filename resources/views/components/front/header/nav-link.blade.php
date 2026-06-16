@props(['active', 'activeColor' => '#FF7E71', 'textColor' => 'text-jobboard-deepblue'])

@php
	$classes = 'text-center font-semibold pt-1 whitespace-nowrap focus:outline-none transition duration-150 ease-in-out cursor-pointer '.$textColor;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}

	@if ($active)
		<div class="relative w-full">
			<div class="absolute left-0 transform translate-x-[50%] w-full">
				<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="{{$activeColor}}"/>
				</svg>
			</div>
		</div>
	@endif
</a>
