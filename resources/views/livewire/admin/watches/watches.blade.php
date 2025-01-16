<div x-data="{ addCollection: false, addMovement: false }">
	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap max-w-[936px]">
			<select id="admin" wire:model="admin" class="rounded border border-gray-300 text-gray-400">
				<option value="">{{ __('Select an author') }}</option>
				@foreach($admins as $admin)
					<option value="{{ $admin->id}}">{{ $admin->name }}</option>
				@endforeach
			</select>

			<select id="status" wire:model="status" class="rounded border border-gray-300 text-gray-400">
				<option value="">{{ __('Select a state') }}</option>
				<option value="{{ \App\Enums\InformationStatus::Draft }}">{{ __('Draft') }}</option>
				<option value="{{ \App\Enums\InformationStatus::Published }}">{{ __('Published') }}</option>
				<option value="{{ \App\Enums\InformationStatus::Deleted }}">{{ __('Deleted') }}</option>
			</select>

			<div class="bg-white border-b border-gray-300 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>

					<input type="text" wire:model="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s)') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>

			<a href="#" x-on:click="$dispatch('open-modal', 'add-watch'); addCollection = false" class="text-white inline-block">
				<button type="button" title="{{ __('Add a new watch') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</button>
			</a>
		</div>
	</div>

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
			<table class="min-w-full">
				<thead>
					<tr>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Id') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Brand') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Name') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Reference') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Author') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Status') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Published at') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@foreach($watches as $watch)
						<tr>
							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['slug' => $watch->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->id }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('brand.show', ['slug' =>$watch->collection->brand->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->collection->brand->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['slug' => $watch->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['slug' => $watch->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->reference }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->admin->name }}</div>
											<div class="text-sm leading-5 text-gray-500">{{ $watch->admin->email }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								@if($watch->status == \App\Enums\InformationStatus::Draft)
									<div class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Draft') }}
								@elseif($watch->status == \App\Enums\InformationStatus::Published)
									<div class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Published') }}
								@elseif($watch->status == \App\Enums\InformationStatus::Deleted)
									<div class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Archived') }}
								@endif

								</div>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['slug' => $watch->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ \Carbon\Carbon::parse($watch->published_at)->format('d/m/Y H:i:s') }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
								<a href="{{ route('watch.show', ['slug' => $watch->slug]) }}" class="text-white inline-block">
									<button type="button" title="{{ __('View the post') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
										</svg>
									</button>
								</a>

								<a href="{{ route('admin.log-as-user',$watch->admin) }}" class="text-white inline-block">
									<button type="button" title="{{ __('Log as the user') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
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

	<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md">
		{{ $watches->links() }}
	</div>

	<x-front.modal name="add-watch" :class="'w-full max-w-2xl'" focusable>
		<header class="flex flex-row justify-center">
			<h2 class="text-lg font-semibold pt-1">
				{{ __('Add a new watch') }}
			</h2>
		</header>

		<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5">
			<div>
				<x-front.input-label for="brand_id" :value="__('What is the watch\'s brand').' ?'" :required="true" />

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

						<button type="button" title="{{ __('Add a new collection') }}" x-on:click="addCollection = true" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

					<div x-show="addCollection" class="border border-1 border-gray-200 round-md grid gap-x-20 gap-y-5 grid-cols-1 ml-4 mt-4 p-4">
						<h2 class="flex flex-row justify-center text-lg font-semibold pt-1">
							{{ __('Add a new :brand collection', ['brand' => $brand->name]) }}
						</h2>

						<div>
							<x-front.input-label for="newCollection.name" :value="__('What is the new :brand collection\'s name', ['brand' => $brand->name]).' ?'" :required="true" />

							<x-front.text-input type="text" name="newCollection.name" wire:model="newCollection.name" placeholder="{{ __('New collection name') }}" class="mt-1 block text-gray-400" />

							@error('newCollection.name')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="addCollection = false" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="addCollection" @collection-added.window="addCollection = false">
								{{ __('Add the collection') }}
							</x-front.primary-button>
						</div>
					</div>
				</div>
			@endif

			<div>
				<x-front.input-label for="newWatch.name" :value="__('What\'s the watch name').' ?'" :required="true" />

				<x-front.text-input type="text" name="newWatch.name" wire:model="newWatch.name" placeholder="{{ __('Watch\'s name') }}" class="mt-1 block text-gray-400" />

				@error('newWatch.name')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<x-front.input-label for="newWatch.reference" :value="__('What\'s the watch reference').' ?'" :required="true" />

				<x-front.text-input type="text" name="newWatch.reference" wire:model="newWatch.reference" placeholder="{{ __('Watch\'s reference') }}" class="mt-1 block text-gray-400" />

				@error('newWatch.reference')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			@if($brand_id)
				<div>
					<x-front.input-label for="newWatch.movement_id" :value="__('What\'s this watch\'s movement').' ?'" :required="true" />

					<div class="block">
						<select id="newWatch.movement_id" wire:model="newWatch.movement_id" class="rounded border border-gray-300 text-gray-400">
							<option value="">{{ __('Select a movement') }}</option>
							@foreach($movements as $movement)
								<option value="{{ $movement->id }}">{{ $movement->name }}</option>
							@endforeach
						</select>

						<button type="button" title="{{ __('Add a new movement') }}" x-on:click="addMovement = true" class=" mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

					<div x-show="addMovement" class="border border-1 border-gray-200 round-md grid gap-x-20 gap-y-5 grid-cols-1 ml-4 mt-4 p-4">
						<h2 class="flex flex-row justify-center text-lg font-semibold pt-1">
							{{ __('Add a new :brand movement', ['brand' => $brand->name]) }}
						</h2>

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

								<label for="offer_id">
									{{ __('Quartz') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.type" wire:model="newMovement.type" value="solar" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.type">
									{{ __('Solar') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.type" wire:model="newMovement.type" value="manual" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.type">
									{{ __('Manual') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.type" checked wire:model="newMovement.type" value="automatic" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.type">
									{{ __('Automatic') }}
								</label>
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

								<label for="newMovement.nationality">
									{{ __('American') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="English" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('English') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="French" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('French') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="Japanese" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('Japanese') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="German" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('German') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" wire:model="newMovement.nationality" value="Swiss" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('Swiss') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="newMovement.nationality" checked wire:model="newMovement.nationality" value="Other" class="disabled:bg-gray-200 mr-2 border-gray-300 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue">

								<label for="newMovement.nationality">
									{{ __('Other') }}
								</label>
							</div>

							@error('newMovement.nationality')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="mt-6 flex flex-row flex-wrap justify-center">
							<x-front.secondary-button x-on:click="addMovement = false" :class="'mr-6'">
								{{ __('Cancel') }}
							</x-front.secondary-button>

							<x-front.primary-button wire:click="addMovement" @movement-added.window="addMovement = false">
								{{ __('Add the movement') }}
							</x-front.primary-button>
						</div>
					</div>
				</div>
			@endif
		</div>

		<div class="mt-6 flex flex-row flex-wrap justify-center">
			<x-front.secondary-button x-on:click="$dispatch('close')" :class="'mr-6'">
				{{ __('Cancel') }}
			</x-front.secondary-button>

			<x-front.primary-button wire:click="addWatch" @watch-added.window="$dispatch('close');">
				{{ __('Add the watch') }}
			</x-front.primary-button>
		</div>
	</x-front.modal>

	<x-front.modal name="update-subscription" :class="'w-full max-w-2xl'" focusable>
		<header class="flex flex-row justify-center">
			<button type="button" title="{{ __('Create a new subscription') }}" class="text-white bg-blue-700 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
				</svg>
			</button>

			<h2 class="text-lg font-semibold pt-1">
				{{ __('Update a subscription') }}
			</h2>
		</header>

		<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
			<div>
				<div class="flex flex-row">
					<x-front.input-label for="creditRemaining" :value="__('Credits remaining')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-front.text-input type="number" name="creditRemaining" wire:model="userSubscription.remaining_quantity" class="mt-1 block text-gray-400" placeholder="{{ __('Credits remaining') }}" />
				</div>

				@error('userSubscription.remaining_quantity')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-front.input-label for="expirationDate" :value="__('Expires on')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-front.text-input type="date" name="expirationDate" wire:model="userSubscription.end_date" class="mt-1 block text-gray-400" placeholder="{{ __('Expires on') }}" />
				</div>

				@error('userSubscription.end_date')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-front.input-label for="reference" :value="__('Reference')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-front.text-input type="text" name="reference" wire:model="userSubscription.reference" class="mt-1 block text-gray-400" placeholder="{{ __('Reference') }}" />
				</div>

				@error('userSubscription.reference')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>
		</div>

		<div class="mt-6 flex flex-row flex-wrap justify-center">
			<x-front.primary-button wire:click="updateWatch()" @watch-updated.window="$dispatch('close');" :class="'mr-6'">
				{{ __('Yes, update') }}
			</x-front.primary-button>

			<x-front.secondary-button x-data="" x-on:click="$dispatch('close')">
				{{ __('No, go back') }}
			</x-front.secondary-button>
		</div>
	</x-front.modal>
</div>
