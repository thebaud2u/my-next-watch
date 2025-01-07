<div class="p-3">
	<form class="border-b border-mnw-transparentgray pb-6" @if(!empty($response->id)) x-data="{ deploy: false }" @endif>
		<div class="flex flex-row justify-between">
			<div class="flex-1 flex flex-row items-center">
				<div class="{{ (empty($response->id)) ? 'text-mnw-lightergray' : 'text-mnw-blue' }} mr-3">
					<svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path id="Vector" d="M23.7768 4.88867H17.1101" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_2" d="M5.99889 4.88867H1.55444" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_3" d="M10.4433 8.77778C12.5911 8.77778 14.3322 7.03666 14.3322 4.88889C14.3322 2.74111 12.5911 1 10.4433 1C8.29556 1 6.55444 2.74111 6.55444 4.88889C6.55444 7.03666 8.29556 8.77778 10.4433 8.77778Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_4" d="M23.7767 17.1113H19.3323" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_5" d="M8.22111 17.1113H1.55444" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
						<path id="Vector_6" d="M14.8877 20.9999C17.0354 20.9999 18.7766 19.2588 18.7766 17.1111C18.7766 14.9633 17.0354 13.2222 14.8877 13.2222C12.7399 13.2222 10.9988 14.9633 10.9988 17.1111C10.9988 19.2588 12.7399 20.9999 14.8877 20.9999Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="font-semibold xl:text-lg {{ (empty($response->id)) ? 'text-mnw-headergray' : 'text-black' }}">
					{{ __('Filter by') }} :
				</div>
			</div>

			<div class="flex-1 flex flex-row justify-end items-center">
				@if(empty($response->id))
					<span class="inline-block text-mnw-lightergray xl:text-lg font-semibold">
						{{ __('Reinitialize') }}
					</span>

					<span class="inline-block ml-2 text-mnw-lightergray">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
						</svg>
					</span>
				@else
					<input type="reset" wire:click="resetForm" value="{{ __('Reinitialize') }}" class="inline-block text-mnw-blue xl:text-lg font-semibold cursor-pointer" />

					<span class="inline-block ml-2 cursor-pointer" x-on:click="deploy=!deploy">
						<span x-show="deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"></path>
							</svg>
						</span>

						<span x-show="!deploy">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
							</svg>
						</span>
					</span>
				@endif
			</div>
		</div>

		@if(!empty($response->id))
			<div x-show="deploy">
				<div class="relative mt-4">
					<div class="absolute inset-y-0 right-2 lg:right-3 flex items-center pointer-events-none text-mnw-gray">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
						</svg>
					</div>

					<input type="text" placeholder="Mot(s)-clé(s)" wire:model="keywords" wire:keydown.debounce.500ms="search" name="keywords" class="block w-full text-black border-mnw-darkerwhite text-sm xl:text-base bg-white border p-2 focus:border-mnw-blue focus:ring-0 rounded-md" />
				</div>
			</div>
		@endif
	</form>
</div>
