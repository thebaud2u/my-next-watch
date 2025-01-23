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

			<a href="{{ route('admin.watches.create-watch') }}" class="text-white inline-block">
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
								<a href="{{ route('watch.show', ['watch' => $watch]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->id }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('brand.show', ['brand' =>$watch->collection->brand->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->collection->brand->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['watch' => $watch]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $watch->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('watch.show', ['watch' => $watch]) }}" target="_blank">
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
								<a href="{{ route('watch.show', ['watch' => $watch]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ \Carbon\Carbon::parse($watch->published_at)->format('d/m/Y H:i:s') }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
								<a href="{{ route('admin.watches.update-watch', ['watch' => $watch]) }}" class="text-white inline-block">
									<button type="button" title="{{ __('Update the watch\'s info') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
											<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
										</svg>
									</button>
								</a>

								<a href="{{ route('watch.show', ['watch' => $watch]) }}" class="text-white inline-block">
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
</div>
