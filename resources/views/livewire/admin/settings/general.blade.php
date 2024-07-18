<div>
	{{-- Flash message --}}
	@if(Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info'))
		<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
			@include('components.front.home.alert-message')
		</div>
	@endif

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
			<table class="min-w-full">
				<thead>
					<tr>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Name') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('State') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@foreach($thematics as $thematic)
						<tr>
							<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
								<div class="flex items-center">
									<div class="text-sm leading-5 font-medium text-gray-900">
										{{ $thematic->name }}
									</div>

									<div class="text-sm leading-5 text-gray-500">
										{{ $thematic->slug }}
									</div>
								</div>
							</td>

							<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
								<div class="flex items-center">
									<div class="text-sm leading-5 font-medium text-gray-900">
										{{ __(($thematic->enabled)? 'Enabled' : 'Disabled') }}
									</div>
								</div>
							</td>

							<td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
								<a href="#" wire:click="switchThematic({{ $thematic->id }})" class="text-white inline-block">
									@php
										if($thematic->enabled) $classes = 'bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800';
										else $classes = 'bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800';
									@endphp
									<button type="button" title="{{ __(($thematic->enabled)? 'Disable the thematic' : 'Enable the thematic') }}" class="text-white focus:ring-4 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 {{ $classes }}">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
											<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
										</svg>
									</button>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
