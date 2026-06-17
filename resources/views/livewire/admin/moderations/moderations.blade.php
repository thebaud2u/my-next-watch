<div>
	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap max-w-[936px]">
			<select id="state" wire:model.live="state" class="border-gray-300 focus:border-jobboard-deepblue focus:ring-jobboard-deepblue rounded-md shadow-sm text-jobboard-deepblue placeholder:text-gray-400 mt-1 text-gray-400">
				<option value="">{{ __('Select a moderation state') }}</option>
				@foreach($moderationStates as $index => $value)
					<option value="{{ $index }}" wire:key="state-{{ $index }}">
						{{ __($value) }}
					</option>
				@endforeach
			</select>

			<select id="type" wire:model.live="type" class="border-gray-300 focus:border-jobboard-deepblue focus:ring-jobboard-deepblue rounded-md shadow-sm text-jobboard-deepblue placeholder:text-gray-400 mt-1 text-gray-400">
				<option value="">{{ __('Select a data source') }}</option>
				@foreach($types as $key => $value)
					<option value="{{ $key }}"  wire:key="type-{{ $key }}">
						{{ __($value) }}
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

					<input type="text" wire:model.live="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s)') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>
		</div>
	</div>

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
			<table class="min-w-full">
				<thead>
					<tr>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('In moderation since') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Type') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Status') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Infos') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Offer') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Status') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Source') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@if($moderations->isNotEmpty())
						@foreach($moderations as $moderation)
							@php
								if($moderation->model instanceof \App\Models\Company || $moderation->model instanceof \App\Models\Post || $moderation->model instanceof \App\Models\ProfessionnalActivity) {
									$lastPublication = $moderation->model->lastPublication;
									$subscription = $lastPublication->subscription;
									$offer = $subscription->offer;
								}
							@endphp

							<tr>
								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									{{ $moderation->created_at->format('d/m/Y') }}
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->model instanceof \App\Models\Animal)
										<div class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											{{ __('Animal') }}
										</div>
									@elseif($moderation->model instanceof \App\Models\Company)
										<div class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('Company') }}
										</div>
									@elseif($moderation->model instanceof \App\Models\Post)
										<div class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('Post') }}
										</div>
									@elseif($moderation->model instanceof \App\Models\ProfessionnalActivity)
										<div class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											{{ __('Professionnal activity') }}
										</div>
									@elseif($moderation->model instanceof \App\Models\Comment)
										<div class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											{{ __('Comment') }}
										</div>
									@elseif($moderation->model instanceof \App\Models\User)
										<div class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('User') }}
										</div>
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->isWaiting())
										<div class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('Waiting') }}
										</div>
									@elseif($moderation->isValidated())
										<div class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('Validated') }}
										</div>
									@elseif($moderation->isDenied())
										<div class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
											{{ __('Denied') }}
										</div>
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->model instanceof \App\Models\Animal)
										{{ $moderation->model->name }}, {{ $moderation->model->company ? $moderation->model->company->name : __('Without company') }} {!! $moderation->model->company ? '- <span class="text-sm text-gray font-bold">'.$moderation->model->company->user?->email.'</span>' : '' !!}
									@elseif($moderation->model instanceof \App\Models\Company || $moderation->model instanceof \App\Models\Post || $moderation->model instanceof \App\Models\ProfessionnalActivity)
										{{ $moderation->model->name }}, {{ $moderation->model->user?->name }} - <span class="text-sm text-gray font-bold">{{ $moderation->model->user?->email }}</span>
									@elseif($moderation->model instanceof \App\Models\Comment)
										{{ __('Comment from ":source" to ":target"', ['source' => $moderation->model->source->name, 'target' => $moderation->model->target->name]) }}</span>
									@elseif($moderation->model instanceof \App\Models\User)
										<button type="button"
											@if($moderation->model->hasRole('applicant'))
												class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2 mr-2 mb-2"
											@elseif($moderation->model->hasRole('recruiter'))
												@if($moderation->model->hasRole('breeder'))
													class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
												@elseif($moderation->model->hasRole('professionnal_breeder'))
													class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2 mr-2 mb-2"
												@elseif($moderation->model->hasRole('individual_breeder'))
													class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
												@endif
											@elseif($moderation->model->hasRole('professionnal'))
												class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"
											@endif
										>
											{{ __($moderation->model->getRoleNames()[0]) }}
										</button>

										{{ $moderation->model->name }} - <span class="text-sm text-gray font-bold">{{ $moderation->model->email }}</span>
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->model instanceof \App\Models\Company || $moderation->model instanceof \App\Models\Post || $moderation->model instanceof \App\Models\ProfessionnalActivity)
										{{ $offer->name }}
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->model instanceof \App\Models\Company || $moderation->model instanceof \App\Models\Post || $moderation->model instanceof \App\Models\ProfessionnalActivity)
										@if(!$offer->free)
											@if($subscription->synchronized_with_stripe)
												{{ __($subscription->values->get('payment_method')) }} - {{ __($subscription->values->get('payment_status')) }}
											@endif
										@endif
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
									@if($moderation->model instanceof \App\Models\Company || $moderation->model instanceof \App\Models\Post || $moderation->model instanceof \App\Models\ProfessionnalActivity)
										{{ $subscription->from }}
									@endif
								</td>

								<td class="px-2 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
									<a href="{{ route('admin.moderations.moderate', ['moderation' => $moderation->id]) }}" class="text-white inline-block">
										<button type="button" title="{{ __('Moderate') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
											</svg>
										</button>
									</a>

									<div class="inline-block" wire:key="moderation-{{ $moderation->id }}-{{ $moderations->currentPage() }}">
										<x-admin.moderations.history :moderation="$moderation" />
									</div>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="11" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
								{{ __('No result for this search') }}
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	<div class="mt-8 px-5 py-6 bg-white shadow-sm rounded-md">
		{{ $moderations->links() }}
	</div>
</div>
