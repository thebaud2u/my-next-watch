@props([
	'type' => null,
	'result' => null,
	'tags' => [],
	'firstInfo' => null,
	'secondInfo' => null
])

@php
	if($type == 'watch') {
		$collection = $result->collection;

		$link = route('watch.show', ['watch' => $result->slug]);
		$firstInfo = $result->reference;
		$tags = [$collection->brand->name, $collection->name, $result->release_price.'€'];
	}
@endphp

<a href="{{ $link }}">
	<article class="flex flex-col justify-center text-breeder-deepblue w-full md:max-w-[264px] aspect-square cursor-pointer border border-mnw-greige rounded-xl p-6">
		@if($firstInfo)
			<div class="font-bold text-[20px]">
				{{ $firstInfo }}
			</div>
		@endif

		@if($secondInfo)
			<div class="flex font-medium text-sm w-full">
				{{ $secondInfo }}
			</div>
		@endif

		@if(!empty($tags))
			<div class="flex flex-row gap-2 flex-wrap">
				@foreach($tags as $tag)
					<span class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange cursor-pointer">
						{{ $tag }}
					</span>
				@endforeach
			</div>
		@endif
	</article>
</a>