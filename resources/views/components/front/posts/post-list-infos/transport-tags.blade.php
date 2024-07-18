@if($post->postType->slug == 'materiel' || $post->postType->slug == 'piece-rechange')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ $post->postType->name }}
	</x-front.tag>
@endif

@if($post->postType->slug == 'vente-vehicule' || $post->postType->slug == 'achat-location-vehicule')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['vehicule_type'])->name }}
	</x-front.tag>
@endif

@if($post->postType->slug == 'transaction-entreprise')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['sector'])->name }}
	</x-front.tag>

	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold ml-3 text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['activity_type'])->name }}
	</x-front.tag>
@endif

@if($post->postType->slug == 'offre-immobiliere')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['good_type'])->name }}
	</x-front.tag>
@endif

@if($post->postType->slug == 'appel-offre')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['market_type'])->name }}
	</x-front.tag>
@endif

@if($post->postType->slug == 'tractionnaire')
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
		{{ \App\Models\Criteria::find($post->values_web['tractor_type'])->name }}
	</x-front.tag>
@endif
