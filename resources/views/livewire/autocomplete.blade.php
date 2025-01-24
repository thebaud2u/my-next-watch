
<div class="relative mt-2">
	<div class="absolute inset-y-0 end-0 flex items-center pe-2" {!! (empty($searchValue)) ? 'style="display:none"' : '' !!}>
		<a href="#" wire:click.prevent="reinitialize" class="text-gray-500 hover:text-mnw-darkblue">
			<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
				<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
			</svg>
		</a>
	</div>

	<x-text-input placeholder="{{ $placeholder }}" wire:model="searchValue" wire:keyup="search" :class="'mt-1 pe-10 block w-full text-gray-700 placeholder:text-gray-300'" />

	@if($showResults && ! $results->isEmpty())
		<div class="absolute z-50 mt-1 w-48 min-w-full rounded-b-md shadow-lg origin-top-right left-0 bg-white p-4">
			<ul class="text-gray-700">
				@foreach($results as $result)
					<li wire:click="select({{ $result->id }},'{{ str_replace("'", "\\'", $result->displayed) }}')" class="cursor-pointer hover:text-mnw-darkblue hover:underline transition duration-200 ease-in-out">
						{{ $result->displayed }}
					</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>
