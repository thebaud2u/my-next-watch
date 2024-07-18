@if($post->values_web['starting_point'])
	<div class="flex items-center">
		<svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M17.3636 9.43572C17.3636 14.963 9.18182 21.2539 9.18182 21.2539C9.18182 21.2539 1 14.963 1 9.43572C1 3.90845 4.66364 1.25391 9.18182 1.25391C13.7 1.25391 17.3636 3.90845 17.3636 9.43572Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M9.18129 12.1629C11.1896 12.1629 12.8176 10.5348 12.8176 8.5265C12.8176 6.51819 11.1896 4.89014 9.18129 4.89014C7.17298 4.89014 5.54492 6.51819 5.54492 8.5265C5.54492 10.5348 7.17298 12.1629 9.18129 12.1629Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		{{ __('Starting point') }} : {{ \App\Models\Criteria::find($post->values_web['starting_point'])->name }}
	</div>
@endif

@if($post->values_web['destinations'])
	<div class="flex items-center">
		<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M1.36328 1.25488V21.2541" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M8.0293 13.8458V10.2607" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1.36328 12.3647C1.36328 12.3647 4.87426 10.7129 8.0297 10.261C8.54079 10.1862 9.03707 10.1425 9.51113 10.1425C11.4518 10.1425 11.7333 10.824 11.7333 11.6239C11.7333 12.9794 8.0297 12.5498 8.0297 13.8461C8.0297 15.046 9.42224 15.3275 10.9926 15.3275C13.5258 15.3275 16.9183 13.8461 16.9183 13.8461V4.95752C16.9183 4.95752 14.1406 6.17229 11.7333 6.3945" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1.36328 3.47605C1.36328 3.47605 6.08903 1.25391 9.51113 1.25391C11.4518 1.25391 11.7333 1.93536 11.7333 2.73607V11.6239" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		{{ __((count($post->values_web['destinations']) > 1)? 'Destinations' : 'Destination') }} : {{ \App\Models\Criteria::find($post->values_web['destinations'][0])->name }}@if(count($post->values_web['destinations']) > 1), +{{ count($post->values_web['destinations']) -1 }}@endif
	</div>
@endif
