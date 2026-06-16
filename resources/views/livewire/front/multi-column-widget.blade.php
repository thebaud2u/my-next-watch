<div class="w-full flex justify-between flex-wrap max-w-[1200px]">
	<div class="flex flex-col flex-1">
		<h3 class="font-bold text-[18px] mb-4">
			{{ __('Other posts of :child', ['child' => $forSpecies->getTranslation('slug', 'en') == 'dog' ? __('puppies') : __('kitties')]) }}
		</h3>

		@if($breeds->isNotEmpty())
			@foreach($breeds as $breed)
				<a href="{{ route('post-search.'.$forSpecies->getTranslation('slug', 'en').'-posts-with-breed', ['postType' => 'portee', 'breed' => $breed->slug]) }}" class="hover:underline">
					{{ __(':breed for sale', ['breed' => $breed->name]) }}
				</a>
			@endforeach
		@endif
	</div>

	<div class="flex flex-col flex-1">
		<h3 class="font-bold text-[18px] mb-4">
			{{ __('Other companies') }}
		</h3>

		@if($breeds->isNotEmpty())
			@foreach($breeds as $breed)
				<a href="{{ route('company-search.'.$forSpecies->getTranslation('slug', 'en').'-companies-with-breed', ['breed' => $breed->slug]) }}" class="hover:underline">
					{{ __('Company of :breed', ['breed' => $breed->name]) }}
				</a>
			@endforeach
		@endif
	</div>

	<div class="flex flex-col flex-1">
		<h3 class="font-bold text-[18px] mb-4">
			{{ __('Other :species breeds', ['species' => __($forSpecies->getTranslation('slug', 'en')) ]) }}
		</h3>
		
		@if($breeds->isNotEmpty())
			@foreach($breeds as $breed)
				<a href="{{ route('breed-search.'.$forSpecies->getTranslation('slug', 'en').'-breeds.show', ['breed' => $breed->slug]) }}" class="hover:underline">
					{{ $breed->name }}
				</a>
			@endforeach
		@endif
	</div>
</div>