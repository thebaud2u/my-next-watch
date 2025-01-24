<div>
	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap max-w-[936px]">
			<select id="offer" wire:model="offer" class="block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm">
				<option value="">{{ __('Select an offer') }}</option>
				@foreach($offers as $offer)
					<option value="{{ $offer->id}}">{{ $offer->name }}</option>
				@endforeach
			</select>

			<div class="bg-white border-b border-gray-300 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
					<input type="text" wire:model="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s)') }} {{ __('ex : email, reference') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>

			<a href="#" x-on:click="$dispatch('open-modal', 'add-subscription')" class="text-white inline-block">
				<button type="button" title="{{ __('Create a new subscription') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Registered') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Offer') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Credits remaining') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Bought on') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Expire on') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Reference') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Created from') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Synchronized with Boutique') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@if($subscriptions->isNotEmpty())
						@foreach($subscriptions as $subscription)
							<tr>
								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $subscription->user->name }} - {{ $subscription->user->email }}</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												@if($subscription->offer->type == 'web' || $subscription->offer->type == 'print')
													{{ __('Post') }}
												@elseif($subscription->offer->type == 'page_entreprise')
													{{ __('Company page') }}
												@endif
												"{{ $subscription->offer->name }}"
											</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												{{ $subscription->remaining_quantity }}
											</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												{{ Carbon\Carbon::parse($subscription->created_at)->format('d/m/Y') }}
											</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												{{ Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y') }}
											</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												{{ $subscription->reference }}
											</div>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
												{{ $subscription->from }}
											</button>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="ml-4">
											<button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
												@if($subscription->synchronized_with_boutique == 1)
													{{ __('Yes') }}
												@else
													{{ __('No') }}
												@endif
											</button>
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
									<div class="flex flex-nowrap items-center">
										<a href="{{ route('admin.log-as-user', $subscription->user) }}" class="text-white inline-block">
											<button type="button" title="{{ __('Log as the user') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
													<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
												</svg>
											</button>
										</a>

										<a href="#" wire:click="setUserSubscription({{ $subscription->id }})" x-on:click="$dispatch('open-modal', 'update-subscription')" class="text-white inline-block">
											<button type="button" title="{{ __('Add credit') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
													<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
												</svg>
											</button>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="8" class="text-center">
								{{ __('No result for this search') }}
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md">
		{{ $subscriptions->links() }}
	</div>

	<x-modal name="add-subscription" :class="'w-full max-w-2xl'" focusable>
		<header class="flex flex-row justify-center">
			<button type="button" title="{{ __('Create a new subscription') }}" class="text-white bg-blue-700 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</button>

			<h2 class="text-lg font-semibold pt-1">
				{{ __('Create a new subscription') }}
			</h2>
		</header>

		<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
			<div>
				<div class="flex flex-row">
					<x-input-label for="userEmail" :value="__('Registered\'s account email')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="email" name="userEmail" wire:model="userEmail" wire:keydown.debounce.500ms="searchRegistered" placeholder="{{ __('Registered\'s account email') }}" class="mt-1 block text-gray-400 " />
				</div>

				@if($userEmail && $foundUsers)
					<div class="flex flex-col mt-2">
						@if($foundUsers->isNotEmpty())
							<h4 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
								{{ __('Registereds found') }} :
							</h4>
							<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
								@foreach($foundUsers as $foundUser)
									<li wire:click="setUserForNewSubscription({{ $foundUser->id }})" class="cursor-pointer">{{ $foundUser->name }} - {{ $foundUser->email }}</li>
								@endforeach
							</ul>
						@else
							{{ __('No registered found') }}
						@endif
					</div>
				@endif

				@error('userEmail')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="offer_id" :value="__('Offer')" />
				</div>

				<select name="offer_id" wire:model="newSubscription.offer_id" class="block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm">
					<option value="">{{ __('Select an offer') }}</option>
					@foreach($offers as $offer)
						<option value="{{ $offer->id}}">{{ $offer->name }}</option>
					@endforeach
				</select>

				@error('newSubscription.offer_id')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="creditRemaining" :value="__('Credits remaining')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="number" name="creditRemaining" wire:model="newSubscription.remaining_quantity" class="mt-1 block text-gray-400 " placeholder="{{ __('Credits remaining') }}" />
				</div>

				@error('newSubscription.remaining_quantity')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="expirationDate" :value="__('Expire on')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="date" name="expirationDate" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" wire:model="newSubscription.end_date" class="mt-1 block text-gray-400 " placeholder="{{ __('Expires on') }}" />
				</div>

				@error('newSubscription.end_date')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="reference" :value="__('Reference')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="text" name="reference" wire:model="newSubscription.reference" class="mt-1 block text-gray-400 " placeholder="{{ __('Reference') }}" />
				</div>

				@error('newSubscription.reference')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>
		</div>

		<div class="mt-6 flex flex-row flex-wrap justify-center">
			<x-primary-button wire:click="addSubscription" @subscription-added.window="$dispatch('close');" :class="'mr-6'">
				{{ __('Create the subscription') }}
			</x-primary-button>

			<x-secondary-button x-data="" x-on:click="$dispatch('close')">
				{{ __('No, go back') }}
			</x-secondary-button>
		</div>
	</x-modal>

	<x-modal name="update-subscription" :class="'w-full max-w-2xl'" focusable>
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
					<x-input-label for="creditRemaining" :value="__('Credits remaining')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="number" name="creditRemaining" wire:model="userSubscription.remaining_quantity" class="mt-1 block text-gray-400 " placeholder="{{ __('Credits remaining') }}" />
				</div>

				@error('userSubscription.remaining_quantity')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="expirationDate" :value="__('Expires on')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="date" name="expirationDate" wire:model="userSubscription.end_date" class="mt-1 block text-gray-400 " placeholder="{{ __('Expires on') }}" />
				</div>

				@error('userSubscription.end_date')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div>
				<div class="flex flex-row">
					<x-input-label for="reference" :value="__('Reference')" />
				</div>

				<div class="flex flex-row mt-2">
					<x-text-input type="text" name="reference" wire:model="userSubscription.reference" class="mt-1 block text-gray-400 " placeholder="{{ __('Reference') }}" />
				</div>

				@error('userSubscription.reference')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>
		</div>

		<div class="mt-6 flex flex-row flex-wrap justify-center">
			<x-primary-button wire:click="updateSubscription()" @subscription-updated.window="$dispatch('close');" :class="'mr-6'">
				{{ __('Yes, update') }}
			</x-primary-button>

			<x-secondary-button x-data="" x-on:click="$dispatch('close')">
				{{ __('No, go back') }}
			</x-secondary-button>
		</div>
	</x-modal>
</div>
