<div>
	<div class="mb-5 text-sm sm:text-base lg:text-xl">
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap max-w-[936px]">
			<select id="author" wire:model="author" class="rounded border border-gray-400 text-gray-400">
				<option value="">{{ __('Select a registered') }}</option>
				@foreach($users as $user)
					<option value="{{ $user->id}}">{{ $user->name }}</option>
				@endforeach
			</select>

			<select id="post_type" wire:model="post_type" class="rounded border border-gray-400 text-gray-400">
				<option value="">{{ __('Select a post type') }}</option>
				@foreach($postTypes as $postType)
					<option value="{{ $postType->id}}">{{ $postType->name }}</option>
				@endforeach
			</select>

			<select id="state" wire:model="state" class="rounded border border-gray-400 text-gray-400">
				<option value="">{{ __('Select a post state') }}</option>
				<option value="{{ \App\Enums\PostStatesEnum::Draft }}">{{ __('Draft') }}</option>
				<option value="{{ \App\Enums\PostStatesEnum::Pending }}">{{ __('Pending') }}</option>
				<option value="{{ \App\Enums\PostStatesEnum::Archived }}">{{ __('Archived') }}</option>
				<option value="{{ \App\Enums\PostStatesEnum::Published }}">{{ __('Published') }}</option>
			</select>

			<div class="bg-white border-b border-gray-400 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
					<input type="text" wire:model="keyword" name="keyword" id="keyword" placeholder="{{ __('Keyword(s)') }}" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>
		</div>
	</div>

	<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
		<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
			<table class="min-w-full">
				<thead>
					<tr>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Id') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Status') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Published at') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Refreshed at') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Expire on') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Title') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Post type') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Offer') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Company') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Author') }}</th>
						<th class="px-2 py-2 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 tracking-wider">{{ __('Action') }}</th>
					</tr>
				</thead>

				<tbody class="bg-white">
					@foreach($posts as $post)
						<tr>
							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $post->id }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								@if($post->state == \App\Enums\PostStatesEnum::Draft)
									<div class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Draft') }}
								@elseif($post->state == \App\Enums\PostStatesEnum::Pending)
									<div class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Pending') }}
								@elseif($post->state == \App\Enums\PostStatesEnum::Archived)
									<div class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Archived') }}
								@elseif($post->state == \App\Enums\PostStatesEnum::Published)
									<div class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"> {{ __('Published') }}
								@endif

								</div>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i:s') }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												@if(!is_null($post->refreshed_at))
													{{ \Carbon\Carbon::parse($post->refreshed_at)->format('d/m/Y H:i:s') }}
												@else
													{{ __('Not refreshed yet') }}
												@endif
											</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												{{ \Carbon\Carbon::parse($post->archived_at)->format('d/m/Y H:i:s') }}
											</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $post->title }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">
												@if($post->offer)
													{{ $post->offer->name }}
												@else
													@php
														$subscription = \App\Models\Subscription::where('user_id', '=', $post->user->id)
															->whereIn('offer_id', [5,6,7,8])
															->first();
													@endphp
													@if($subscription)
														{{ $subscription->offer->name }}
													@else
														{{ __('No offer data found') }}
													@endif
												@endif
											</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $post->type->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="{{ route('companies.show', ['company' => $post->company]) }}" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $post->company->name }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap border-b border-gray-200">
								<a href="" target="_blank">
									<div class="flex items-center">
										<div class="ml-4">
											<div class="text-sm leading-5 font-medium text-gray-900">{{ $post->user->name }}</div>
											<div class="text-sm leading-5 text-gray-500">{{ $post->user->email }}</div>
										</div>
									</div>
								</a>
							</td>

							<td class="px-2 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
								<a href="{{ route('admin.posts.expiration', ['post' => $post]) }}" class="text-white inline-block">
									<button type="button" title="{{ __('Update the post\'s expiration date') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
											<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
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
		{{ $posts->links() }}
	</div>
</div>
