{{-- Default values --}}
@props([
	'viewed' => false,
	'applied' => false,
	'post' => null,
	'viewedEffect' => true,
	'widthMobile' => 'w-[350px]',
	'maxWidthMobile' => 'max-w-[350px]'
])

@php
	/** Favorites */
	$favorite = (Auth::guard('web')->user() && $post->hasBeenFavoritedBy(Auth::guard('web')->user()));

	/** Product */
	if(!empty($post->offer->slug)) {
		switch ($post->offer->slug) {
			case 'F2ASHPREM':
				$product = 2;
				break;
			case 'F2ASH1/4C':
				$product = 2;
				break;
			case 'F2ASH1/2C':
				$product = 2;
				break;
			case 'F2ASH1C':
				$product = 2;
				break;
			case 'F3ASHPRM+':
				$product = 3;
				break;
			case 'F3ASH1/4C':
				$product = 3;
				break;
			case 'F3ASH1/2C':
				$product = 3;
				break;
			case 'F3ASH1C':
				$product = 3;
				break;
			default:
				$product = 1;
				break;
		}
	}
	else $product = 1;

	if($viewedEffect) $viewed = (Auth::guard('web')->check() && Auth::guard('web')->user()->hasViewed(App\Models\Post::class, $post->id) > 0);

	$classes = "";
	if($viewedEffect) {
		if(!empty($viewed)) {
			$classes .= "bg-gray-100";

			if(!empty($favorites) || (!empty($product) && $product > 1)) $classes .= " opacity-70 hover:opacity-100";
			else $classes .= " opacity-60 hover:opacity-90 ";
		}
	}
	else $classes .= "bg-gray-50";

	if((!empty($product) && $product > 1 && $product != 3)) $classes .= " shadow-lg border-2 border-mnw-blue hover:border-mnw-blue";
@endphp

<a href="{{ route('show-post', ['post' => $post->slug]) }}" class="cursor-pointer">
	<article class="{{ $widthMobile }} sm:w-[250px] h-[250px] rounded shadow-md pb-3 {{ $classes }}" x-data="{hoverOn: false}" @mouseleave="hoverOn = false" @mouseover="hoverOn = true">
		{{-- Image, logo --}}
		<div class="overflow-hidden sm:flex-none flex justify-center items-stretch w-full sm:max-w-[250px] {{ $maxWidthMobile }} h-[131px] rounded-t">
			@if($media = $post->getFirstMedia('photos'))
				<img src="{{ $media->getAvailableUrl(['optimized']) }}" alt="{{ ($post->user->type == 'Professionnelle') ? $post->user->values['company_name'] : $post->user->name }}" class="object-cover w-full rounded-t" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
			@else
				<img src="{{ asset('/storage/'.$post->thematic->getRandomImage()) }}" alt="{{ ($post->user->type == 'Professionnelle') ? $post->user->values['company_name'] : $post->user->name }}" class="object-cover w-full rounded-t" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
			@endif
		</div>

		{{-- Title --}}
		<h2 class="p-3 pb-2 text-md font-semibold leading-normal" :class="hoverOn ? 'text-mnw-blue': 'text-black'">
			{{ $post->title }}
		</h2>

		<div class="ml-3">
			@include('components.front.posts.post-list-infos.'.$post->thematic->slug.'-tags')
		</div>
	</article>
</a>
