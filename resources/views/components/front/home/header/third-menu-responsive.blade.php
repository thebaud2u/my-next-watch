<div class="flex flex-col bg-[#D9EDFF]">
	@php
		$thirdMenuPostTypes = App\Models\PostType::whereHas('thematic', function($whereHas) use ($currentThematic) {
				$whereHas->where('slug', '=', $currentThematic->slug);
			})
			->get();
	@endphp

	@foreach($thirdMenuPostTypes as $thirdMenuPostType)
		<x-front.header.nav-link :href="route('posts', ['thematic' => $currentThematic, 'postType' => $thirdMenuPostType])" :active="$thirdMenuPostType->slug == $currentPostType->slug">
			{{ $thirdMenuPostType->name }}
		</x-front.header.nav-link>
	@endforeach
</div>
