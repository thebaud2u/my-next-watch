<div>
	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-6">
			<div class="mt-4">
				<div id="anchor" class="relative overflow-hidden w-fit mx-auto flex flex-row font-semibold">
					<div class="absolute top-4 w-full border-t-2 border-opacity-50 border-mnw-blue"></div>
					@foreach($steps as $step)
						<div class="flex-none order-1 z-10 w-8 h-8 {{ ($step-1 > 0) ? 'ml-6' : '' }}">
							@if($watch->status->color() == 'green')
								@if ($step == $active)
									<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-jobboard-lightblue border-jobboard-blue text-jobboard-blue">{{ $step }}</span>
								@else
									<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-jobboard-blue border-white text-white" wire:click="goto({{ $step }})">{{ $step }}</button>
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
						</div>

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

					@if($selectedBrand)
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
						</div>

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
					@endif

					<div class="px-5 py-6 flex justify-end">
						<x-primary-button wire:click="updateWatch">
							{{ __('Continue to the next step') }}
						</x-primary-button>
					</div>
				@elseif($active == 2)
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

						{{-- Call create-case-color Modal --}}
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
						<x-input-label for="caseDiameter" :value="__('What\'s this watch\'s :part', ['part' => __('case diameter')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseDiameter" wire:model="caseDiameter" placeholder="{{ __('Watch\'s :part', ['part' => __('diameter')]) }}" class="mt-1 block text-gray-400" />

						@error('caseDiameter')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseLugWidth" :value="__('What\'s this watch\'s :part', ['part' => __('lug width')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseLugWidth" wire:model="caseLugWidth" placeholder="{{ __('Watch\'s :part', ['part' => __('lug width')]) }}" class="mt-1 block text-gray-400" />

						@error('caseLugWidth')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseLugToLug" :value="__('What\'s this watch\'s :part', ['part' => __('lug to lug')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseLugToLug" wire:model="caseLugToLug" placeholder="{{ __('Watch\'s :part', ['part' => __('lug to lug')]) }}" class="mt-1 block text-gray-400" />

						@error('caseLugToLug')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-input-label for="caseThickness" :value="__('What\'s this watch\'s :part', ['part' => __('thickness')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseThickness" wire:model="caseThickness" placeholder="{{ __('Watch\'s :part', ['part' => __('thickness')]) }}" class="mt-1 block text-gray-400" />

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
						<x-input-label for="caseWaterproofness" :value="__('What\'s this watch\'s :part', ['part' => __('waterproofness')]).' ?'" :required="true" />

						<x-text-input type="number" name="caseWaterproofness" wire:model="caseWaterproofness" placeholder="{{ __('Watch\'s :part', ['part' => __('waterproofness')]) }}" class="mt-1 block text-gray-400" />

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
				@endif
			</div>
		</div>
	</div>
</div>
