<div>
	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-6">
			<div class="mt-4">
				<div id="anchor" class="relative overflow-hidden w-fit mx-auto flex flex-row font-semibold">
					<div class="absolute top-4 w-full border-t-2 border-opacity-50 border-mnw-blue"></div>
					@foreach($steps as $step)
						<div class="flex-none order-1 z-10 w-8 h-8 {{ ($step-1 > 0) ? 'ml-6' : '' }}">
							@if($watch->completed)
								@if ($step == $active)
									<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-lightblue border-mnw-blue text-mnw-blue">{{ $step }}</span>
								@else
									<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-blue border-white text-white" wire:click="goto({{ $step }})">{{ $step }}</button>
								@endif
							@elseif($step == $active)
								<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-lightblue border-mnw-blue text-mnw-blue">{{ $step }}</span>
							@elseif($step > $active)
								<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-gray-200 border-white text-gray-400">{{ $step }}</span>
							@else
								<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-blue border-white text-white" wire:click="goto({{ $step }})">{{ $step }}</button>
							@endif
						</div>
					@endforeach
				</div>
			</div>

			<div class="max-w-screen-xl mx-auto lg:px-6">
				{{-- Flash message --}}
				@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
					<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
						@include('components.alert-message')
					</div>
				@endif
			</div>

			<div class="grid gap-x-20 gap-y-5 grid-cols-1">
				@if($active == 1)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-52">
						{{ __('General informations') }}
					</h2>

					<div>
						<x-input-label for="selectedBrand" :value="__('What\'s this watch\'s :part', ['part' => __('brand')]).' ?'" :required="true" />

						<div class="block">
							<select id="selectedBrand" wire:model="selectedBrand" wire:change="brandSelected" class="rounded border border-gray-300 text-gray-400">
								<option value="">{{ __('Select a brand') }}</option>
								@foreach($brands as $brand)
									<option value="{{ $brand->id }}">{{ $brand->name }}</option>
								@endforeach
							</select>

							{{-- Call create-brand Modal --}}
							<button type="button" title="{{ __('Add a new brand') }}" x-on:click="$dispatch('open-modal', 'create-brand');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</button>
						</div>

						@error('selectedBrand')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-brand" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('brand')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="brandName" :value="__('What is the new brand\'s name').' ?'" :required="true" />

									<x-text-input type="text" name="brandName" wire:model="brandName" placeholder="{{ __('New brand name') }}" class="mt-1 block text-gray-400" />

									@error('brandName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<x-input-label for="brandLogo" :value="__('What is the new brand\'s logo').' ?'" />

									<livewire:uploader
										:max_medias="1"
										:first_is_main="true"
										:class="\App\Models\Mediable::class"
										:model_id="$modelId"
										:collection="'logo'"
										:grid_class="'w-full max-w-[250px]'"
										:aspect_ratio="'aspect-square'"
										:object_fit="'object-cover'"
										wire:key="logo-uploader-component-{{ time() }}" />
								</div>

								<div>
									<x-input-label for="brandDescription" :value="__('Description/history of the brand')" />

									<textarea name="brandDescription" wire:model.lazy="brandDescription" cols="30" rows="6" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>

									@error('brandDescription')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<x-input-label for="brandNationality" :value="__('What is the brand\'s nationality').' ?'" :required="true" />

									<div class="pr-5">
										<input type="radio" name="brandNationality" checked wire:model="brandNationality" value="American" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('American')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" checked wire:model="brandNationality" value="English" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('English')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" wire:model="brandNationality" value="French" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('French')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" wire:model="brandNationality" value="Japanese" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('Japanese')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" checked wire:model="brandNationality" value="German" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('German')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" wire:model="brandNationality" value="Swiss" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('Swiss')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="brandNationality" checked wire:model="brandNationality" value="Other" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="brandNationality" :value="__('Other')" :class="'inline-block font-normal'" />
									</div>

									@error('brandNationality')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<x-input-label for="brandExternalLink" :value="__('What is the new brand\'s website').' ?'" :required="true" />

									<x-text-input type="text" name="brandExternalLink" wire:model="brandExternalLink" placeholder="{{ __('New brand website') }}" class="mt-1 block text-gray-400" />

									@error('brandExternalLink')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createBrand" @brand-created.window="$dispatch('close')">
									{{ __('Add the brand') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					@if($selectedBrand)
						<div>
							<x-input-label for="watchCollection" :value="__('Part of which collection').' ?'" :required="true" />

							<div class="block">
								<select id="watchCollection" wire:model="watchCollection" class="rounded border border-gray-300 text-gray-400">
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

							@error('watchCollection')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<x-modal name="create-collection" :class="'w-full max-w-2xl'" focusable>
								<x-slot name="title">
									<header class="flex flex-row justify-center">
										<h2 class="text-lg font-semibold pt-1">
											{{ __('Add a new :brand collection', ['brand' => $brand->name]) }}
										</h2>
									</header>
								</x-slot>

								<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
									<div>
										<x-input-label for="collectionName" :value="__('What is the new :brand collection\'s name', ['brand' => $brand->name]).' ?'" :required="true" />

										<x-text-input type="text" name="collectionName" wire:model="collectionName" placeholder="{{ __('New collection name') }}" class="mt-1 block text-gray-400" />

										@error('collectionName')
											<span class="error text-danger-700">
												{{ $message }}
											</span>
										@enderror
									</div>
								</div>

								<div class="mt-6 flex flex-row flex-wrap justify-center">
									<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
										{{ __('Cancel') }}
									</x-secondary-button>

									<x-primary-button wire:click="createCollection" x-on:collection-created.window="$dispatch('close')">
										{{ __('Add the collection') }}
									</x-primary-button>
								</div>
							</x-modal>
						</div>
					@endif

					<div>
						<x-input-label for="watchName" :value="__('What\'s this watch\'s :part', ['part' => __('name')]).' ?'" :required="true" />

						<x-text-input type="text" name="watchName" wire:model="watchName" placeholder="{{ __('Watch\'s :part', ['part' => __('name')]) }}" class="mt-1 block text-gray-400" />

						@error('watchName')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="watchReference" :value="__('What\'s this watch\'s :part', ['part' => __('reference')]).' ?'" :required="true" />

						<x-text-input type="text" name="watchReference" wire:model="watchReference" placeholder="{{ __('Watch\'s :part', ['part' => __('reference')]) }}" class="mt-1 block text-gray-400" />

						@error('watchReference')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 2)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s movement') }}
					</h2>

					<div>
						<x-input-label for="watchMovement" :value="__('What\'s this watch\'s :part', ['part' => __('movement')]).' ?'" :required="true" />

						<div class="block">
							<select id="watchMovement" wire:model="watchMovement" class="rounded border border-gray-300 text-gray-400">
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

						@error('watchMovement')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-movement" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :brand movement', ['brand' => $brand->name]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="movementName" :value="__('What is the new :brand movement\'s name', ['brand' => $brand->name]).' ?'" :required="true" />

									<x-text-input type="text" name="movementName" wire:model="movementName" placeholder="{{ __('New movement name') }}" class="mt-1 block text-gray-400" />

									@error('movementName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<x-input-label for="movementType" :value="__('What is the movement\'s type').' ?'" :required="true" />

									<div class="pr-5">
										<input type="radio" name="movementType" wire:model="movementType" value="quartz" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementType" :value="__('Quartz')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementType" wire:model="movementType" value="solar" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementType" :value="__('Solar')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementType" wire:model="movementType" value="manual" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementType" :value="__('Manual')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementType" checked wire:model="movementType" value="automatic" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementType" :value="__('Automatic')" :class="'inline-block font-normal'" />
									</div>

									@error('movementType')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<input type="checkbox" name="movementCOSC" value="1" wire:model="movementCOSC" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="movementCOSC" :value="__('Is the movement COSC certified').' ?'" :class="'ml-2 inline-block font-normal'" />
								</div>

								<div>
									<input type="checkbox" name="movementMETAS" value="1" wire:model="movementMETAS" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="movementMETAS" :value="__('Is the movement METAS certified').' ?'" :class="'ml-2 inline-block font-normal'" />
								</div>

								<div>
									<input type="checkbox" name="movementManufacturedCaliber" value="1" wire:model="movementManufacturedCaliber" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="movementManufacturedCaliber" :value="__('Is the movement manufactured').' ?'" :class="'ml-2 inline-block font-normal'" />
								</div>

								<div>
									<x-input-label for="movementDescription" :value="__('Description/history of the movement')" />

									<textarea name="movementDescription" wire:model.lazy="movementDescription" cols="30" rows="6" required class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>

									@error('movementDescription')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>

								<div>
									<x-input-label for="movementNationality" :value="__('What is the movement\'s nationality').' ?'" :required="true" />

									<div class="pr-5">
										<input type="radio" name="movementNationality" checked wire:model="movementNationality" value="American" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('American')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" checked wire:model="movementNationality" value="English" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('English')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" wire:model="movementNationality" value="French" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('French')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" wire:model="movementNationality" value="Japanese" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('Japanese')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" checked wire:model="movementNationality" value="German" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('German')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" wire:model="movementNationality" value="Swiss" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('Swiss')" :class="'inline-block font-normal'" />
									</div>

									<div class="pr-5">
										<input type="radio" name="movementNationality" checked wire:model="movementNationality" value="Other" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

										<x-input-label for="movementNationality" :value="__('Other')" :class="'inline-block font-normal'" />
									</div>

									@error('movementNationality')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createMovement" x-on:movement-created="$dispatch('close')">
									{{ __('Add the movement') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="specificationComplication" :value="__('What\'s this watch\'s :part', ['part' => __('complication')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-complication Modal --}}
						<button type="button" title="{{ __('Add a new complication') }}" x-on:click="$dispatch('open-modal', 'create-complication');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($complications as $complication)
								<div>
									<input type="checkbox" name="specificationComplication" value="{{ $complication->id }}" wire:model="specificationComplication" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="specificationComplication" :value="$complication->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('specificationComplication')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-complication" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('complication')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="complicationName" :value="__('What is the new complication').' ?'" :required="true" />

									<x-text-input type="text" name="complicationName" wire:model="complicationName" placeholder="{{ __('New complication name') }}" class="mt-1 block text-gray-400" />

									@error('complicationName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createComplication" @complication-created.window="$dispatch('close')">
									{{ __('Add the complication') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="specificationPowerReserve" :value="__('What\'s this watch\'s :part', ['part' => __('power reserve')]).' ?'" :required="true" />

						<x-text-input type="number" name="specificationPowerReserve" wire:model="specificationPowerReserve" placeholder="{{ __('Watch\'s :part', ['part' => __('power reserve')]) }}" class="mt-1 block text-gray-400" />

						@error('specificationPowerReserve')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-secondary-button>

						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 3)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s case') }}
					</h2>

					<div>
						<x-input-label for="caseColor" :value="__('What\'s this watch\'s :part', ['part' => __('case color')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-case-color Modal --}}
						<button type="button" title="{{ __('Add a new case color') }}" x-on:click="$dispatch('open-modal', 'create-case-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($caseColors as $caseColor)
								<div>
									<input type="checkbox" name="caseColor" value="{{ $caseColor->id }}" wire:model="caseColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="caseColor" :value="$caseColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('caseColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-case-color" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('case color')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="caseColorName" :value="__('What is the new case color').' ?'" :required="true" />

									<x-text-input type="text" name="caseColorName" wire:model="caseColorName" placeholder="{{ __('New case color name') }}" class="mt-1 block text-gray-400" />

									@error('caseColorName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createCaseColor" @case-color-created.window="$dispatch('close')">
									{{ __('Add the case color') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="caseMaterial" :value="__('What\'s this watch\'s :part', ['part' => __('case material')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-case-material Modal --}}
						<button type="button" title="{{ __('Add a new case material') }}"  x-on:click="$dispatch('open-modal', 'create-case-material');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($caseMaterials as $caseMaterial)
								<div>
									<input type="checkbox" name="caseMaterial" value="{{ $caseMaterial->id }}" wire:model="caseMaterial" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="caseMaterial" :value="$caseMaterial->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('caseMaterial')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-case-material" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => 'case material']) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="caseMaterialName" :value="__('What is the new case material').' ?'" :required="true" />

									<x-text-input type="text" name="caseMaterialName" wire:model="caseMaterialName" placeholder="{{ __('New case material name') }}" class="mt-1 block text-gray-400" />

									@error('caseMaterialName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createCaseMaterial" @case-material-created.window="$dispatch('close')">
									{{ __('Add the case material') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="caseDiameter" :value="__('What\'s this watch\'s :part', ['part' => __('case diameter (in mm)')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseDiameter" wire:model="caseDiameter" placeholder="{{ __('Watch\'s :part', ['part' => __('diameter (in mm)')]) }}" class="mt-1 block text-gray-400" />

						@error('caseDiameter')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseLugWidth" :value="__('What\'s this watch\'s :part', ['part' => __('lug width  (in mm)')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseLugWidth" wire:model="caseLugWidth" placeholder="{{ __('Watch\'s :part', ['part' => __('lug width  (in mm)')]) }}" class="mt-1 block text-gray-400" />

						@error('caseLugWidth')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseLugToLug" :value="__('What\'s this watch\'s :part', ['part' => __('lug to lug (in mm)')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseLugToLug" wire:model="caseLugToLug" placeholder="{{ __('Watch\'s :part', ['part' => __('lug to lug (in mm)')]) }}" class="mt-1 block text-gray-400" />

						@error('caseLugToLug')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseThickness" :value="__('What\'s this watch\'s :part', ['part' => __('thickness (in mm)')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseThickness" wire:model="caseThickness" placeholder="{{ __('Watch\'s :part', ['part' => __('thickness (in mm)')]) }}" class="mt-1 block text-gray-400" />

						@error('caseThickness')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseOpenCaseBack" :value="__('What\'s this watch\'s :part', ['part' => __('case back')]).' ?'" :required="true" :class="'inline'" />

						<div>
							<input type="checkbox" name="caseOpenCaseBack" value="1" wire:model.live="caseOpenCaseBack" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-input-label for="caseOpenCaseBack" :value="__('Does it have an open case back').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					</div>

					@if($caseOpenCaseBack)
						<div>
							<x-input-label for="caseSapphireCrystalCaseBack" :value="__('What\'s this watch\'s :part', ['part' => __('case back material')]).' ?'" :required="true" :class="'inline'" />

							<div>
								<input type="checkbox" name="caseSapphireCrystalCaseBack" value="1" wire:model="caseSapphireCrystalCaseBack" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

								<x-input-label for="caseSapphireCrystalCaseBack" :value="__('Is the open case back in sapphire crystal').' ?'" :class="'ml-2 inline-block font-normal'" />
							</div>
						</div>
					@endif

					<div>
						<x-input-label for="caseWaterproofness" :value="__('What\'s this watch\'s :part', ['part' => __('waterproofness (in m)')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseWaterproofness" wire:model="caseWaterproofness" placeholder="{{ __('Watch\'s :part', ['part' => __('waterproofness (in m)')]) }}" class="mt-1 block text-gray-400" />

						@error('caseWaterproofness')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-secondary-button>

						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 4)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s crown') }}
					</h2>

					<div>
						<x-input-label for="crownColor" :value="__('What\'s this watch\'s :part', ['part' => __('crown color')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-crown-color Modal --}}
						<button type="button" title="{{ __('Add a new crown color') }}" x-on:click="$dispatch('open-modal', 'create-crown-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($crownColors as $crownColor)
								<div>
									<input type="checkbox" name="crownColor" value="{{ $crownColor->id }}" wire:model="crownColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="crownColor" :value="$crownColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('crownColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-crown-color" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('crown color')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="crownColorName" :value="__('What is the new crown color').' ?'" :required="true" />

									<x-text-input type="text" name="crownColorName" wire:model="crownColorName" placeholder="{{ __('New crown color name') }}" class="mt-1 block text-gray-400" />

									@error('crownColorName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createCrownColor" @crown-color-created.window="$dispatch('close')">
									{{ __('Add the crown color') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="crownDetail" :value="__('What\'s this watch\'s :part', ['part' => __('crown detail')]).' ?'" />

						<x-text-input type="text" name="crownDetail" wire:model="crownDetail" placeholder="{{ __('Watch\'s :part', ['part' => __('crown detail')]) }}" class="mt-1 block text-gray-400" />

						@error('crownDetail')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="crownMaterial" :value="__('What\'s this watch\'s :part', ['part' => __('crown material')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-crown-material Modal --}}
						<button type="button" title="{{ __('Add a new crown material') }}" x-on:click="$dispatch('open-modal', 'create-crown-material');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($crownMaterials as $crownMaterial)
								<div>
									<input type="checkbox" name="crownMaterial" value="{{ $crownMaterial->id }}" wire:model="crownMaterial" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="crownMaterial" :value="$crownMaterial->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('crownMaterial')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-crown-material" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('crown material')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="crownMaterialName" :value="__('What is the new crown material').' ?'" :required="true" />

									<x-text-input type="text" name="crownMaterialName" wire:model="crownMaterialName" placeholder="{{ __('New crown material name') }}" class="mt-1 block text-gray-400" />

									@error('crownMaterialName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createCrownMaterial" @crown-material-created.window="$dispatch('close')">
									{{ __('Add the crown material') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="crownScrewedDown" :value="__('What\'s this watch\'s :part', ['part' => __('crown screwing')]).' ?'" :required="true" :class="'inline'" />

						<div>
							<input type="checkbox" name="crownScrewedDown" value="1" wire:model="crownScrewedDown" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-input-label for="crownScrewedDown" :value="__('Can the crown be screwed down').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-secondary-button>

						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 5)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s bezel') }}
					</h2>

					<div>
						<x-input-label for="bezelColor" :value="__('What\'s this watch\'s :part', ['part' => __('bezel color')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-bezel-color Modal --}}
						<button type="button" title="{{ __('Add a new bezel color') }}" x-on:click="$dispatch('open-modal', 'create-bezel-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($bezelColors as $bezelColor)
								<div>
									<input type="checkbox" name="bezelColor" value="{{ $bezelColor->id }}" wire:model="bezelColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="bezelColor" :value="$bezelColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('bezelColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-bezel-color" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('bezel color')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="bezelColorName" :value="__('What is the new bezel color').' ?'" :required="true" />

									<x-text-input type="text" name="bezelColorName" wire:model="bezelColorName" placeholder="{{ __('New bezel color name') }}" class="mt-1 block text-gray-400" />

									@error('bezelColorName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createBezelColor" @bezel-color-created.window="$dispatch('close')">
									{{ __('Add the bezel color') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="bezelDirection" :value="__('What type of bezel').' ?'" :required="true" />

						<div class="pr-5">
							<input type="radio" name="bezelDirection" wire:model="bezelDirection" value="unidirectional" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

							<x-input-label for="bezelDirection" :value="__('Unidirectional')" :class="'inline-block font-normal'" />
						</div>

						<div class="pr-5">
							<input type="radio" name="bezelDirection" wire:model="bezelDirection" value="bidirectional" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

							<x-input-label for="bezelDirection" :value="__('Bidirectional')" :class="'inline-block font-normal'" />
						</div>

						@error('bezelDirection')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="bezelMarking" :value="__('What\'s this watch\'s :part', ['part' => __('bezel marking')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-bezel-marking Modal --}}
						<button type="button" title="{{ __('Add a new bezel marking') }}" x-on:click="$dispatch('open-modal', 'create-bezel-marking');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($bezelMarkings as $bezelMarking)
								<div>
									<input type="checkbox" name="bezelMarking" value="{{ $bezelMarking->id }}" wire:model="bezelMarking" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="bezelMarking" :value="$bezelMarking->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('bezelMarking')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-bezel-marking" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('bezel marking')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="bezelMarkingName" :value="__('What is the new bezel marking').' ?'" :required="true" />

									<x-text-input type="text" name="bezelMarkingName" wire:model="bezelMarkingName" placeholder="{{ __('New bezel marking name') }}" class="mt-1 block text-gray-400" />

									@error('bezelMarkingName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createBezelMarking" @bezel-marking-created.window="$dispatch('close')">
									{{ __('Add the bezel marking') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="bezelMaterial" :value="__('What\'s this watch\'s :part', ['part' => __('bezel material')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-bezel-material Modal --}}
						<button type="button" title="{{ __('Add a new bezel material') }}" x-on:click="$dispatch('open-modal', 'create-bezel-material');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($bezelMaterials as $bezelMaterial)
								<div>
									<input type="checkbox" name="bezelMaterial" value="{{ $bezelMaterial->id }}" wire:model="bezelMaterial" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="bezelMaterial" :value="$bezelMaterial->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('bezelMaterial')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-bezel-material" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('bezel material')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="bezelMaterialName" :value="__('What is the new bezel material').' ?'" :required="true" />

									<x-text-input type="text" name="bezelMaterialName" wire:model="bezelMaterialName" placeholder="{{ __('New bezel material name') }}" class="mt-1 block text-gray-400" />

									@error('bezelMaterialName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createBezelMaterial" @bezel-material-created.window="$dispatch('close')">
									{{ __('Add the bezel material') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-secondary-button>

						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 6)
					<h2 class="text-lg font-semibold border-b border-mnw-blue w-36">
						{{ __('Watch\'s dial') }}
					</h2>

					<div>
						<x-input-label for="dialColor" :value="__('What\'s this watch\'s :part', ['part' => __('dial color')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-dial-color Modal --}}
						<button type="button" title="{{ __('Add a new dial color') }}" x-on:click="$dispatch('open-modal', 'create-dial-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($dialColors as $dialColor)
								<div>
									<input type="checkbox" name="dialColor" value="{{ $dialColor->id }}" wire:model="dialColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="dialColor" :value="$dialColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('dialColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-dial-color" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('dial color')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="dialColorName" :value="__('What is the new dial color').' ?'" :required="true" />

									<x-text-input type="text" name="dialColorName" wire:model="dialColorName" placeholder="{{ __('New dial color name') }}" class="mt-1 block text-gray-400" />

									@error('dialColorName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createDialColor" @dial-color-created.window="$dispatch('close')">
									{{ __('Add the dial color') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="dialDomed" :value="__('What\'s this watch\'s :part', ['part' => __('domed dial')]).' ?'" :required="true" :class="'inline'" />

						<div>
							<input type="checkbox" name="dialDomed" value="1" wire:model="dialDomed" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-input-label for="dialDomed" :value="__('Is the dial domed').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					</div>

					<div>
						<x-input-label for="dialMarkerColor" :value="__('What\'s this watch\'s :part', ['part' => __('dial marker color')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-dial-marker-color Modal --}}
						<button type="button" title="{{ __('Add a new dial marker color') }}" x-on:click="$dispatch('open-modal', 'create-dial-marker-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($dialMarkerColors as $dialMarkerColor)
								<div>
									<input type="checkbox" name="dialMarkerColor" value="{{ $dialMarkerColor->id }}" wire:model="dialMarkerColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="dialMarkerColor" :value="$dialMarkerColor->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('dialMarkerColor')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-dial-marker-color" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('dial color')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="dialMarkerColorName" :value="__('What is the new dial marker color').' ?'" :required="true" />

									<x-text-input type="text" name="dialMarkerColorName" wire:model="dialMarkerColorName" placeholder="{{ __('New dial marker color name') }}" class="mt-1 block text-gray-400" />

									@error('dialMarkerColorName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createDialMarkerColor" @dial-marker-color-created.window="$dispatch('close')">
									{{ __('Add the dial marker color') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="dialMarkerLume" :value="__('What\'s this watch\'s :part', ['part' => __('marker lume')]).' ?'" :required="true" :class="'inline'" />

						<div>
							<input type="checkbox" name="dialMarkerLume" value="1" wire:model.live="dialMarkerLume" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-input-label for="dialMarkerLume" :value="__('Does the markers have lume').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					</div>

					@if($dialMarkerLume)
						<div>
							<x-input-label for="dialMarkerLumeColor" :value="__('What\'s this watch\'s :part', ['part' => __('dial marker lume color')]).' ?'" :required="true" :class="'inline'" />

							{{-- Call create-dial-marker-color Modal --}}
							<button type="button" title="{{ __('Add a new dial marker lume color') }}" x-on:click="$dispatch('open-modal', 'create-dial-marker-lume-color');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</button>

							<div>
								@foreach($dialMarkerLumeColors as $dialMarkerLumeColor)
									<div>
										<input type="checkbox" name="dialMarkerLumeColor" value="{{ $dialMarkerLumeColor->id }}" wire:model="dialMarkerLumeColor" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

										<x-input-label for="dialMarkerLumeColor" :value="$dialMarkerLumeColor->name" :class="'ml-2 inline-block font-normal'" />
									</div>
								@endforeach
							</div>

							@error('dialMarkerLumeColor')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							<x-modal name="create-dial-marker-lume-color" :class="'w-full max-w-2xl'" focusable>
								<x-slot name="title">
									<header class="flex flex-row justify-center">
										<h2 class="text-lg font-semibold pt-1">
											{{ __('Add a new :part', ['part' => __('dial marker lume color')]) }}
										</h2>
									</header>
								</x-slot>

								<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
									<div>
										<x-input-label for="dialMarkerLumeColorName" :value="__('What is the new dial marker lume color').' ?'" :required="true" />

										<x-text-input type="text" name="dialMarkerLumeColorName" wire:model="dialMarkerLumeColorName" placeholder="{{ __('New dial marker lume color name') }}" class="mt-1 block text-gray-400" />

										@error('dialMarkerLumeColorName')
											<span class="error text-danger-700">
												{{ $message }}
											</span>
										@enderror
									</div>
								</div>

								<div class="mt-6 flex flex-row flex-wrap justify-center">
									<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
										{{ __('Cancel') }}
									</x-secondary-button>

									<x-primary-button wire:click="createDialMarkerLumeColor" @dial-marker-lume-color-created.window="$dispatch('close')">
										{{ __('Add the dial marker lume color') }}
									</x-primary-button>
								</div>
							</x-modal>
						</div>
					@endif

					<div>
						<x-input-label for="dialMarkerType" :value="__('What\'s this watch\'s :part', ['part' => __('dial marker type')]).' ?'" :required="true" :class="'inline'" />

						{{-- Call create-dial-marker-color Modal --}}
						<button type="button" title="{{ __('Add a new dial marker type') }}" x-on:click="$dispatch('open-modal', 'create-dial-marker-type');" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>

						<div>
							@foreach($dialMarkerTypes as $dialMarkerType)
								<div>
									<input type="checkbox" name="dialMarkerType" value="{{ $dialMarkerType->id }}" wire:model="dialMarkerType" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

									<x-input-label for="dialMarkerType" :value="$dialMarkerType->name" :class="'ml-2 inline-block font-normal'" />
								</div>
							@endforeach
						</div>

						@error('dialMarkerType')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						<x-modal name="create-dial-marker-type" :class="'w-full max-w-2xl'" focusable>
							<x-slot name="title">
								<header class="flex flex-row justify-center">
									<h2 class="text-lg font-semibold pt-1">
										{{ __('Add a new :part', ['part' => __('dial marker type')]) }}
									</h2>
								</header>
							</x-slot>

							<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
								<div>
									<x-input-label for="dialMarkerTypeName" :value="__('What is the new dial marker type').' ?'" :required="true" />

									<x-text-input type="text" name="dialMarkerTypeName" wire:model="dialMarkerTypeName" placeholder="{{ __('New dial marker type name') }}" class="mt-1 block text-gray-400" />

									@error('dialMarkerTypeName')
										<span class="error text-danger-700">
											{{ $message }}
										</span>
									@enderror
								</div>
							</div>

							<div class="mt-6 flex flex-row flex-wrap justify-center">
								<x-secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
									{{ __('Cancel') }}
								</x-secondary-button>

								<x-primary-button wire:click="createDialMarkerType" @dial-marker-type-created.window="$dispatch('close')">
									{{ __('Add the dial marker type') }}
								</x-primary-button>
							</div>
						</x-modal>
					</div>

					<div>
						<x-input-label for="dialTextured" :value="__('What\'s this watch\'s :part', ['part' => __('dial texture')]).' ?'" :required="true" :class="'inline'" />

						<div>
							<input type="checkbox" name="dialTextured" value="1" wire:model.live="dialTextured" class="w-4 h-4 text-mnw-blue border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />

							<x-input-label for="dialTextured" :value="__('Is the dial textured').' ?'" :class="'ml-2 inline-block font-normal'" />
						</div>
					</div>

					<div class="px-5 py-6 flex justify-end">
						<x-secondary-button :class="'mr-6'" wire:click="back()">
							{{ __('Return to the previous step') }}
						</x-secondary-button>

						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
