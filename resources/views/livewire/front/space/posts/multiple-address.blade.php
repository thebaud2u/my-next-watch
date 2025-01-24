<div>
	@if($address->id)
		<div class="flex flex-row p-6 rounded shadow-md">
			<div class="flex flex-col">
				<div class="flex flex-row">
					<h2 class="font-semibold text-md mr-2">
						@if(!is_null($address->city))
							{{ $address->city->name }} ({{ $address->city->zip_code }})
						@elseif(!is_null($address->department))
							{{ $address->department->name }}
						@elseif(!is_null($address->region))
							{{ $address->region->name }}
						@elseif(!is_null($address->country))
							{{ $address->country->name }}
						@endif
					</h2>

					<div class="text-danger-500">
						<a href="#" x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-multiple-address-{{ $address->id }}')" title="{{ __('Delete') }}">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	@endif

	<x-modal name="delete-multiple-address-{{ $address?->id }}" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<p class="mt-1 text-sm m-auto text-mnw-blue">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
					</svg>
				</p>

				<h2 class="text-lg font-semibold">
					{{ __('Delete') }} ?
				</h2>
			</header>

			<div class="mt-6 flex flex-col flex-wrap content-center">
				<button type="button" wire:click="remove()" x-on:click="$dispatch('close')" class="px-3 py-1.5 whitespace-nowrap bg-mnw-blue hover:bg-blue-900 border-2 border-mnw-darkblue hover:border-mnw-blue rounded-md text-sm xl:text-base text-white font-medium focus:outline-none focus:ring-0 transition ease-in-out duration-150 block">
					{{ __('Yes, delete') }}
				</button>

				<button type="button" x-on:click="$dispatch('close')" class="text-mnw-blue underline mt-4">
					{{ __('No, go back') }}
				</button>
			</div>
		</section>
	</x-modal>
</div>
