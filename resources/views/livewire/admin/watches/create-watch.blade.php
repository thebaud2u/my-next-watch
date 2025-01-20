<div>
	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-6">
			<div class="mt-4">
				<div id="anchor" class="relative overflow-hidden w-fit mx-auto flex flex-row font-semibold">
					<div class="absolute top-4 w-full border-t-2 border-opacity-50 border-mnw-blue"></div>
					@foreach($steps as $step)
						<div class="flex-none order-1 z-10 w-8 h-8 {{ ($step-1 > 0) ? 'ml-6' : '' }}">
							@if(($step) == $active)
								<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-lightblue border-mnw-blue text-mnw-blue">{{ $step }}</span>
							@elseif(($step) > $active)
								<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-gray-200 border-white text-gray-400">{{ $step }}</span>
							@else
								<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-blue border-white text-white" wire:click="goto({{ $step }})">{{ $step }}</button>
							@endif
						</div>
					@endforeach
				</div>
			</div>

			<div class="grid gap-x-20 gap-y-5 grid-cols-1">
				@if($active == 1)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-52">
						{{ __('General informations') }}
					</h2>

					<div>
						<x-front.input-label for="brand_id" :value="__('What\'s this watch\'s :part', ['part' => 'brand']).' ?'" :required="true" />

						<select id="brand_id" wire:model="brand_id" wire:change="brandSelected" class="rounded border border-gray-300 text-gray-400">
							<option value="">{{ __('Select a brand') }}</option>
							@foreach($brands as $brand)
								<option value="{{ $brand->id }}">{{ $brand->name }}</option>
							@endforeach
						</select>

						@error('brand_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					@if($brand_id)
						<div>
							<x-front.input-label for="newWatch.collection_id" :value="__('Part of which collection').' ?'" :required="true" />

							<div class="block">
								<select id="newWatch.collection_id" wire:model="newWatch.collection_id" class="rounded border border-gray-300 text-gray-400">
									<option value="">{{ __('Select a collection') }}</option>
									@foreach($collections as $collection)
										<option value="{{ $collection->id }}">{{ $collection->name }}</option>
									@endforeach
								</select>

								{{-- Call create-collection Modal --}}
								<button type="button" title="{{ __('Add a new collection') }}" x-on:click="$dispatch('open-modal', 'create-collection');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
									</svg>
								</button>
							</div>

							@error('newWatch.collection_id')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div>
							<x-front.input-label for="newWatch.movement_id" :value="__('What\'s this watch\'s :part', ['part' => 'movement']).' ?'" :required="true" />

							<div class="block">
								<select id="newWatch.movement_id" wire:model="newWatch.movement_id" class="rounded border border-gray-300 text-gray-400">
									<option value="">{{ __('Select a movement') }}</option>
									@foreach($movements as $movement)
										<option value="{{ $movement->id }}">{{ $movement->name }}</option>
									@endforeach
								</select>

								{{-- Call create-movement Modal --}}
								<button type="button" title="{{ __('Add a new movement') }}"  x-on:click="$dispatch('open-modal', 'create-movement');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
									</svg>
								</button>
							</div>

							@error('newWatch.movement_id')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif

					<div>
						<x-front.input-label for="newWatch.name" :value="__('What\'s this watch\'s :part', ['part' => 'name']).' ?'" :required="true" />

						<x-front.text-input type="text" name="newWatch.name" wire:model="newWatch.name" placeholder="{{ __('Watch\'s :part', ['part' => 'name']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.name')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="newWatch.reference" :value="__('What\'s this watch\'s :part', ['part' => 'reference']).' ?'" :required="true" />

						<x-front.text-input type="text" name="newWatch.reference" wire:model="newWatch.reference" placeholder="{{ __('Watch\'s :part', ['part' => 'reference']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.reference')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-front.primary-button wire:click="createWatch" @watch-created.window="$dispatch('close');">
							{{ __('Continue to the next step') }}
						</x-front.primary-button>
					</div>

					{{-- Step modals --}}
					<x-front.modal name="create-collection" :class="'w-full max-w-2xl'" focusable>
						<header class="flex flex-row justify-center">
							<h2 class="text-lg font-semibold pt-1">
								{{ __('Add a new :brand collection', ['brand' => $brand->name]) }}
							</h2>
						</header>

						<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
							<div>
								<x-front.input-label for="newCollection.name" :value="__('What is the new :brand collection\'s name', ['brand' => $brand->name]).' ?'" :required="true" />

								<x-front.text-input type="text" name="newCollection.name" wire:model="newCollection.name" placeholder="{{ __('New collection name') }}" class="mt-1 block text-gray-400" />

								@error('newCollection.name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="addCollection" @collection-created.window="$dispatch('close')">
								{{ __('Add the collection') }}
							</x-front.primary-button>
						</div>
					</x-front.modal>

					<x-front.modal name="create-movement" :class="'w-full max-w-2xl'" focusable>
						<header class="flex flex-row justify-center">
							<h2 class="text-lg font-semibold pt-1">
								{{ __('Add a new :brand movement', ['brand' => $brand->name]) }}
							</h2>
						</header>

						<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
							<div>
								<x-front.input-label for="newMovement.name" :value="__('What is the new :brand movement\'s name', ['brand' => $brand->name]).' ?'" :required="true" />

								<x-front.text-input type="text" name="newMovement.name" wire:model="newMovement.name" placeholder="{{ __('New movement name') }}" class="mt-1 block text-gray-400" />

								@error('newMovement.name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<x-front.input-label for="newMovement.type" :value="__('What is the movement\'s type').' ?'" :required="true" />

								<div class="pr-5">
									<input type="radio" name="newMovement.type" wire:model="newMovement.type" value="quartz" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.type" :value="__('Quartz')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.type" wire:model="newMovement.type" value="solar" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.type" :value="__('Solar')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.type" wire:model="newMovement.type" value="manual" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.type" :value="__('Manual')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.type" checked wire:model="newMovement.type" value="automatic" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.type" :value="__('Automatic')" :class="'inline-block font-normal'" />
								</div>

								@error('newMovement.type')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<input type="checkbox" name="newMovement.COSC" value="1" wire:model="newMovement.COSC" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

								<x-front.input-label for="newMovement.COSC" :value="__('Is the movement COSC certified').' ?'" :class="'ml-2 inline-block font-normal'" />
							</div>

							<div>
								<input type="checkbox" name="newMovement.METAS" value="1" wire:model="newMovement.METAS" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

								<x-front.input-label for="newMovement.METAS" :value="__('Is the movement METAS certified').' ?'" :class="'ml-2 inline-block font-normal'" />
							</div>

							<div>
								<input type="checkbox" name="newMovement.manufactured_caliber" value="1" wire:model="newMovement.manufactured_caliber" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

								<x-front.input-label for="newMovement.manufactured_caliber" :value="__('Is the movement manufactured').' ?'" :class="'ml-2 inline-block font-normal'" />
							</div>

							<div>
								<x-front.input-label for="newMovement.description" :value="__('Description/history of the movement')" />

								<textarea name="newMovement.description" wire:model.lazy="newMovement.description" cols="30" rows="6" required class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>

								@error('newMovement.description')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div>
								<x-front.input-label for="newMovement.nationality" :value="__('What is the movement\'s type').' ?'" :required="true" />

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="American" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('American')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="English" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('English')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="French" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('French')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="Japanese" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('Japanese')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="German" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('German')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="Swiss" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('Swiss')" :class="'inline-block font-normal'" />
								</div>

								<div class="pr-5">
									<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="Other" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

									<x-front.input-label for="newMovement.nationality" :value="__('Other')" :class="'inline-block font-normal'" />
								</div>

								@error('newMovement.nationality')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="createMovement" @movement-created.window="$dispatch('close')">
								{{ __('Add the movement') }}
							</x-front.primary-button>
						</div>
					</x-front.modal>
				@elseif($active == 2)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s case') }}
					</h2>

					<div>
						<x-front.input-label for="watchCaseColor" :value="__('What\'s this watch\'s :part', ['part' => 'case color']).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-case-color Modal --}}
						<button type="button" title="{{ __('Add a new case color') }}"  x-on:click="$dispatch('open-modal', 'create-case-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($caseColors as $caseColor)
								<div>
									<input type="checkbox" name="watchCaseColor" value="{{ $caseColor->id }}" wire:model="watchCaseColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-front.input-label for="watchCaseColor" :value="$caseColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('watchCaseColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="watchCaseMaterial" :value="__('What\'s this watch\'s case material').' ?'" :required="true" :class="'inline'" />

						{{-- Call create-case-color Modal --}}
						<button type="button" title="{{ __('Add a new case material') }}"  x-on:click="$dispatch('open-modal', 'create-case-material');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($caseMaterials as $caseMaterial)
								<div>
									<input type="checkbox" name="watchCaseMaterial" value="{{ $caseMaterial->id }}" wire:model="watchCaseMaterial" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-front.input-label for="watchCaseMaterial" :value="$caseMaterial->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('watchCaseMaterial')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="newWatch.case.diameter" :value="__('What\'s this watch\'s :part', ['part' => 'case diameter']).' ?'" :required="true" />

						<x-front.text-input type="number" name="newWatch.case.diameter" wire:model="newWatch.case.diameter" placeholder="{{ __('Watch\'s :part', ['part' => 'diameter']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.case.diameter')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="newWatch.case.lug_width" :value="__('What\'s this watch\'s :part', ['part' => 'lug width']).' ?'" :required="true" />

						<x-front.text-input type="number" name="newWatch.case.lug_width" wire:model="newWatch.case.lug_width" placeholder="{{ __('Watch\'s :part', ['part' => 'lug width']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.case.lug_width')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="newWatch.case.lug_to_lug" :value="__('What\'s this watch\'s :part', ['part' => 'lug to lug']).' ?'" :required="true" />

						<x-front.text-input type="number" name="newWatch.case.lug_to_lug" wire:model="newWatch.case.lug_to_lug" placeholder="{{ __('Watch\'s :part', ['part' => 'lug to lug']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.case.lug_to_lug')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="newWatch.case.thickness" :value="__('What\'s this watch\'s :part', ['part' => 'thickness']).' ?'" :required="true" />

						<x-front.text-input type="number" name="newWatch.case.thickness" wire:model="newWatch.case.thickness" placeholder="{{ __('Watch\'s :part', ['part' => 'thickness']) }}" class="mt-1 block text-gray-400" />

						@error('newWatch.case.thickness')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<input type="checkbox" name="newWatch.case.open_case_back" value="1" wire:model="newWatch.case.open_case_back" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

						<x-front.input-label for="newWatch.case.open_case_back" :value="__('Does it have an open case back').' ?'" :class="'ml-2 inline-block font-normal'" />
					</div>

					@if($newWatch->case['open_case_back'])
						<div>
							<input type="checkbox" name="newWatch.case.sapphire_crystal_case_back" value="1" wire:model="newWatch.case.sapphire_crystal_case_back" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-front.input-label for="newWatch.case.sapphire_crystal_case_back" :value="__('Is the open case back in sapphire crystal').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					@endif

					<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md flex justify-end">
						<x-front.secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-front.secondary-button>

						<x-front.primary-button wire:click="addWatchCase" @watch-created.window="$dispatch('close');">
							{{ __('Continue to the next step') }}
						</x-front.primary-button>
					</div>

					{{-- Step modals--}}
					<x-front.modal name="create-case-color" :class="'w-full max-w-2xl'" focusable>
						<header class="flex flex-row justify-center">
							<h2 class="text-lg font-semibold pt-1">
								{{ __('Add a new case color') }}
							</h2>
						</header>

						<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
							<div>
								<x-front.input-label for="newCaseColor.name" :value="__('What is the new case color').' ?'" :required="true" />

								<x-front.text-input type="text" name="newCaseColor.name" wire:model="newCaseColor.name" placeholder="{{ __('New case color name') }}" class="mt-1 block text-gray-400" />

								@error('newCaseColor.name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="createCaseColor" @case-color-created.window="$dispatch('close')">
								{{ __('Add the case color') }}
							</x-front.primary-button>
						</div>
					</x-front.modal>

					<x-front.modal name="create-case-material" :class="'w-full max-w-2xl'" focusable>
						<header class="flex flex-row justify-center">
							<h2 class="text-lg font-semibold pt-1">
								{{ __('Add a new case material') }}
							</h2>
						</header>

						<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
							<div>
								<x-front.input-label for="newCaseMaterial.name" :value="__('What is the new case material').' ?'" :required="true" />

								<x-front.text-input type="text" name="newCaseMaterial.name" wire:model="newCaseMaterial.name" placeholder="{{ __('New case material name') }}" class="mt-1 block text-gray-400" />

								@error('newCaseMaterial.name')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="createCaseMaterial" @case-material-created.window="$dispatch('close')">
								{{ __('Add the case material') }}
							</x-front.primary-button>
						</div>
					</x-front.modal>
				@endif
			</div>
		</div>
	</div>
</div>
