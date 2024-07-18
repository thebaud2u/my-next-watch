<div>
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 my-12 max-w-[810px] m-auto justify-items-center items-stretch">
		@foreach($thematic->postTypes as $postType)
			<div wire:key="card-{{ $postType->id }} " wire:click="search({{ $postType->id }})" class="max-w-[300px] h-[160px] w-full p-4 rounded shadow-[0_0_20px_0px_rgba(0,0,0,0.15)] flex flex-col justify-center items-center cursor-pointer hover:text-white hover:bg-annonces-blue">
				@include('components.front.pictos-post-types.'.$thematic->slug.'.'.$postType->slug)

				<p class="text-sm lg:tracking-tight font-light text-center mt-2">
					{{ __($postType->name) }}
				</p>
			</div>
		@endforeach
	</div>
</div>
