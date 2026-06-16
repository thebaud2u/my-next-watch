<div>
	<div class="w-full">
		<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:justify-between">
			<div class="flex flex-col gap-y-4">
				<div>
					<h2 class="mb-1 text-base md:text-[24px] font-bold text-jobboard-deepblue">
						{{ __('Newsletter inscription') }}
					</h2>

					<div class="mt-4 flex flex-col gap-4">
						<div class="flex flex-row justify-between flex-wrap gap-2">
							<div class="flex flex-row text-jobboard-deepblue">
								<x-front.input-label for="" :value="__('I subscribe to the monthly newsletter of :siteName', ['siteName' => env('APP_NAME')])" />
							</div>

							<div class="flex flex-row text-jobboard-deepblue">
								<div class="pr-2">
									<input type="radio" name="optin_newsletter" value="1" id="optin_newsletter" wire:model="optinNewsletter" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
									<label for="optin_newsletter">
										{{ __('yes') }}
									</label>
								</div>

								<div class="pr-2">
									<input type="radio" name="optin_newsletter" value="0" id="optin_newsletter" wire:model="optinNewsletter" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
									<label for="optin_newsletter">
										{{ __('no') }}
									</label>
								</div>
							</div>
						</div>

						<div class="flex flex-row justify-between flex-wrap gap-2">
							<div class="flex flex-row text-jobboard-deepblue">
								<x-front.input-label for="" :value="__('I would like to receive information from :siteName and their publishers', ['siteName' => env('APP_NAME')])" />
							</div>

							<div class="flex flex-row text-jobboard-deepblue">
								<div class="pr-2">
									<input type="radio" name="optin_receive_info" value="1" id="optin_receive_info" wire:model="optinReceiveInfo" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3"/>
									<label for="optin_receive_info">
										{{ __('yes') }}
									</label>
								</div>

								<div class="pr-2">
									<input type="radio" name="optin_receive_info" value="0" id="optin_receive_info" wire:model="optinReceiveInfo" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3"/>
									<label for="optin_receive_info">
										{{ __('no') }}
									</label>
								</div>
							</div>
						</div>

						<div class="flex flex-row justify-between flex-wrap gap-2">
							<div class="flex flex-row text-jobboard-deepblue">
								<x-front.input-label for="" :value="__('I would like to receive good deals from :siteName partners' ['siteName' => env('APP_NAME')])" />
							</div>

							<div class="flex flex-row text-jobboard-deepblue">
								<div class="pr-2">
									<input type="radio" name="optin_receive_deals" value="1" id="optin_receive_deals" wire:model="optinReceiveDeals" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
									<label for="optin_receive_deals">
										{{ __('yes') }}
									</label>
								</div>

								<div class="pr-2">
									<input type="radio" name="optin_receive_deals" value="0" id="optin_receive_deals" wire:model="optinReceiveDeals" wire:change="updateOptinsInfo" class="mr-1 disabled:bg-jobboard-greige my-1 checked:bg-jobboard-deepblue checked:hover:bg-jobboard-deepblue checked:active:bg-jobboard-deepblue checked:focus:bg-jobboard-deepblue focus:bg-jobboard-deepblue focus:outline-none focus:ring-1 focus:ring-jobboard-deepblue w-3 h-3" />
									<label for="optin_receive_deals">
										{{ __('no') }}
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
