
<div class="flex flex-col p-2 items-center justify-between absolute mt-2 w-full min-w-[320px] border border-jobboard-greige rounded-xl top-[27px] lg:top-[42px] left-0 lg:-left-[21px] bg-white mr-4 z-10" x-show="autocomplete">
	<div class="border border-jobboard-greige rounded-full p-2 w-full">
		<svg class="absolute left-[25px] top-[23px]" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M9.75 2.5C5.74594 2.5 2.5 5.74594 2.5 9.75C2.5 13.7541 5.74594 17 9.75 17C13.7541 17 17 13.7541 17 9.75C17 5.74594 13.7541 2.5 9.75 2.5ZM1 9.75C1 4.91751 4.91751 1 9.75 1C14.5825 1 18.5 4.91751 18.5 9.75C18.5 14.5825 14.5825 18.5 9.75 18.5C4.91751 18.5 1 14.5825 1 9.75Z" fill="#0E1954"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M15.2197 15.2197C15.5126 14.9268 15.9874 14.9268 16.2803 15.2197L22.2803 21.2197C22.5732 21.5126 22.5732 21.9874 22.2803 22.2803C21.9874 22.5732 21.5126 22.5732 21.2197 22.2803L15.2197 16.2803C14.9268 15.9874 14.9268 15.5126 15.2197 15.2197Z" fill="#0E1954"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M9.75 2.5C5.74594 2.5 2.5 5.74594 2.5 9.75C2.5 13.7541 5.74594 17 9.75 17C13.7541 17 17 13.7541 17 9.75C17 5.74594 13.7541 2.5 9.75 2.5ZM1 9.75C1 4.91751 4.91751 1 9.75 1C14.5825 1 18.5 4.91751 18.5 9.75C18.5 14.5825 14.5825 18.5 9.75 18.5C4.91751 18.5 1 14.5825 1 9.75Z" stroke="#0E1954" stroke-linecap="round" stroke-linejoin="round"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M15.2197 15.2197C15.5126 14.9268 15.9874 14.9268 16.2803 15.2197L22.2803 21.2197C22.5732 21.5126 22.5732 21.9874 22.2803 22.2803C21.9874 22.5732 21.5126 22.5732 21.2197 22.2803L15.2197 16.2803C14.9268 15.9874 14.9268 15.5126 15.2197 15.2197Z" stroke="#0E1954" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		<input type="text" name="keyword" wire:model="searchValue" wire:keyup="search" placeholder="{{ $placeholder }}" class="pl-10 max-md:z-10 block w-full p-2 text-jobboard-deepblue placeholder:text-jobboard-deepblue text-sm bg-transparent border-none focus:ring-0 focus:outline-none cursor-pointer" />
	</div>

	@if($showResults && ! $results->isEmpty())
		<div class="mt-1 w-full text-sm rounded-b-md top-6 left-0 bg-white p-4 z-10">
			<ul class="text-jobboard-deepblue max-h-[180px] overflow-y-scroll">
				@foreach($results as $result)
					<li wire:click="select('{{ $result->slug }}')" class="max-md:relative max-md:z-50 cursor-pointer hover:underline transition duration-200 ease-in-out">
						{{ $result->displayed }}
					</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div wire:click="reinitialize" class="w-full flex justify-center items-center text-jobboard-deepblue cursor-pointer max-md:z-20" {!! (!$showResults) ? 'style="display:none"' : '' !!}>
		<x-front.primary-button @click.prevent="" :class="'w-full justify-center'">
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.17547 11.5745L11.3245 6.42545M6.17547 6.42545L11.3245 11.5745M16.75 9C16.75 13.4183 13.1683 17 8.75 17C4.33172 17 0.75 13.4183 0.75 9C0.75 4.58172 4.33172 1 8.75 1C13.1683 1 16.75 4.58172 16.75 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			{{ __('Reinitialize') }}
		</x-front.primary-button>
	</div>
</div>
