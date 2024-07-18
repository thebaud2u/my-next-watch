@if($post->values_web['closing_date'])
	<div class="flex items-center">
		<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M1 1.25391H16.551" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1 21.2539H16.551" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M3.2207 1.25391V5.69835C3.2207 8.7678 5.70608 11.2539 8.77462 11.2539C11.8432 11.2539 14.3285 13.74 14.3285 16.8095V21.2539" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M14.3285 1.25391V5.69835C14.3285 8.7678 11.8432 11.2539 8.77462 11.2539C5.70608 11.2539 3.2207 13.74 3.2207 16.8095V21.2539" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M6.55469 5.69824C6.55469 6.92602 7.54884 7.92046 8.77626 7.92046" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M10.997 16.8096C10.997 15.5818 10.0028 14.5874 8.77539 14.5874" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		{{ \Carbon\Carbon::parse($post->values_web['closing_date'])->format('d/m/Y') }}
	</div>
@endif
