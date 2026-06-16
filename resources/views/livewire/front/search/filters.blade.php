<div>
	<div class="flex flex-row justify-center m-4">
		<div class="flex flex-col p-8">
			@if($step == 'generalities')
				<div class="flex flex-col">
					{{ __('What type of watch are you interested in ?') }}

					<div class="flex flex-row">
						@foreach($data['types'] as $type)
							<div class="flex flex-row p-4 m-4 border">
								{{ ucfirst($type->name) }}
							</div>
						@endforeach
					</div>
				</div>

				<div class="flex flex-col">
					<x-input-label for="appointment-options" :value="__('A country preference ?')" :class="'pl-4'"/>

					<div class="flex flex-row">
						@foreach($data['countries'] as $country)
							<div class="w-full max-w-[360px] s:max-w-[198px]">
								<input type="checkbox" name="countries" value="children" id="children" wire:model="countries" class="peer hidden" />
								<label for="children" class="block cursor-pointer border border-mnw-greige rounded-xl hover:bg-mnw-cream peer-checked:bg-mnw-cream peer-checked:border-breeder-cream">
									<div>
										<h3 class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[170px]">
											<span>{{ ucfirst($country->name) }}</span>
										</h3>
									</div>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			@elseif($step == 'dimensions')

			@elseif($step == 'price')
			
			@endif
		</div>
	</div>
</div>