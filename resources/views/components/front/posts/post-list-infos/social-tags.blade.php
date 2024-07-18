<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
	{{ \App\Models\Criteria::find($post->values_web['market_type'])->name }}
</x-front.tag>
