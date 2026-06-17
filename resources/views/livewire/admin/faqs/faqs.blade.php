<div>
	{{-- Flash message --}}
	@if(Session::has('success'))
		<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
			@include('components.front.home.alert-message')
		</div>
	@endif

	<div class="flex flex-row">
		<x-front.primary-button wire:click="fresh" x-on:click.prevent="$dispatch('open-modal', 'set-faq');" :class="'xs:block mb-8 mr-4'">
			{{ __('Create an faq') }}
		</x-front.primary-button>
	</div>

	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap">
			<select id="author" wire:model="author" class="border-gray-300 focus:border-mnw-deepblue focus:ring-mnw-deepblue rounded-md shadow-sm text-mnw-deepblue placeholder:text-gray-400 mt-1 text-gray-400">
				<option value="">{{ __('Select :element', ['element' => __('the author')]) }}</option>
				@foreach($admins as $admin)
					<option value="{{ $admin->id}}">
						{{ $admin->name }}
					</option>
				@endforeach
			</select>

			<select id="state" wire:model="state" class="border-gray-300 focus:border-mnw-deepblue focus:ring-mnw-deepblue rounded-md shadow-sm text-mnw-deepblue placeholder:text-gray-400 mt-1 text-gray-400">
				<option value="">{{ __('Select an faq state') }}</option>
				<option value="{{ \App\Enums\FaqStates::Draft }}">{{ __('Draft') }}</option>
				<option value="{{ \App\Enums\FaqStates::Published }}">{{ __('Published') }}</option>
			</select>

			<div class="bg-white border-b border-gray-400 shadow-md px-2 py-1 lg:p-0 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>

					<input type="text" wire:model="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s)') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>
		</div>
	</div>

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		@if($faqs->isNotEmpty())
			<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
				<table class="min-w-full">
					<thead>
						<tr>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Status') }}</th>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Name') }}</th>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Author') }}</th>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Created at') }}</th>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Updated at') }}</th>
							<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
						</tr>
					</thead>

					<tbody class="bg-white">
						@foreach($faqs as $faq)
							<tr>
								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($faq->state->inHuman() == 'draft')
										<div class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"> {{ __('Draft') }}
									@elseif($faq->state->inHuman() == 'published')
										<div class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"> {{ __('Published') }}
									@endif

									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="text-sm leading-5 font-medium text-gray-900">
											{{ $faq->name }}
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="text-sm leading-5 font-medium text-gray-900">
											{{ $faq->author->name }}
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="text-sm leading-5 font-medium text-gray-900">
											{{ $faq->created_at->format('d/m/Y H:i:s') }}
										</div>
									</div>
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									<div class="flex items-center">
										<div class="text-sm leading-5 font-medium text-gray-900">
											{{ $faq->updated_at->format('d/m/Y H:i:s') }}
										</div>
									</div>
								</td>

								<td class="border-b border-gray-200">
									@if($faq->state->inHuman() == 'published')
										<a href="#" wire:click="draft({{ $faq->id }})" class="text-white inline-block">
											<button type="button" title="{{ __('Set to draft') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
													<path stroke-linecap="round" stroke-linejoin="round" d="m15 15-6 6m0 0-6-6m6 6V9a6 6 0 0 1 12 0v3" />
												</svg>
											</button>
										</a>
									@else
										<a href="#" wire:click="publish({{ $faq->id }})" class="text-white inline-block">
											<button type="button" title="{{ __('Publish the faq') }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
													<path stroke-linecap="round" stroke-linejoin="round" d="m9 9 6-6m0 0 6 6m-6-6v12a6 6 0 0 1-12 0v-3" />
												</svg>
											</button>
										</a>
									@endif

									<a href="#" wire:click="get({{ $faq->id }})" x-on:click.prevent="$dispatch('open-modal', 'set-faq');" title="{{ __('Edit') }}" class="text-white inline-block">
										<button type="button" title="{{ __('Edit') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
											</svg>
										</button>
									</a>

									<a href="#" wire:click="get({{ $faq->id }})" x-on:click.prevent="$dispatch('open-modal', 'delete-faq');" title="{{ __('Delete') }}" class="text-white inline-block">
										<button type="button" title="{{ __('Delete') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
											</svg>
										</button>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			{{ __('No search result') }}
		@endif
	</div>

	<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md">
		{{ $faqs->links() }}
	</div>

	<x-front.modal name="set-faq" focusable>
		<div class="space-y-8">
			<div>
				<div class="flex flex-row">
					<x-front.input-label for="newFaq.name" :value="__('Name of the faq')" :required="true" />
				</div>

				<x-front.text-input type="text" wire:model="newFaq.name" placeholder="{{ __('Name of the faq') }}" :class="'mt-1 block w-full'" />

				@error('newFaq.name')
					<span class="error text-danger-700">
						{{ $message }}
					</span>
				@enderror
			</div>

			<div class="flex flex-row justify-between">
				<x-front.secondary-button x-on:click="$dispatch('close');" :class="'flex justify-center mt-4 s:mt-0'">
					{{ __('Cancel') }}
				</x-front.secondary-button>

				<x-front.primary-button wire:click="set" @faq-validated.window="$dispatch('close');" :class="'flex justify-center mt-4 s:mt-0'">
					@if($newFaq->id)
						{{ __('Yes, update') }}
					@else
						{{ __('Add this faq') }}
					@endif
				</x-front.primary-button>
			</div>
		</div>
	</x-front.modal>

	<x-front.modal name="delete-faq" :class="'w-full max-w-2xl'" focusable>
		<section class="p-10 flex flex-col flex-wrap content-center">
			<header class="flex flex-col flex-wrap content-center">
				<p class="mt-1 text-sm m-auto text-mnw-deepblue">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
					</svg>
				</p>
				<h2 class="text-lg font-semibold">
					{{ __('Delete') }} ?
				</h2>
			</header>

			<div class="mt-6 flex flex-row flex-wrap justify-center">
				<x-front.primary-button wire:click="delete" @faq-deleted.window="$dispatch('close');" :class="'mr-6'">
					{{ __('Delete') }}
				</x-front.primary-button>

				<x-front.secondary-button x-on:click="$dispatch('close');">
					{{ __('Cancel') }}
				</x-front.secondary-button>
			</div>
		</section>
	</x-front.modal>
</div>
