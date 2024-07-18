@if($post->values_web['goods_type'])
	<div class="flex inline-block gap-2">
		<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M10.8605 1L20.8605 5.34783L10.8605 9.69565L0.860474 5.34783L10.8605 1Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M15.7213 3.11328L5.72131 7.46111" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M20.8605 5.34766V16.652L10.8605 20.9998L0.860474 16.652V5.34766" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M10.8605 9.6958V21.0001" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M5.64307 10.565V7.42676" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		<div class="flex flex-col">
			<div class="flex flex-row">
				{{ __('Good types') }} :
			</div>

			<span class="ml-4">
				@foreach($post->values_web['goods_type'] as $goodType)
					<div class="flex flex-row">
						- {{ \App\Models\Criteria::find($goodType)->name }}
					</div>
				@endforeach
			</span>
		</div>
	</div>
@endif

@if($post->values_web['destinations'] && count($post->values_web['destinations']) > 1)
	<div class="flex inline-block gap-2">
		<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M1.36328 1.25488V21.2541" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M8.0293 13.8458V10.2607" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1.36328 12.3647C1.36328 12.3647 4.87426 10.7129 8.0297 10.261C8.54079 10.1862 9.03707 10.1425 9.51113 10.1425C11.4518 10.1425 11.7333 10.824 11.7333 11.6239C11.7333 12.9794 8.0297 12.5498 8.0297 13.8461C8.0297 15.046 9.42224 15.3275 10.9926 15.3275C13.5258 15.3275 16.9183 13.8461 16.9183 13.8461V4.95752C16.9183 4.95752 14.1406 6.17229 11.7333 6.3945" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1.36328 3.47605C1.36328 3.47605 6.08903 1.25391 9.51113 1.25391C11.4518 1.25391 11.7333 1.93536 11.7333 2.73607V11.6239" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		<div class="flex flex-col">
			<div class="flex flex-row">
				{{ __('Destinations') }} :
			</div>

			<span class="ml-4">
				@foreach($post->values_web['destinations'] as $destination)
					<div class="flex flex-row">
						- {{ \App\Models\Criteria::find($destination)->name }}
					</div>
				@endforeach
			</span>
		</div>
	</div>
@endif
