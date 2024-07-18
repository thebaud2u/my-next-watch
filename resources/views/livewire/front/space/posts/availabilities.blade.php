<div>
	@if($bigComponentTitle)
		<div class="mt-8">
			<h2 class="text-lg font-semibold">
				{{ __('Availabilities') }}
			</h2>
	@else
		{{ __('Availabilities') }}
	@endif

		<hr class="w-24 h-1 mb-4 border-0">

		<div class="mt-4">
			<div class="w-full py-4 bg-gray-100 rounded-lg">
				@php
					/** Carousel display modes */
					$display = [    // Max 464px width (modal form display)
						'640' => 1, // < 640 px : 1 element displayed
						'max' => 3  // >= 640 px : 3
					];
				@endphp
				<x-carousel-multielements :nbElements="12" :display="$display" :autoplay="false" :buttons="'small'" :classes="'px-2'">
					@for($i = 0; $i < 12; $i++)
						<div wire:key="carousel-{{ $i }}" class="flex justify-center"
							x-bind:class="{'w-full':display==1 @foreach($display as $res => $nb) {{ ($nb > 1) ? ",'w-1/".$nb."':display==".$nb : "" }} @endforeach}"
							x-show="({{ $i }}<display*current&&{{ $i }}>=display*(current-1))"
							x-transition:enter="transition transform duration-500"
							x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
							@php
								$month = ($i == 0) ? \Carbon\Carbon::now()->startOfMonth() : \Carbon\Carbon::now()->startOfMonth()->add($i, 'month');
							@endphp
							<x-calendar :post="$post" :date="$month" :canDelete="$canDelete" :disabled="$disabled" />
						</div>
					@endfor
				</x-carousel-multielements>
			</div>
		</div>
	@if($bigComponentTitle)
		</div>
	@endif
</div>
