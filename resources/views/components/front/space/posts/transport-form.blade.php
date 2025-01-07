<div>
	<div>
		<div class="flex flex-row">
			<x-front.input-label for="post.post_type_id" :value="__('Which post type would you like to create').' ?'" />
		</div>

		<select name="post.post_type_id" wire:model.live="post.post_type_id" wire:change="postTypeSelected" @disabled(($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false) class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
			<option value="">{{ __('Choose a post type') }}</option>
			@foreach($postTypes as $postType)
				<option value="{{ $postType->id }}" wire:key="post-type-{{ $postType->id }}">
					{{ $postType->name }}
				</option>
			@endforeach
		</select>

		@error('post.post_type_id')
			<span class="error text-danger-700">
				{{ $message }}
			</span>
		@enderror

		@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
			<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
				{{ __('This field can only be modified on justification with the customer service') }}
			</div>
		@endif
	</div>

	<div style="padding:0 0 0 40px;">
		<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
			@if($post->postType)
				@if($post->postType->slug == 'tractionnaire')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.tractor_type" :value="__('Tractor type')" />
						</div>

						<select name="post.values_web.tractor_type" wire:model="post.values_web.tractor_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a tractor type') }}</option>
							@foreach($criterias['tractor-type'] as $tractorType)
								<option value="{{ $tractorType->id }}" wire:key="tractor-type-{{ $tractorType->id }}">
									{{ $tractorType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.tractor_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@endif

				<div>
					<div class="flex flex-row">
						@if($post->postType->slug == 'appel-offre')
							<x-front.input-label for="post.title" :value="__('Title of the tender')" :required="true" />
						@else
							<x-front.input-label for="post.title" :value="__('Post title')" :required="true" />
						@endif
					</div>

					@if($post->postType->slug == 'appel-offre')
						<x-front.text-input name="post.title" wire:model="post.title" :disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false" placeholder="{{ __('Title of the tender') }}" :class="'mt-1 block bg-white w-full'" />
					@else
						<x-front.text-input name="post.title" wire:model="post.title" :disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false" placeholder="{{ __('Post title') }}" :class="'mt-1 block bg-white w-full'" />
					@endif

					@error('post.title')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror

					@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
						<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
							{{ __('This field can only be modified on justification with the customer service') }}
						</div>
					@endif
				</div>

				@if($post->postType->slug == 'vente-vehicule' || $post->postType->slug == 'achat-location-vehicule')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.vehicule_type" :value="__('Vehicule type')" :required="true" />
						</div>

						@foreach($criterias['vehicule-type'] as $vehiculeType)
							<div wire:key="vehicule-type-{{ $vehiculeType->id }}" class="pr-5">
								<input type="radio" name="post.values_web.vehicule_type" value="{{ $vehiculeType->id }}" wire:model.live="post.values_web.vehicule_type" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
								<label class="text-sm inline-block">
									{{ $vehiculeType->name }}
								</label>
							</div>
						@endforeach

						@error('post.values_web.vehicule_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.brand" :value="__('Brand')" />
						</div>

						<x-front.text-input name="post.values_web.brand" wire:model="post.values_web.brand" placeholder="{{ __('Brand') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.brand')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.model" :value="__('Model')" />
						</div>

						<x-front.text-input name="post.values_web.model" wire:model="post.values_web.model" placeholder="{{ __('Model') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.model')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					@if($post->postType->slug == 'vente-vehicule')
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="post.values_web.commissioning_year" :value="__('Commissioning year')" />
							</div>

							<x-front.text-input type="number" name="post.values_web.commissioning_year" wire:model="post.values_web.commissioning_year" placeholder="{{ __('Commissioning year') }}" :class="'mt-1 block bg-white w-full'" />

							@error('post.values_web.commissioning_year')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div>
							<div class="flex flex-row">
								<x-front.input-label for="post.values_web.mileage" :value="__('Mileage')" />
							</div>

							<x-front.text-input type="number" name="post.values_web.mileage" wire:model="post.values_web.mileage" placeholder="{{ __('Mileage') }}" :class="'mt-1 block bg-white w-full'" />

							@error('post.values_web.mileage')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@elseif($post->postType->slug == 'achat-location-vehicule')
						<div>
							<livewire:front.space.posts.availabilities
								:post="$post"
								:canDelete="true"
								:disabled="false"
								:wire:key="'availabilities-'.$post->id" />

							<div class="flex flex-row text-sm text-mnw-gray">
								{{ __('Select a starting date and an ending date to create an availability period. Click on an existing period to delete it') }}.
							</div>
						</div>
					@endif
				@elseif($post->postType->slug == 'transaction-entreprise')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.sector" :value="__('Sector')" :required="true" />
						</div>

						<select name="post.values_web.sector" wire:model="post.values_web.sector" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a sector') }}</option>
							@foreach($criterias['sector'] as $sector)
								<option value="{{ $sector->id }}" wire:key="sector-{{ $sector->id }}">
									{{ $sector->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.sector')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.activity_type" :value="__('Activity type')" :required="true" />
						</div>

						<select name="post.values_web.activity_type" wire:model="post.values_web.activity_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a sector') }}</option>
							@foreach($criterias['activity-type'] as $activityType)
								<option value="{{ $activityType->id }}" wire:key="activity-{{ $activityType->id }}">
									{{ $activityType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.activity_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@elseif($post->postType->slug == 'offre-immobiliere')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.good_type" :value="__('Good type')" :required="true" />
						</div>

						<select name="post.values_web.good_type" wire:model="post.values_web.good_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a good type') }}</option>
							@foreach($criterias['good-type'] as $goodType)
								<option value="{{ $goodType->id }}" wire:key="good-type-{{ $goodType->id }}">
									{{ $goodType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.good_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@elseif($post->postType->slug == 'appel-offre')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.market_spectrum" :value="__('Market spectrum')" :required="true" />
						</div>

						<select name="post.values_web.market_spectrum" wire:model="post.values_web.market_spectrum" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a market spectrum') }}</option>
							@foreach($criterias['market-spectrum'] as $marketSpectrum)
								<option value="{{ $marketSpectrum->id }}" wire:key="market-spectrum-{{ $marketSpectrum->id }}">
									{{ $marketSpectrum->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.market_spectrum')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.market_type" :value="__('Market type')" :required="true" />
						</div>

						<select name="post.values_web.market_type" wire:model="post.values_web.market_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a market type') }}</option>
							@foreach($criterias['market-type'] as $marketType)
								<option value="{{ $marketType->id }}" wire:key="market-type-{{ $marketSpectrum->id }}">
									{{ $marketType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.market_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.notice_type" :value="__('Notice type')" />
						</div>

						<select name="post.values_web.notice_type" wire:model="post.values_web.notice_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a notice type') }}</option>
							@foreach($criterias['notice-type'] as $noticeType)
								<option value="{{ $noticeType->id }}" wire:key="notice-type-{{ $noticeType->id }}">
									{{ $noticeType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.market_spectrum')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.closing_date" :value="__('Closing date')" />
						</div>

						<x-front.text-input type="date" name="post.values_web.closing_date" wire:model="post.values_web.closing_date" min="{{ \Carbon\Carbon::now() }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.closing_date')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@endif

				{{-- Description --}}
				<div>
					<div class="flex flex-row">
						@if($post->postType->slug == 'appel-offre')
							<x-front.input-label for="post.body" :value="__('Call for tenders')" :required="true" />
						@else
							<x-front.input-label for="post.body" :value="__('Post description')" :required="true" />
						@endif
					</div>

					<div wire:ignore>
						@if($post->postType->slug == 'appel-offre')
							<textarea id="body" wire:model="post.body" placeholder="{{ __('Call for tender\'s text') }}" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full">{{ $post->body }}</textarea>
						@else
							<textarea id="body" wire:model="post.body" placeholder="{{ __('Write here the post\'s description') }}" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full">{{ $post->body }}</textarea>
						@endif
					</div>

					@error('post.body')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				@if($post->postType->slug == 'transaction-entreprise')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.revenue" :value="__('Revenue')" />
						</div>

						<x-front.text-input type="number" name="post.values_web.revenue" wire:model="post.values_web.revenue" placeholder="{{ __('Revenue') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.revenue')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.workforce" :value="__('Workforce')" />
						</div>

						<x-front.text-input type="number" name="post.values_web.workforce" wire:model="post.values_web.workforce" placeholder="{{ __('Workforce') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.workforce')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.recovery_date" :value="__('Date of the desired recovery')" />
						</div>

						<x-front.text-input type="date" name="post.values_web.recovery_date" wire:model="post.values_web.recovery_date" placeholder="{{ __('Date of the desired recovery') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.recovery_date')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.support" :value="__('Possible support')" :required="true" />
						</div>

						<div class="pr-5">
							<input type="radio" name="post.values_web.support" value="yes" wire:model.live="post.values_web.support" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
							<label class="text-sm inline-block">
								{{ __('Yes') }}
							</label>
						</div>

						<div class="pr-5">
							<input type="radio" name="post.values_web.support" value="no" wire:model.live="post.values_web.support" class="mr-1 disabled:bg-gray-200 my-1 checked:bg-mnw-blue checked:hover:bg-mnw-blue checked:active:bg-mnw-blue checked:focus:bg-mnw-blue focus:bg-mnw-blue focus:outline-none focus:ring-1 focus:ring-mnw-blue w-5 h-5" />
							<label class="text-sm inline-block">
								{{ __('No') }}
							</label>
						</div>

						@error('post.values_web.support')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					@if(isset($post->values_web['support']) && $post->values_web['support'] == 'yes')
						<div>
							<div class="flex flex-row">
								<x-front.input-label for="post.values_web.support_description" :value="__('Support description')" />
							</div>

							<x-front.text-input name="post.values_web.support_description" wire:model="post.values_web.support_description" placeholder="{{ __('Support description') }}" :class="'mt-1 block bg-white w-full'" />

							@error('post.values_web.support_description')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif
				@elseif($post->postType->slug == 'offre-immobiliere')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="characteristics" :value="__('Characateristics')" />
						</div>

						@foreach($criterias['characteristics'] as $characteristic)
							<div wire:key="characteristics-{{ $characteristic->id }}">
								<input type="checkbox" id="characteristics" name="characteristics" value="{{ $characteristic->id }}" wire:model="characteristics" class="w-4 h-4 text-mnw-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
								<x-front.input-label for="characteristics" :value="$characteristic->name" :class="'ml-2 inline-block font-normal'"/>
							</div>
						@endforeach

						@error('characteristics')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.surface" :value="__('Surface in m²')" />
						</div>

						<x-front.text-input type="number" name="post.values_web.surface" wire:model="post.values_web.surface" placeholder="{{ __('Surface in m²') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.surface')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.floors" :value="__('Number of floors')" />
						</div>

						<x-front.text-input type="number" name="post.values_web.floors" wire:model="post.values_web.floors" placeholder="{{ __('Number of floors') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.floors')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.parking" :value="__('Number of parking spaces')" />
						</div>

						<x-front.text-input type="number" name="post.values_web.parking" wire:model="post.values_web.parking" placeholder="{{ __('Number of parking spaces') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.parking')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.construction_year" :value="__('Construction year')" />
						</div>

						<x-front.text-input name="post.values_web.construction_year" wire:model="post.values_web.construction_year" placeholder="{{ __('Construction year') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.construction_year')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.energy_class" :value="__('Energy class')" />
						</div>

						<select name="post.values_web.energy_class" wire:model="post.values_web.energy_class" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose an energy class') }}</option>
							@foreach($criterias['energy-class'] as $energyClass)
								<option value="{{ $energyClass->id }}" wire:key="energy-class-{{ $energyClass->id }}">
									{{ $energyClass->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.energy_class')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.ges" :value="__('GES')" />
						</div>

						<select name="post.values_web.ges" wire:model="post.values_web.ges" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a GES') }}</option>
							@foreach($criterias['GES'] as $ges)
								<option value="{{ $ges->id }}" wire:key="ges-{{ $ges->id }}">
									{{ $ges->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.ges')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@elseif($post->postType->slug == 'tractionnaire')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.remuneration" :value="__('Proposed or desired remuneration')" />
						</div>

						<x-front.text-input name="post.values_web.remuneration" wire:model="post.values_web.remuneration" placeholder="{{ __('Proposed or desired remuneration') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.remuneration')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.desired_profile" :value="__('Desired profile')" />
						</div>

						<textarea name="post.values_web.desired_profile" wire:model="post.values_web.desired_profile" placeholder="{{ __('Desired profile') }}" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full"></textarea>

						@error('post.values_web.desired_profile')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@endif

				{{-- Price --}}
				@if($post->postType->slug != 'appel-offre' && $post->postType->slug != 'tractionnaire')
					<div>
						<div class="flex flex-row">
							@if($post->postType->slug == 'achat-location-vehicule')
								<x-front.input-label for="post.values_web.price" :value="__('Rental price / day')" :required="true" />
							@elseif($post->postType->slug == 'transaction-entreprise')
								<x-front.input-label for="post.values_web.price" :value="__('Transfer pricing')" :required="true" />
							@else
								<x-front.input-label for="post.values_web.price" :value="__('Selling price')" :required="true" />
							@endif
						</div>

						@if($post->postType->slug == 'achat-location-vehicule')
							<x-front.text-input type="number" name="post.values_web.price" wire:model="post.values_web.price" placeholder="{{ __('Rental price / day') }}" :class="'mt-1 block bg-white w-full'" />
						@elseif($post->postType->slug == 'transaction-entreprise')
							<x-front.text-input type="number" name="post.values_web.price" wire:model="post.values_web.price" placeholder="{{ __('Transfer pricing') }}" :class="'mt-1 block bg-white w-full'" />
						@else
							<x-front.text-input type="number" name="post.values_web.price" wire:model="post.values_web.price" placeholder="{{ __('Selling price') }}" :class="'mt-1 block bg-white w-full'" />
						@endif

						@if($post->postType->slug == 'achat-location-vehicule')
							<span class="text-sm text-mnw-gray">
								{{ __('If you post a request, please fill in the price you are willing to pay for the rental') }}.
							</span>
						@elseif($post->postType->slug != 'transaction-entreprise')
							<span class="text-sm text-mnw-gray">
								{{ __('If you post a request, please fill in the price you are willing to pay for the purchase') }}.
							</span>
						@endif

						@error('post.values_web.price')
							<div class="flex flex-row">
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							</div>
						@enderror
					</div>
				@endif

				{{-- Photos --}}
				<div class="flex flex-col mt-5">
					<div class="italic text-sm gray mt-2">
						<p>
							{{ __('These images are used to illustrate your post') }}.
						</p>

						<p class="mt-4">
							{{ __('The first image (marked with the star) is your post banner and main image') }}.
							{{ __('You can change your banner image (and thus reorder your images display) by clicking on the star') }}.
						</p>

						<p class="mt-4">
							{{ __('You can insert').' '.trans_choice('{1} :nb image|[2,*] up to :nb images', $maxPhotos, ['nb' => $maxPhotos]) }}.
						</p>
					</div>

					<livewire:uploader
						:max_medias="$maxPhotos"
						:first_is_main="true"
						:main_label="'[ '.__('Banner').' ]'"
						:class="\App\Models\Post::class"
						:model_id="$post->id"
						:collection="'photos'"
						:grid_class="'mt-6 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-4'"
						:aspect_ratio="'aspect-video'"
						:object_fit="'object-cover'"
						:wire:key="'photos-'.$post->postType->id" />
				</div>

				{{-- Adresse --}}
				@if($post->postType->slug == 'achat-location-vehicule')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="startingAddress" :value="__('Starting address')" :required="true" />
						</div>

						<livewire:address
							:address="$startingAddress"
							:city_required="true"
							:country_required="true"
							:additionnal_2="false"
							:dispatchName="'starting-address-selected'"
							:disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false"
							:wire:key="'starting-address-'.$post->postType->id" />

						@error('startingAddress.city_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('startingAddress.custom_city')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('startingAddress.country_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
							<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
								{{ __('This field can only be modified on justification with the customer service') }}
							</div>
						@endif
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="returnAddress" :value="__('Return address')" :required="true" />
						</div>

						<livewire:address
							:address="$returnAddress"
							:city_required="true"
							:country_required="true"
							:additionnal_2="false"
							:dispatchName="'return-address-selected'"
							:disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false"
							:wire:key="'return-address-'.$post->postType->id" />


						@error('returnAddress.city_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('returnAddress.custom_city')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('returnAddress.country_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
							<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
								{{ __('This field can only be modified on justification with the customer service') }}
							</div>
						@endif
					</div>
				@elseif($post->postType->slug != 'appel-offre')
					<div>
						<div class="flex flex-row">
							@if($post->postType->slug == 'materiel' || $post->postType->slug == 'piece-rechange' || $post->postType->slug == 'offre-immobiliere')
								<x-front.input-label for="address" :value="__('Good\'s address')" :required="true" />
							@elseif($post->postType->slug == 'transaction-entreprise' || $post->postType->slug == 'tractionnaire')
								<x-front.input-label for="address" :value="__('Structure\'s address')" :required="true" />
							@elseif($post->postType->slug == 'vente-vehicule')
								<x-front.input-label for="address" :value="__('Vehicule\'s address')" :required="true" />
							@endif
						</div>

						<livewire:address
							:address="$address"
							:city_required="true"
							:country_required="true"
							:additionnal_2="false"
							:disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false"
							:wire:key="'address-'.$post->postType->id" />

						@error('address.city_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.custom_city')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.country_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
							<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
								{{ __('This field can only be modified on justification with the customer service') }}
							</div>
						@endif
					</div>
				@endif
			@endif
		</div>
	</div>

	@push('scripts')
		<script src="{!! asset('js/ckeditor.js') !!}"></script>
		<script>
			var ckEditorInstance = null;
			const postTypeSelect = document.querySelector("select[name='post.post_type_id']");

			function initClassicEditor() {
				if(ckEditorInstance == null) {
					ClassicEditor
					.create(document.querySelector('#body'), {
						// Editor configuration.
						simpleUpload: {
							// Feature configuration.

							// The URL that the images are uploaded to.
							uploadUrl: "{{ route('space.posts.upload') }}",
						},
						style: {
							definitions: [
								// Styles definitions.
								{
									name: 'Article category',
									element: 'h3',
									classes: [ 'category' ]
								},
								{
									name: 'Title',
									element: 'h2',
									classes: [ 'document-title' ]
								},
								// ...
								{
									name: 'Texte rouge',
									element: 'span',
									classes: [ 'text-red' ]
								},
							]
						}
					})
					.then(editor => {
						ckEditorInstance = editor;

						editor.model.document.on('change:data', () => {
							@this.set('post.body', editor.getData());
						});
					})
					.catch(error => {
						console.error(error);
					});
				}
				else {
					ckEditorInstance.destroy();
					ckEditorInstance = null;

					setTimeout(function() {
						initClassicEditor();
					}, 500);
				}
			};

			window.addEventListener('postTypeChanged', event => {
				initClassicEditor();
			});

			initClassicEditor();
		</script>
	@endpush
</div>
