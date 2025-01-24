<div>
	{{-- Flash message --}}
	@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
		<div class="py-5 px-4 lg:px-6 max-w-[1440px]" x-data="{}" x-ref="alert">
			@include('components.front.home.alert-message')
		</div>
	@endif

	<div class="flex justify-between items-center mb-4 py-5 px-4 lg:px-6">
		<x-front.space.space-title>
			@if($post->id)
				{{ __('Edit post') }}
			@else
				{{ __('Create a post') }}
			@endif
		</x-front.space.space-title>

		<x-front.tertiary-button :class="'mb-4'" x-data="" x-on:click="window.location.href='{{ route('rates.index', ['compositionId' => 32]) }}';">
			{{ __('Buy more credits') }}
		</x-front.tertiary-button>
	</div>

	<div x-data="{isSelected: ''}" class="py-5 px-4 lg:px-6">
		@if($post->id)
			@if($post->state->color() == 'green')
				<span class="text-sm gray">
					{{ __('Since your post is already published, the previous credit has been used. Be aware that changing the offer of post will unpublish it. You\'ll have to publish it again, therefor consuming your new offer\'s credit') }}.
				</span>
				<br />
			@endif
		@endif

		<span class="text-sm gray">
			{{ __('If you don\'t have any credits, please select an offer type and fill up the post form') }}.
			{{ __('The payment occurs when you publish a post (as well as for posts packs)') }}.
		</span>

		<div class="flex flex-col items-center my-4">
			<div class="flex flex-row">
				<x-input-label for="thematic_id" :value="__('Our sectors')" />
			</div>

			<select name="thematic_id" wire:model="thematic_id" wire:change="selectedThematic" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
				@foreach($thematics as $thematic)
					<option class="focus:bg-mnw-blue" value="{{ $thematic->id }}">
						{{ ucfirst($thematic->slug) }}
					</option>
				@endforeach
			</select>
		</div>

		{{-- Offers : Web --}}
		@if($offersWeb->isNotEmpty())
			<div class="flex flex-col items-center my-4">
				<svg width="47" height="37" viewBox="0 0 47 37" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path id="Vector" d="M43.8782 14.7435H34.9505C33.9385 14.7435 33.118 15.5639 33.118 16.5759V34.1676C33.118 35.1796 33.9385 36 34.9505 36H43.8782C44.8902 36 45.7106 35.1796 45.7106 34.1676V16.5759C45.7106 15.5639 44.8902 14.7435 43.8782 14.7435Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_2" d="M45.7109 18.4083H33.2502" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_3" d="M45.7109 32.3347H33.2502" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_4" d="M18.954 29.4032L17.488 36.0001H27.0168L25.5508 29.4032" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_5" d="M14.5585 35.9999H29.9511" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
					<path id="Vector_6" d="M43.5129 11.8115V2.83246C43.5129 1.82094 42.6919 1 41.6804 1H2.83245C1.82094 1 1 1.82094 1 2.83246V27.5707C1 28.5822 1.82094 29.4031 3.19894 29.4031H30.3192" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
					<path id="Vector_7" d="M30.3216 25.7557C30.7358 25.7557 31.0716 25.4199 31.0716 25.0057C31.0716 24.5915 30.7358 24.2557 30.3216 24.2557V25.7557ZM30.3216 24.2557H1.73535V25.7557H30.3216V24.2557Z" fill="black" />
				</svg>

				<h2 class="text-xl font-bold">
					{{ __('Web') }}
				</h2>

				<p>
					<span class="font-bold">
						{{ __(':x month', ['x' => 1]) }}
					</span>

					{{ __('of publication') }}
				</p>
			</div>

			<div class="flex flex-row justify-around flex-wrap mb-5" wire:key="{{ rand() }}">
				@foreach($offersWeb as $offer)
					@php
						$options = $offer->options;
						$dateEnd = null;
						$remaining = Auth::guard('web')->user()->countCreditAvailable($offer->slug);
						$subscription = Auth::guard('web')->user()->hasOfferSubscription($offer->slug);

						if(!(empty($subscription))) $dateEnd = Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y');

						if ($remaining > 1) $sentence = __('You have :var credits', ['var' => $remaining]);
						else $sentence = __('You have :var credit', ['var' => $remaining]);

						$color = '';
						$bg = '';
						$text = '';
						switch ($offer->slug) {
							case '':
								$color = 'text-mnw-blue';
								$bg_primary = 'bg-mnw-blue';
								$border = 'border-mnw-blue';
								$bg_secondary = 'bg-mnw-lightblue';
								break;
							case '':
								$color = 'text-mnw-violet';
								$bg_primary = 'bg-mnw-violet';
								$border = 'border-mnw-violet';
								$bg_secondary = 'bg-mnw-lighterviolet';
								break;
							case '':
								$color = 'text-mnw-green';
								$bg_primary = 'bg-mnw-green';
								$border = 'border-mnw-green';
								$bg_secondary = 'bg-mnw-lightergreen';
								break;
							case '':
								$color = 'text-mnw-blue';
								$bg_primary = 'bg-mnw-blue';
								$border = 'border-mnw-blue';
								$bg_secondary = 'bg-mnw-lightblue';
								break;
							case '':
								$color = 'text-mnw-violet';
								$bg_primary = 'bg-mnw-violet';
								$border = 'border-mnw-violet';
								$bg_secondary = 'bg-mnw-lighterviolet';
								break;
							default:
								$color = 'text-mnw-blue';
								$bg_primary = 'bg-mnw-blue';
								$border = 'border-mnw-blue';
								$bg_secondary = 'bg-mnw-lightblue';
								break;
						}
					@endphp

					<div class="flex flex-col w-[220px] shadow-md rounded-md mb-4">
						<div class="flex flex-col {{ $bg_primary }} items-center w-full py-4 rounded-t-md">
							<p class="text-white font-medium">
								{{ __('Post') }}
							</p>

							<h2 class="text-lg font-bold text-white">
								{{ $offer->name }}
							</h2>
						</div>

						<div class="p-4 flex flex-col items-center" x-data="{ toggleOption{{ $offer->id }}: false }">
							<div class="flex text-sm mb-2 cursor-pointer" x-on:click="toggleOption{{ $offer->id }} = ! toggleOption{{ $offer->id }}">
								{{ __('Show the details') }}

								<svg x-show="toggleOption{{ $offer->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
								</svg>

								<svg x-show="!toggleOption{{ $offer->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
								</svg>
							</div>

							<div x-show="toggleOption{{ $offer->id }}" x-transition.scale.80 class="w-full">
								@foreach($options as $option)
									<p class="flex shrink-0 items-center">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 text-{{ $color }} mr-2 w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
										</svg>

										<span class="text-sm">
											{{ $option->name }}
										</span>
									</p>
								@endforeach
							</div>

							<hr class="w-full border border-gray-100 my-2">

							<div class="my-2 border w-full flex justify-center items-center rounded-md h-[60px] p-2" x-bind:class="{'{{ $border }} {{ $bg_secondary }}':isSelected=={{ $offer->id }}, 'border-gray-300 bg-gray-200':isSelected!={{ $offer->id }}}">
								@switch($remaining)
									@case(0)
										<div class="flex flex-row justify-between w-full">
											<span class="font-bold {{ $text }}">
												{{ $remaining }} {{ __('post') }}
											</span>
										</div>
									@break

									@default
										<div class="flex flex-col">
											<span class="font-bold">
												{{ ($remaining > 1) ? __(':x remaning posts', ['x' => $remaining]) : __(':x remaining post', ['x' => $remaining]) }}
											</span>

											<p class="text-xs">
												{{ __('Available until :x', ['x' => (isset($dateEnd)) ? __($dateEnd) : __('date unavailable')]) }}
											</p>
										</div>
								@endswitch
							</div>

							<input type="radio" name="offer_id" value="{{ $offer->id }}" x-on:click="isSelected = {{ $offer->id }}" wire:model="offer_id" class="disabled:bg-gray-200 my-4 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-4 h-4" />
						</div>
					</div>
				@endforeach
			</div>
		@endif

		{{-- Offers : Web + Print --}}
		@if($offersPrint->isNotEmpty())
			<div class="flex flex-col items-center mt-8 mb-4">
				<svg width="104" height="37" viewBox="0 0 104 37" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path id="Vector" d="M68.8622 1V27.2489L86.0546 36V14.1255V9.75111L68.8622 1Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_2" d="M82.1875 13.4052L72.7283 8.74664" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_3" d="M82.1875 18.0641L72.7283 13.4055" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_4" d="M82.1875 22.723L72.7283 18.0644" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_5" d="M103.247 1V27.2489L86.0546 36V14.1255V9.75111L103.247 1Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_6" d="M89.9207 13.4052L99.3799 8.74664" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_7" d="M89.9207 18.0641L99.3799 13.4055" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_8" d="M89.9207 22.723L99.3799 18.0644" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_9" d="M57.2372 13.2499V21.9999" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_10" d="M52.8622 17.6249H61.6122" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					<path id="Vector_11" d="M43.8782 14.7434H34.9505C33.9385 14.7434 33.118 15.5638 33.118 16.5758V34.1674C33.118 35.1794 33.9385 35.9998 34.9505 35.9998H43.8782C44.8902 35.9998 45.7106 35.1794 45.7106 34.1674V16.5758C45.7106 15.5638 44.8902 14.7434 43.8782 14.7434Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_12" d="M45.7109 18.4082H33.2502" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_13" d="M45.7109 32.3345H33.2502" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_14" d="M18.954 29.403L17.488 35.9999H27.0168L25.5508 29.403" stroke="black" stroke-width="1.5" stroke-miterlimit="10" />
					<path id="Vector_15" d="M14.5585 35.9997H29.9511" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
					<path id="Vector_16" d="M43.5129 11.8115V2.83245C43.5129 1.82094 42.6919 1 41.6804 1H2.83245C1.82094 1 1 1.82094 1 2.83245V27.5705C1 28.582 1.82094 29.403 3.19894 29.403H30.3192" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
					<path id="Vector_17" d="M30.3216 25.7555C30.7358 25.7555 31.0716 25.4197 31.0716 25.0055C31.0716 24.5913 30.7358 24.2555 30.3216 24.2555V25.7555ZM30.3216 24.2555H1.73535V25.7555H30.3216V24.2555Z" fill="black" />
				</svg>

				<h2 class="text-xl font-bold">
					{{ __('Web + Print') }}
				</h2>

				<p>
					<span class="font-bold">
						{{ __(':x months', ['x' => 2]) }}
					</span>

					{{ __('of web publication') }}
				</p>

				<p>
					<span class="font-bold">
						{{ __(':x month', ['x' => 1]) }}
					</span>

					{{ __('of print publication from') }}

					@if($this->dateParution['status'] == 'Success')
						<span class="text-mnw-blue font-bold">
							{{ $dateParution['value'] }}
						</span>
						({{ __('Number of :x', ['x' => __(Carbon\Carbon::createFromFormat('d/m/Y', $dateParution['value'])->format('F'))]) }})
					@else
						... ({{ __('date temporarily unavailable') }})
					@endif
				</p>

				<p class="italic text-xs">
					{{ __('Subject to publication today') }}
				</p>
			</div>

			<div class="flex flex-row justify-around flex-wrap" wire:key="{{ rand() }}">
				<div class="flex flex-col w-[290px] shadow-md rounded-md mb-4">
					<div class="flex flex-col bg-mnw-blue items-center w-full py-4 rounded-t-md">
						<p class="text-white font-medium">
							{{ __('Post') }}
						</p>

						<h2 class="text-xl font-bold text-white">
							{{ __('Standard') }}
						</h2>
					</div>

					@foreach($offersPrint as $key => $offer)
						@php
							$options = $offer->options;
							$dateEnd = null;
							$remaining = Auth::guard('web')->user()->countCreditAvailable($offer->slug);
							$subscription = Auth::guard('web')->user()->hasOfferSubscription($offer->slug);

							if($subscription) $dateEnd = Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y');

							if ($remaining > 1) $sentence = __('You have :var credits', ['var' => $remaining]);
							else $sentence = __('You have :var credit', ['var' => $remaining]);
						@endphp

						@if($loop->first)
							<div class="p-4 flex flex-col items-center" x-data="{ toggleOption{{ $offer->id }}: false }">
								<div class="flex text-sm mb-2 cursor-pointer" x-on:click="toggleOption{{ $offer->id }} = ! toggleOption{{ $offer->id }}">
									{{ __('Show the details') }}

									<svg x-show="toggleOption{{ $offer->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 w-6 h-6">
										<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
									</svg>

									<svg x-show="!toggleOption{{ $offer->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 w-6 h-6">
										<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
									</svg>
								</div>

								<div x-show="toggleOption{{ $offer->id }}" x-transition.scale.80>
									@foreach($options as $option)
										@if(!$loop->last)
											<p class="flex shrink-0 items-center">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 text-{{ $color }} mr-2 w-4 h-4">
													<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
												</svg>

												<span class="text-sm">
													{{ $option->name }}
												</span>
											</p>
										@endif
									@endforeach
								</div>

								<hr class="w-full border border-gray-100 my-2">

								<p class="font-bold mt-4">
									{{ __('Select a size') }} :
								</p>
							</div>
						@endif

						<div class="p-4 flex flex-col items-center">
							<div class="my-2 border w-full flex justify-between items-center rounded-md h-[100px] p-2" x-bind:class="{'border-mnw-blue bg-mnw-lightblue':isSelected=={{ $offer->id }}, 'border-gray-300 bg-gray-200':isSelected!={{ $offer->id }}}">
								<div class="flex flex-col w-full">
									<div class="flex flex-row items-center">
										<input type="radio" name="offer_id" value="{{ $offer->id }}" x-on:click="isSelected = {{ $offer->id }}" wire:model="offer_id" class="disabled:bg-gray-200 my-4 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-4 h-4 mr-2" />

										<label class="text-mnw-blue font-bold">
											{{ $offer->name }}
										</label>
									</div>

									<span class="font-bold">
										{{ ($remaining > 1) ? __(':x remaning posts', ['x' => $remaining]) : __(':x remaining post', ['x' => $remaining]) }}
									</span>

									@if($remaining > 0)
										<p class="text-xs">
											{{ __('Available until :x', ['x' => (isset($dateEnd)) ? __($dateEnd) : __('date unavailable')]) }}
										</p>
									@endif
								</div>

								<div>
									@if(Illuminate\Support\Str::contains($offer->slug, '14-de-colonne'))
										<svg width="55" height="76" viewBox="0 0 55 76" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g id="ic_format_1">
												<rect id="Rectangle 83" x="0.5" y="0.5" width="53.625" height="75" fill="white" stroke="#E8E8E8"></rect>
												<rect id="Rectangle 84" x="3.5625" y="7.125" width="15.4375" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 91" x="3.5625" y="40.375" width="15.4375" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 92" x="36.8125" y="40.375" width="14.25" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 85" x="20.1875" y="7.125" width="15.4375" height="65.3125" fill="#E8E8E8"></rect>
												<rect id="Rectangle 86" x="36.8125" y="7.125" width="14.25" height="15.4375" fill="#E8E8E8"></rect>
												<rect id="Rectangle 90" x="36.8125" y="23.75" width="14.25" height="15.4375" fill="#005586"></rect>
											</g>
										</svg>
									@elseif(Illuminate\Support\Str::contains($offer->slug, '12-colonne'))
										<svg width="56" height="76" viewBox="0 0 56 76" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect id="Rectangle 83" x="1.1875" y="0.5" width="53.625" height="75" fill="white" stroke="#E8E8E8" />
											<rect id="Rectangle 84" x="4.25" y="7.125" width="15.4375" height="32.0625" fill="#005586" />
											<rect id="Rectangle 91" x="4.25" y="40.375" width="15.4375" height="32.0625" fill="#E8E8E8" />
											<rect id="Rectangle 92" x="37.5" y="40.375" width="14.25" height="32.0625" fill="#E8E8E8" />
											<rect id="Rectangle 85" x="20.875" y="7.125" width="15.4375" height="65.3125" fill="#E8E8E8" />
											<rect id="Rectangle 86" x="37.5" y="7.125" width="14.25" height="15.4375" fill="#E8E8E8" />
											<rect id="Rectangle 90" x="37.5" y="23.75" width="14.25" height="15.4375" fill="#E8E8E8" />
										</svg>
									@elseif(Illuminate\Support\Str::contains($offer->slug, '1-colonne'))
										<svg width="55" height="76" viewBox="0 0 55 76" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g id="ic_format_3">
												<rect id="Rectangle 83" x="0.75" y="0.5" width="53.625" height="75" fill="white" stroke="#E8E8E8"></rect>
												<rect id="Rectangle 84" x="3.8125" y="7.125" width="15.4375" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 91" x="3.8125" y="40.375" width="15.4375" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 92" x="37.0625" y="40.375" width="14.25" height="32.0625" fill="#E8E8E8"></rect>
												<rect id="Rectangle 85" x="20.4375" y="7.125" width="15.4375" height="65.3125" fill="#005586"></rect>
												<rect id="Rectangle 86" x="37.0625" y="7.125" width="14.25" height="15.4375" fill="#E8E8E8"></rect>
												<rect id="Rectangle 90" x="37.0625" y="23.75" width="14.25" height="15.4375" fill="#E8E8E8"></rect>
											</g>
										</svg>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif

		<div class="flex flex-row justify-center items-center">
			@error('offer_id')
				<span class="error text-danger-700">
					{{ $message }}
				</span>
			@enderror
		</div>

		<div class="flex items-center justify-end mt-4 mr-7">
			<a href="{{ route('space.posts.my-posts') }}">
				<x-secondary-button>
					{{ __('Cancel') }}
				</x-secondary-button>
			</a>

			<x-primary-button :class="'ml-4'" wire:click="submitForm">
				{{ __('Use this offer') }}
			</x-primary-button>
		</div>
	</div>
</div>
