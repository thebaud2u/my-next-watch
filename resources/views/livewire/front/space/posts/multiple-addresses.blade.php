<div>
	<div class="flex flex-row flex-wrap">
		@if($addresses->isNotEmpty())
			@foreach($addresses as $address)
				<div class="flex flex-row">
					@livewire('front.space.posts.multiple-address', ['post' => $post, 'address' => $address], key('multiple-address-'.$address->id))
				</div>
			@endforeach
		@else
			{{ __('No multi-broadcasting areas yet') }}
		@endif
	</div>

	<div class="mt-6 max-w-[350px]">
		@livewire('localisation-search-engine', ['hideDistance' => true, 'from' => 'multiple-address', 'excludeType' => 'cities'])
	</div>
</div>
