<div>
	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="flex flex-wrap items-center gap-4">
			<select id="role" wire:model.live="role" class="block mt-1 border border-gray-300 focus:border-mnw-deepblue focus:ring-mnw-deepblue rounded-md shadow-sm">
				<option value="">{{ __('Select a role') }}</option>
				@foreach($roles as $role)
					<option value="{{ $role->id }}">
						{{ __($role->name) }}
					</option>
				@endforeach
			</select>

			<div class="bg-white border-b border-gray-400 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
					<input type="text" wire:model.live="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s) : name, email') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>
		</div>
	</div>

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
			<table class="min-w-full">
				<thead>
					<tr>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Name') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Role') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Email verified') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Last logon') }}</th>
						<th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@if($users->isNotEmpty())
						@foreach($users as $userEntry)
							<tr>
								<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="flex-shrink-0 h-10 w-10">
											@if($userEntry->getFirstMedia('avatar'))
												<img class="h-10 w-10 rounded-full" src="{{ $userEntry->getFirstMedia('avatar')->getAvailableUrl(['optimized']) }}" alt="" />
											@endif
										</div>

										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $userEntry->name }}</div>
											<div class="text-sm leading-5 text-gray-500">{{ $userEntry->email }}</div>
										</div>
									</div>
								</td>

								<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
									@if($userEntry->roles->isNotEmpty())
										<button type="button"
											@if($userEntry->hasRole('applicant'))
												class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2 mr-2 mb-2"
											@elseif($userEntry->hasRole('recruiter'))
												@if($userEntry->hasRole('breeder'))
													class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
												@elseif($userEntry->hasRole('professionnal_breeder'))
													class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2 mr-2 mb-2"
												@elseif($userEntry->hasRole('individual_breeder'))
													class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
												@endif
											@elseif($userEntry->hasRole('professionnal'))
												class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
											@endif
										>
											{{ __($userEntry->getRoleNames()[0]) }}
										</button>
									@else
										{{ __('User has no role') }}
									@endif
								</td>

								<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
									{{ $userEntry->email_verified_at ? $userEntry->email_verified_at->format('d/m/Y H:i:s') : __('Email not verified yet') }}
								</td>

								<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
									{{ $userEntry->last_logon?->format('d/m/Y H:i:s') }}
								</td>

								<td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
									@if(!$userEntry->trashed())
										@if($userEntry->awaitingModeration())
											<a href="{{ route('admin.moderations.moderate', ['moderation' => $userEntry->getAwaitingModeration()]) }}" class="text-white inline-block">
												<button type="button" title="{{ __('Moderate the userEntry') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
													<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
														<path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
													</svg>
												</button>
											</a>
										@elseif($userEntry->moderations()->exists())
											<div class="inline-block">
												<x-admin.moderations.history :moderation="$userEntry->moderations()->latest()->first()" :history="$userEntry->moderations" />
											</div>
										@endif
									@endif

									@if(!$userEntry->email_verified_at)
										<button type="button" title="{{ __('Verify email') }}" wire:click="verifyEmail({{ $userEntry->id }})" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
											</svg>
										</button>
									@endif

									<a href="{{ route('admin.log-as-user', ['user' => $userEntry->slug]) }}" class="text-white inline-block">
										<button type="button" title="{{ __('Log as the user') }}" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
											</svg>
										</button>
									</a>

									@if($userEntry->hasRole('recruiter'))
										<button type="button" wire:click="getUser({{ $userEntry->id }}, 'toggle-mnw-role')" title="{{ $userEntry->hasRole('professionnal_breeder') ? __('Switch the professionnal breeder to an individual breeder') : __('Switch the individual breeder to a professionnal breeder') }}" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
											</svg>
										</button>
									@endif

									<button type="button" wire:click="getUser({{ $userEntry->id }}, 'change-user-email')" title="{{ __('Change user\'s email') }}" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
										</svg>
									</button>

									<button type="button" wire:click="getUser({{ $userEntry->id }}, 'reset-password')" title="{{ __('Reset the user\'s password and send it to him by email') }}" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
										</svg>
									</button>

									@if($userEntry->hasRole('professionnal_breeder'))
										<button type="button" wire:click="getUser({{ $userEntry->id }}, 'update-acaced')" title="{{ __('Update Acaced end dates') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-3.5 -3.5 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path d="M7.90659 2.43682H2.34035C1.91856 2.43682 1.51405 2.60438 1.2158 2.90263C0.917554 3.20088 0.75 3.60539 0.75 4.02718V15.1596C0.75 15.5814 0.917554 15.9859 1.2158 16.2842C1.51405 16.5824 1.91856 16.75 2.34035 16.75H13.4728C13.8946 16.75 14.2991 16.5824 14.5974 16.2842C14.8956 15.9859 15.0632 15.5814 15.0632 15.1596V9.59341M13.8704 1.24406C14.1868 0.927718 14.6158 0.75 15.0632 0.75C15.5105 0.75 15.9396 0.927718 16.2559 1.24406C16.5723 1.5604 16.75 1.98945 16.75 2.43682C16.75 2.8842 16.5723 3.31325 16.2559 3.62959L8.70176 11.1838L5.52106 11.9789L6.31623 8.79824L13.8704 1.24406Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</button>
									@endif

									<button type="button" wire:click="getUser({{ $userEntry->id }}, 'toggle-account')" title="{{ !$userEntry->trashed() ? __('Disable the user') : __('Enable the user') }}" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
										@if(!$userEntry->trashed())
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
											</svg>
										@else
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="m9 9 6-6m0 0 6 6m-6-6v12a6 6 0 0 1-12 0v-3" />
											</svg>
										@endif
									</button>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
								{{ __('No result for this search') }}
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md">
		{{ $users->links() }}
	</div>

	<x-front.modal name="toggle-account" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<h2 class="text-lg font-semibold">
					{{ $switchState }} ?
				</h2>
			</header>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'mr-6'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="toggleUser" @account-toggled.window="$dispatch('close');">
					{{ $switchState }}
				</x-front.primary-button>
			</div>
		</section>
	</x-front.modal>

	<x-front.modal name="toggle-mnw-role" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<h2 class="text-lg font-semibold">
					{{ __('Are you sure to switch the breeder\'s role ?') }}
				</h2>
			</header>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'mr-6'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="toggleBreederRole" @roles-switched.window="$dispatch('close');">
					{{ __('Switch breeder\'s role') }}
				</x-front.primary-button>
			</div>
		</section>
	</x-front.modal>

	<x-front.modal name="update-acaced" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<h2 class="text-lg font-semibold">
					{{ __('Acaced end dates update') }}
				</h2>
			</header>

			<div class="space-y-8">
				@if($user->exists)
					@if($user->values->get('interested_in') == 'both' || $user->values->get('interested_in') == 'dogs')
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="endDatesAcacedDogs" :value="__('Dog training certificate end date')" :class="'pl-4'"/>
							</div>

							<x-front.text-input type="date" name="endDatesAcacedDogs" id="endDatesAcacedDogs" wire:model="endDatesAcaced.dogs" placeholder="{{ __('DD/MM/YYYY') }}" :class="'mt-1 block bg-white'" />

							@error('endDatesAcaced.dogs')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif

					@if($user->values->get('interested_in') == 'both' || $user->values->get('interested_in') == 'cats')
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="endDatesAcacedCats" :value="__('Cat ACACED certificate end date')" :class="'pl-4'"/>
							</div>

							<x-front.text-input type="date" name="endDatesAcacedCats" id="endDatesAcacedCats" wire:model="endDatesAcaced.cats" placeholder="{{ __('DD/MM/YYYY') }}" :class="'mt-1 block bg-white'" />

							@error('endDatesAcaced.cats')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif
				@endif
			</div>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'mr-6'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="updateAcacedDates" @acaced-changed.window="$dispatch('close');">
					{{ __('Update Acaced end dates') }}
				</x-front.primary-button>
			</div>
		</section>
	</x-front.modal>

	<x-front.modal name="change-user-email" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<h2 class="text-lg font-semibold">
					{{ __('User\'s email change') }}
				</h2>
			</header>

			<div class="space-y-8">
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="currentEmail" :value="__('Current user\'s email')" />
					</div>

					<p>{{ $currentEmail }}</p>
				</div>

				<div>
					<div class="flex flex-row">
						<x-front.input-label for="email" :value="__('New user\'s email')" :required="true" />
					</div>

					<x-front.text-input type="email" id="email" wire:model="email" placeholder="{{ __('New user\'s email') }}" :class="'mt-1 block w-full'" />

					@error('email')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>
			</div>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'mr-6'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="changeEmail" @email-changed.window="$dispatch('close');">
					{{ __('Change user\'s email') }}
				</x-front.primary-button>
			</div>
		</section>
	</x-front.modal>

	<x-front.modal name="reset-password" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<h2 class="text-lg font-semibold">
					{{ __('Reset the user\'s password and send it to him by email') }} ?
				</h2>
			</header>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'mr-6'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="resetPassword" @password-changed.window="$dispatch('close');">
					{{ __('Reset password') }}
				</x-front.primary-button>
			</div>
		</section>
	</x-front.modal>
</div>
