<div>
	<div class="text-sm sm:text-base lg:text-xl">
		<div class="flex flex-row mb-4">
			{{ __('Select the period concerned by your export') }}
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:flex lg:flex-wrap max-w-[936px]">
			<div class="bg-white border-b border-gray-300 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
					<input type="date" wire:model="dateDebutPeriode" wire:change="postsNumberPreview" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>

			<div class="bg-white border-b border-gray-300 shadow-md px-2 py-1 lg:p-0 text-gray-400 min-w-[250px]">
				<div class="relative mt-1 border-b-4 border-transparent">
					<div class="absolute inset-y-0 left-1 lg:left-2 flex items-center pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
					<input type="date" wire:model="dateFinPeriode" wire:change="postsNumberPreview" class="block w-full p-1.5 pl-8 lg:pl-9 text-gray-500 text-sm xl:text-base bg-white border border-transparent focus:border-transparent focus:ring-0 rounded-md" />
				</div>
			</div>
		</div>

		@if($dateDebutPeriode && $dateFinPeriode)
			<div class="flex flex-row mt-4">
				{{ __(':x posts ready to be exported with the given period', ['x' => $totalPostsConcerned]) }}
			</div>

			<div style="padding:0 0 0 40px;" class="mt-4">
				<div class="flex flex-row mt-4">
					{{ __(':x print posts ready to be exported with the given period', ['x' => $totalPrintPostsConcerned]) }}
				</div>

				<div class="flex flex-row mt-4">
					{{ __(':x web posts ready to be exported with the given period', ['x' => $totalWebPostsConcerned]) }}
				</div>
			</div>
		@endif

		@if($totalPostsConcerned > 0)
			<div class="flex justify-end">
				<button type="button" wire:click="exportXML" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
					{{ __('Launch the export') }}
				</button>
			</div>
		@endif
	</div>
</div>
