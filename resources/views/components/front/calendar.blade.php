@php
	/**
	 * Back-end inspiration from @see https://github.com/benhall14/php-calendar
	 * Front-end inspiration from @see https://tuk.dev/components/webapp/calendar/calendar
	 */

	// Init vars
	$week = 1;
	$runningDayCount = 1;
@endphp

<div class="p-2 w-52 bg-white rounded-md">
	<div class="px-2 pt-1 text-center focus:outline-none text-sm font-bold text-gray-800">
		{{ $calMonths[strtolower($date->format('F'))].' '.$date->format('Y') }}
	</div>

	<div class="flex items-center justify-between pt-2 md:pt-3">
		<table class="w-48">
			<thead>
				<tr>
					@foreach($getDays as $index => $day)
						<th class="w-[14%] pb-2 md:pb-3">
							<div class="w-full flex justify-center">
								<p class="text-sm font-medium text-center text-gray-800">
									<abbr title="{{ $day['full'] }}">{{ $day['initials'] }}</abbr>
								</p>
							</div>
						</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					@for($x = 0; $x < $weekday; $x++)
						<td></td>
					@endfor

					@while($runningDayCount <= $totalDaysInMonth)
						<td class="w-7 h-7 p-0">
							<div class="w-full aspect-square">
								@if(!empty($availabilities[$runningDay->isoFormat('X')]))
									@if($canDelete)
										<div wire:click="deletePeriod({{ $availabilities[$runningDay->isoFormat('X')] }})" title="{{ __('Remove the availability period') }}" class="relative flex items-center justify-center w-full rounded-full cursor-pointer">
											<div class="text-xs w-6 h-6 flex items-center justify-center font-medium text-white bg-annonces-darklightblue rounded-full">
												<span>
													{{ $runningDay->format('j') }}
												</span>
											</div>
										</div>
									@else
										<div class="group relative flex items-center justify-center w-full rounded-full">
											<div class="text-xs w-6 h-6 flex items-center justify-center font-medium text-white bg-annonces-darklightblue rounded-full">
												<span>
													{{ $runningDay->format('j') }}
												</span>
											</div>

											<div class="invisible group-hover:visible w-auto absolute bottom-full z-10 mb-1 whitespace-nowrap pointer-events-none bg-gray-800 text-white text-xs rounded-lg px-3 py-2">
												<div class="flex flex-row items-center">
													{{ __('Available at :x', ['x' => $runningDay->format('d/m/Y')])}}
												</div>

												<svg class="absolute text-gray-800 h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
													<polygon class="fill-current" points="0,0 127.5,127.5 255,0"/>
												</svg>
											</div>
										</div>
									@endif
								@elseif($runningDay->isoFormat('X') == $today->isoFormat('X'))
									<div @if(!$disabled) wire:click="setPeriod('{{ $runningDay->format('Y-m-d') }}')" @endif class="group relative flex items-center justify-center w-full rounded-full @if(!$disabled) cursor-pointer @endif">
										<div class="text-xs w-6 h-6 flex items-center justify-center font-medium text-white bg-annonces-blue rounded-full">
											<span>
												{{ $runningDay->format('j') }}
											</span>
										</div>

										<div class="invisible group-hover:visible w-auto absolute bottom-full z-10 mb-1 whitespace-nowrap pointer-events-none bg-gray-800 text-white text-xs rounded-lg px-3 py-2">
											{{ __('Today') }}

											<svg class="absolute text-gray-800 h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
												<polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
											</svg>
										</div>
									</div>
								@else
									<div @if($runningDay >= $dateMin && !$disabled) wire:click="setPeriod('{{ $runningDay->format('Y-m-d') }}')" @endif class="flex items-center justify-center @if($runningDay >= $dateMin && !$disabled) cursor-pointer hover:bg-annonces-lightblue rounded-full @endif">
										<span class="text-xs text-gray-500 w-6 h-6 flex items-center justify-center font-medium">
											{{ $runningDay->format('j') }}
										</span>
									</div>
								@endif
							</div>
						</td>

						@if($runningDay->format('w') == $startingDay)
							</tr>
							@if(($runningDayCount + 1) <= $totalDaysInMonth)
								@php
									$week += 1;
								@endphp
								<tr>
							@endif
						@endif

						@php
							$runningDay->modify('+1 Day');
							$runningDayCount += 1;
						@endphp
					@endwhile

					@if($startingDay == 6)
						@php
							$paddingAtEndOfMonth = 7 - $runningDay->format('w');
						@endphp
					@else
						@php
							$paddingAtEndOfMonth = ($runningDay->format('w') == 0) ? 1 : 7 - ($runningDay->format('w') - 1);
						@endphp
					@endif

					@if($paddingAtEndOfMonth && $paddingAtEndOfMonth < 7)
						@for($x = 1; $x <= $paddingAtEndOfMonth; $x++)
							<td></td>
						@endfor
					@endif
				</tr>
			</tbody>
		</table>
	</div>
</div>
