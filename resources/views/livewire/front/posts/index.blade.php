<div>
	@php
		$countPostSmartAd = 0;
	@endphp

	@if($posts->isNotEmpty())
		@if($thematicHome)
			<div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-[1090px] m-auto justify-items-center">
		@endif
			@foreach($posts as $post)
				@if($postType->id)
					@php
						$countPostSmartAd++;
					@endphp
					@if($countPostSmartAd == 3)
						<div class="group relative min-w-[250px] mb-4 flex flex-col sm:flex-row justify-center sm:items-stretch rounded">
							<div id="sas_129775"></div>
							<script type="application/javascript">
								sas.cmd.push(function() {
									sas.render("129775"); // Format : Jobboard banniere annonce 918x166 et 258x326 918x166
								});
							</script>
						</div>
					@endif
				@endif

				@if(!empty($postType->id))
					<x-front.posts.post-list :post="$post" wire:key="post-list-{{ $post->id }}" />
				@else
					<x-front.posts.post-card :post="$post" wire:key="post-card-{{ $post->id }}" />
				@endif
			@endforeach
		@if($thematicHome)
			</div>
		@endif
	@else
		{{ __('No result for this search') }}
	@endif

	<div class="my-8">
		{{ $posts->links() }}
	</div>
</div>
