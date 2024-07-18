<div class="flex flex-col">
	@php
		$secondMenuThematics = App\Models\Thematic::all();
	@endphp

	@foreach($secondMenuThematics as $secondMenuThematic)
		@php
			// Si la thematique n'a qu'un seul postType alors on précharge direct vers le seul PostType
			if($secondMenuThematic->postTypes()->count() > 1) $array = ['thematic' => $secondMenuThematic];
			else $array = ['thematic' => $secondMenuThematic, 'postType' => $secondMenuThematic->postTypes()->first()];
		@endphp

		<x-front.header.nav-link :href="route('posts', $array)" :active="$secondMenuThematic->slug == $currentThematic->slug">
			{{ ucfirst($secondMenuThematic->slug) }}
		</x-front.header.nav-link>
	@endforeach
</div>
