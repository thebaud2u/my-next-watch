<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold text-sm'">
	{{ \App\Models\Criteria::find($post->values_web['goods_type'][0])->name }}
</x-front.tag>

@if(count($post->values_web['goods_type']) > 1)
	<x-front.tag :class="'inline-block bg-annonces-otherlightblue font-semibold ml-3 text-sm'">
		+ {{ count($post->values_web['goods_type']) - 1 }}
	</x-front.tag>
@endif
