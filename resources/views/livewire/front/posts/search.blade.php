<div class="w-full max-w-[1000px]">
	<div class="max-w-[1000px] {{$displayPost}}">
		<div class="p-3 lg:bg-white lg:shadow-md lg:rounded-full max-sm:w-full">
			<div class="flex flex-col gap-4 sm:max-w-[60%] sm:mx-auto lg:mx-0 lg:max-w-none lg:flex-row max-lg:w-full">
				<div class="bg-white lg:flex-1 rounded-full lg:rounded-none px-2 py-1 lg:p-0 text-annonces-gray w-full lg:border-r-2 lg:pr-4 border-annonces-transparentgray">
					<div x-data="{ open: false }" x-on:click.outside="open=false" x-on:close.stop="open=false" class="flex items-center">
						<svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-2">
							<path d="M9.18835 16.8767C13.7107 16.8767 17.3767 13.2107 17.3767 8.68835C17.3767 4.16605 13.7107 0.5 9.18835 0.5C4.66605 0.5 1 4.16605 1 8.68835C1 13.2107 4.66605 16.8767 9.18835 16.8767Z" stroke="#0082FF" stroke-miterlimit="10"/>
							<path d="M21.0002 20.5002L15.0742 14.5742" stroke="#0082FF" stroke-miterlimit="10" stroke-linecap="round"/>
						</svg>

						<input type="text" name="keyword" wire:model="filters.keyword" @if(!$withRedirect) wire:keydown.debounce.500ms="search" @endif placeholder="{{ __('Search by keyword') }}" x-on:click="open=!open" class="block w-full p-2 text-annonces-gray text-sm bg-transparent border-none focus:ring-0 focus:outline-none cursor-pointer" />

						<div class="absolute z-50 mt-1 w-48 min-w-full rounded-b-md origin-top-right left-0" style="display:none" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"></div>
					</div>
				</div>

				@if(empty($thematic->id))
					<div class="bg-white rounded-full lg:flex-1 px-2 py-1 lg:p-0 lg:rounded-none text-annonces-gray lg:border-r-2 lg:pl-4 border-annonces-transparentgray w-full">
						<select name="filters.post_type_id" wire:model="filters.post_type_id" class="text-annonces-gray text-sm block border-0 focus:border-0 focus:ring-0 rounded-md w-full">
							<option value="">{{ __('Category') }}</option>
							@php
								$groupMade = false;
								$groupId = 0;
							@endphp
							@foreach($fieldAllPostTypes as $fieldAllPostType)
								@php
									if($fieldAllPostType->thematic->id != $groupId) {
										$groupId = $fieldAllPostType->thematic->id;
										$groupMade = false;
									}
								@endphp

								@if(!$groupMade)
									<optgroup label="{{ $fieldAllPostType->thematic->name }}">
										{{ $fieldAllPostType->thematic->name }}
									</optgroup>

									@php
										$groupMade = true;
									@endphp
								@endif
								<option value="{{ $fieldAllPostType->id }}" wire:key="fieldAllPostType-{{ $fieldAllPostType->id }}">
									{{ $fieldAllPostType->name }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="bg-white shadow-md rounded-full lg:flex-1 px-2 py-1 lg:p-0 lg:shadow-none lg:rounded-none text-annonces-gray">
						<div class="relative" x-data="{
								open: false,
								loc: ''
							}" x-on:click.outside="open=false" x-on:close.stop="open=false">
							<div class="absolute inset-y-0 flex items-center pointer-events-none text-annonces-blue">
								<svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-2">
									<path d="M17.682 9.18182C17.682 14.7091 9.50018 21 9.50018 21C9.50018 21 1.31836 14.7091 1.31836 9.18182C1.31836 3.65455 4.982 1 9.50018 1C14.0184 1 17.682 3.65455 17.682 9.18182Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M9.49964 11.909C11.508 11.909 13.136 10.2809 13.136 8.27259C13.136 6.26429 11.508 4.63623 9.49964 4.63623C7.49134 4.63623 5.86328 6.26429 5.86328 8.27259C5.86328 10.2809 7.49134 11.909 9.49964 11.909Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>

							<input type="text" id="loc" x-bind:value="loc" x-on:click="open=!open" readonly placeholder="{{ __('Enter a location') }}" class="block w-full p-1.5 pl-8 text-annonces-gray text-sm bg-transparent border border-transparent focus:border-transparent focus:ring-0 rounded-md"/>

							<div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" style="display:none" class="absolute z-50 mt-1 w-48 min-w-full rounded-b-md shadow-lg origin-top-right left-0">
								<livewire:localisation-search-engine :hideDistance="false" :wire:key="'localisation-search-engine'" />
							</div>
						</div>
					</div>
				@else
					@if($thematic->slug != 'maritime')
						<div class="relative bg-white rounded-full lg:flex-2 px-2 py-1 lg:p-0 lg:rounded-none text-annonces-gray lg:border-r-2 lg:pl-4 border-annonces-transparentgray">
							<select name="filters.post_type_id" wire:model="filters.post_type_id" wire:change="postTypeSelected" class="text-annonces-gray text-sm block border-0 focus:border-0 focus:ring-0 rounded-md w-full">
								<option value="">{{ __('Choose a post type') }}</option>
								@foreach($fieldPostTypes as $fieldPostType)
									<option value="{{ $fieldPostType->id }}" wire:key="fieldPostType-{{ $fieldPostType->id }}">
										{{ $fieldPostType->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="bg-white shadow-md rounded-full lg:flex-1 px-2 py-1 lg:p-0 lg:shadow-none lg:rounded-none text-annonces-gray">
							<div class="relative" x-data="{
									open: false,
									loc: ''
								}" x-on:click.outside="open=false" x-on:close.stop="open=false">
								<div class="absolute inset-y-0 flex items-center pointer-events-none text-annonces-blue">
									<svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-2">
										<path d="M17.682 9.18182C17.682 14.7091 9.50018 21 9.50018 21C9.50018 21 1.31836 14.7091 1.31836 9.18182C1.31836 3.65455 4.982 1 9.50018 1C14.0184 1 17.682 3.65455 17.682 9.18182Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M9.49964 11.909C11.508 11.909 13.136 10.2809 13.136 8.27259C13.136 6.26429 11.508 4.63623 9.49964 4.63623C7.49134 4.63623 5.86328 6.26429 5.86328 8.27259C5.86328 10.2809 7.49134 11.909 9.49964 11.909Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>

								<input type="text" id="loc" x-bind:value="loc" x-on:click="open=!open" readonly placeholder="{{ __('Enter a location') }}" class="block w-full p-1.5 pl-8 text-annonces-gray text-sm bg-transparent border border-transparent focus:border-transparent focus:ring-0 rounded-md"/>

								<div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" style="display:none" class="absolute z-50 mt-1 w-48 min-w-full rounded-b-md shadow-lg origin-top-right left-0">
									<livewire:localisation-search-engine :hideDistance="false" :wire:key="'localisation-search-engine'" />
								</div>
							</div>
						</div>
					@else
						<div class="relative bg-white rounded-full lg:flex-2 px-2 py-1 lg:p-0 lg:rounded-none text-annonces-gray lg:pl-4 border-annonces-transparentgray">
							<select name="filters.good_type_id" wire:model="filters.good_type_id" @if(!$withRedirect) wire:change="search" @endif class="text-annonces-gray text-sm block border-0 focus:border-0 focus:ring-0 rounded-md w-full">
								<option value="">{{ __('Choose a good type') }}</option>
								@foreach($fieldGoodsType as $fieldGoodType)
									<option value="{{ $fieldGoodType->id }}" wire:key="fieldGoodType-{{ $fieldGoodType->id }}">
										{{ $fieldGoodType->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div x-data="{
							tLbl: '{{ str_replace("'", "\\'", __('Starting points')) }}',
							checkEls:function() {
								startingPointsChecked = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}starting_points_checkbox_]:checked');
								this.tLbl = '{{ str_replace("'", "\\'", __('Starting points')) }} '+((startingPointsChecked.length > 0) ? '[ '+startingPointsChecked.length+' ]' : '');
							}
						}" x-init="$nextTick(() => { checkEls() })">
							<div class="relative bg-white rounded-full lg:flex-2 px-2 py-1 lg:p-0 lg:rounded-none text-annonces-gray lg:border-l-2 lg:pl-4 border-jobboard-transparentgray">
								<div class="absolute inset-y-0 flex items-center pointer-events-none text-jobboard-blue z-10">
									<svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.3636 8.68182C17.3636 14.2091 9.18182 20.5 9.18182 20.5C9.18182 20.5 1 14.2091 1 8.68182C1 3.15455 4.66364 0.5 9.18182 0.5C13.7 0.5 17.3636 3.15455 17.3636 8.68182Z" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M9.18129 11.409C11.1896 11.409 12.8176 9.7809 12.8176 7.77259C12.8176 5.76429 11.1896 4.13623 9.18129 4.13623C7.17298 4.13623 5.54492 5.76429 5.54492 7.77259C5.54492 9.7809 7.17298 11.409 9.18129 11.409Z" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>

								<div class="relative" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
									<input type="text" readonly x-on:click="open=!open" x-bind:value="tLbl" class="block w-full p-2 pl-8 text-annonces-gray text-sm bg-white border-none focus:ring-0 focus:outline-none cursor-pointer" />

									<div class="absolute z-50 mt-1 w-48 min-w-fit whitespace-nowrap rounded-b-md shadow-lg origin-top-right left-[-50px] lg:left-0" style="display:none" @form-reset.window="checkEls()" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100">
										<div class="rounded-b-md ring-1 ring-black ring-opacity-5 bg-white p-4 w-[300px] lg:w-full max-h-[225px] lg:max-h-[450px] overflow-auto">
											@foreach ($fieldStartingPoint as $fieldStartingPoint)
												<div wire:key="starting-points-{{ $fieldStartingPoint->id }}" class="flex items-center py-1 text-jobboard-blue">
													<input type="checkbox" id="{{ $responsive?'r_':'' }}starting_points_checkbox_{{ $fieldStartingPoint->id }}" value="{{ $fieldStartingPoint->id }}" x-on:click="checkEls()" wire:model="filters.starting_points" @if(!$withRedirect) wire:change="search" @endif class="w-4 h-4 text-jobboard-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
													<label for="{{ $responsive?'r_':'' }}starting_points_checkbox_{{ $fieldStartingPoint->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $fieldStartingPoint->name }}</label>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>

						<div x-data="{
							tLbl: '{{ str_replace("'", "\\'", __('Destinations')) }}',
							checkEls:function() {
								destinationsChecked = document.querySelectorAll('[id^={{ $responsive?'r_':'' }}destinations_checkbox_]:checked');
								this.tLbl = '{{ str_replace("'", "\\'", __('Destinations')) }} '+((destinationsChecked.length > 0) ? '[ '+destinationsChecked.length+' ]' : '');
							}
						}" x-init="$nextTick(() => { checkEls() })">
							<div class="relative bg-white rounded-full lg:flex-2 px-2 py-1 lg:p-0 lg:rounded-none text-annonces-gray lg:border-l-2 lg:pl-4 border-jobboard-transparentgray">
								<div class="absolute inset-y-0 flex items-center pointer-events-none text-jobboard-blue z-10">
									<svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 0.500977V20.5002" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M7.66602 13.0919V9.50684" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M1 11.6107C1 11.6107 4.51098 9.95896 7.66642 9.50712C8.17751 9.43231 8.67379 9.38861 9.14785 9.38861C11.0885 9.38861 11.37 10.0701 11.37 10.87C11.37 12.2255 7.66642 11.7959 7.66642 13.0922C7.66642 14.2921 9.05896 14.5736 10.6293 14.5736C13.1625 14.5736 16.555 13.0922 16.555 13.0922V4.20361C16.555 4.20361 13.7773 5.41838 11.37 5.6406" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M1 2.72214C1 2.72214 5.72575 0.5 9.14785 0.5C11.0885 0.5 11.37 1.18146 11.37 1.98217V10.87" stroke="#0082FF" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>

								<div class="relative" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
									<input type="text" readonly x-on:click="open=!open" x-bind:value="tLbl" class="block w-full p-2 pl-8 text-annonces-gray text-sm bg-white border-none focus:ring-0 focus:outline-none cursor-pointer" />

									<div class="absolute z-50 mt-1 w-48 min-w-fit whitespace-nowrap rounded-b-md shadow-lg origin-top-right left-[-50px] lg:left-0" style="display:none" @form-reset.window="checkEls()" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100">
										<div class="rounded-b-md ring-1 ring-black ring-opacity-5 bg-white p-4 w-[300px] lg:w-full max-h-[225px] lg:max-h-[450px] overflow-auto">
											@foreach ($fieldDestinations as $fieldDestination)
												<div wire:key="destinations-{{ $fieldDestination->id }}" class="flex items-center py-1 text-jobboard-blue">
													<input type="checkbox" id="{{ $responsive?'r_':'' }}destinations_checkbox_{{ $fieldDestination->id }}" value="{{ $fieldDestination->id }}" x-on:click="checkEls()" wire:model="filters.destinations" @if(!$withRedirect) wire:change="search" @endif class="w-4 h-4 text-jobboard-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
													<label for="{{ $responsive?'r_':'' }}destinations_checkbox_{{ $fieldDestination->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $fieldDestination->name }}</label>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
				@endif

				@if($withRedirect)
					<div class="lg:relative lg:w-[70px] w-full sm:col-span-2 lg:col-span-1">
						<div class="lg:absolute lg:-top-[13px] lg:-right-[15px]">
							<x-front.tertiary-button wire:click="search" :class="'justify-center lg:w-[70px] h-[48px] lg:h-[61px] mt-[1px] lg:rounded-none lg:rounded-r-full w-full px-4'">
								<svg width="30" height="30" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-lg:hidden">
									<path id="Vector" d="M9.22824 17.9706C13.7751 17.9706 17.4611 14.2835 17.4611 9.7353C17.4611 5.18707 13.7751 1.5 9.22824 1.5C4.68134 1.5 0.995361 5.18707 0.995361 9.7353C0.995361 14.2835 4.68134 17.9706 9.22824 17.9706Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path id="Vector_2" d="M15.1089 15.6177L20.9895 21.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>

								<div class="lg:hidden uppercase">
									{{ __('Search') }}
								</div>
							</x-front.tertiary-button>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
