<div class="bg-white drop-shadow-md">
	<div class="max-w-[1440px] mx-auto p-2.5 w-full">
		<div class="flex justify-center space-x-6 w-[335px] mx-auto">
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
	</div>
</div>
