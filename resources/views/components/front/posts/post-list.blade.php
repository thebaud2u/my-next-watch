{{-- Default values --}}
@props([
	'viewed' => false,
	'applied' => false,
	'post' => null
])

@php
	/** Location */
	if ($city = $post->address?->city->name ?? $post->address?->custom_city) {
		$code = $post->address?->city->zip_code ?? ($post->address?->department?->code ?? null);
		$location = $city .($code ? ' ('.$code.')' : '');
	}
	else if ($departement = $post->address?->department?->name) {
		$code = $post->address?->department?->code ?? null;
		$location = $departement .($code ? ' ('.$code.')' : '');
	}
	else if ($region = $post->address?->region?->name) $location = $region;
	else if ($country = $post->address?->country?->name) $location = $country;
	else $location = __('Unknown location');

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

	$viewed = (Auth::guard('web')->check() && Auth::guard('web')->user()->hasViewed(App\Models\Post::class, $post->id) > 0);

	$heightClass = 'h-[173px]';
	if(Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('registered')) {
		if(Auth::guard('web')->user()->hasApplied($post) > 0) $heightClass = 'h-[200px]';
	}

	$classes = "";
	if(!empty($viewed)) {
		$classes .= "bg-gray-100";

		if(!empty($favorites) || (!empty($product) && $product > 1)) $classes .= " opacity-70 hover:opacity-100";
		else $classes .= " opacity-60 hover:opacity-90 ";
	}

	if((!empty($product) && $product > 1 && $product != 3)) $classes .= " shadow-lg border-2 border-mnw-blue hover:border-mnw-blue";
	else {
		if($product == 3) $classes .= " shadow-lg border-2 border-mnw-yellow hover:border-mnw-yellow";
		else $classes .= " hover:bg-gray-50 border border-gray-100 hover:border-gray-200";
	}
@endphp

<a href="{{ route('show-post', ['post' => $post->slug]) }}" class="cursor-pointer">
	<article class="group relative min-w-[250px] mb-4 flex flex-col sm:flex-row justify-center sm:items-stretch rounded bg-white mx-2 {{ $classes }}" x-data="{hoverOn: false}" @mouseleave="hoverOn = false" @mouseover="hoverOn = true">
		{{-- Image, logo --}}
		<div class="overflow-hidden sm:flex-none flex justify-center items-stretch w-full sm:max-w-[200px] {{ $heightClass }} rounded-t sm:rounded-l sm:rounded-tr-none">
			@if($media = $post->getFirstMedia('photos'))
				<img src="{{ $media->getAvailableUrl(['optimized']) }}" alt="{{ ($post->user->type == 'Professionnelle') ? $post->user->values['company_name'] : $post->user->name }}" class="object-cover w-full rounded-t-sm sm:rounded-none" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
			@else
				<img src="{{ asset('/storage/'.$post->thematic->getRandomImage()) }}" alt="{{ ($post->user->type == 'Professionnelle') ? $post->user->values['company_name'] : $post->user->name }}" class="object-cover w-full rounded-t-sm sm:rounded-none" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''" />
			@endif
		</div>

		<div class="sm:grow p-4 {{ (empty($product) || $product < 3) ? 'max-sm:pt-10' : '' }} sm:pl-12 text-xs lg:text-sm">
			{{-- Viewed, premium tag --}}
			@if(!empty($viewed) || (!empty($product) && $product == 3))
				@if(!empty($product) && $product == 3)
					<div class="relative">
						<div class="absolute sm:-top-[38px] -top-[182px] -right-[38px]">
							<svg width="97" height="97" viewBox="0 0 97 97" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path id="Vector 15" d="M33.9864 14.1421L5.65722 14.187L82.7319 91.2617L82.7767 62.9325L33.9864 14.1421Z" fill="#E9A908"/>
								<path id="Vector 16" d="M11.3142 19.8442L0.000488281 19.8442L5.65734 14.1874L11.3142 19.8442Z" fill="#C78E00"/>
								<path id="Vector 17" d="M77.0741 96.9186L82.731 91.2617L77.0741 85.6049L77.0741 96.9186Z" fill="#C78E00"/>
							</svg>

							<span class="absolute rotate-45 flex flex-row items-center text-base text-white z-10 top-[33px] right-[6px]">
								<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-1">
									<path id="Vector" d="M3.90271 0.844608L7.36674 3.53168L11.5314 2.01939L11.565 2.05306L10.0539 6.21888L12.741 9.68291L12.6809 9.74304L8.28925 9.62834L5.82105 13.2796L5.75852 13.2171L4.5543 9.03012L0.368493 7.82709L0.30477 7.76337L3.95607 5.29516L3.84257 0.904745L3.90271 0.844608Z" fill="currentColor"/>
								</svg>

								Premium
							</span>
						</div>
					</div>
				@endif

				<div class="float-right text-right ml-4 sm:mt-6 mr-4 sm:mr-0">
					@if(!empty($viewed))
						<div class="flex justify-end items-center {{ (!empty($product) && $product == 3) ? 'mt-2.5' : 'mt-1' }} text-gray-600 font-semibold ">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 lg:w-5 lg:h-5 mr-1">
								<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>

							{{ __('Already viewed') }}
						</div>
					@endif
				</div>

				@if(!empty($product) && $product == 3)
					<div class="inline-block h-7 md:hidden"></div>
				@endif
			@endif

			{{-- Title --}}
			<h2 class="mb-2 text-sm sm:text-base xl:text-lg font-semibold leading-normal" :class="hoverOn ? 'text-mnw-blue': 'text-black'">
				{{ $post->title }}
			</h2>

			<div class="mb-2 group-hover:text-gray-700 text-black group-hover:text-mnw-blue transition duration-200 ease-in-out">
				<span class="capitalize font-semibold">
					@if($post->user->type == 'Professionnel')
						{{ $post->user->values['company_name'] }}
					@elseif($post->user->type == 'Particulier')
						{{ $post->user->name }}
					@endif
				</span>
			</div>

			{{-- Info displayed depends on the thematic and the post type --}}
			<div class="text-gray-400 {{ (!empty($product) && $product > 1) ? 'group-hover:text-gray-500 transition duration-200 ease-in-out' : '' }}">
				@include('components.front.posts.post-list-infos.'.$post->thematic->slug.'-infos')
			</div>

			@include('components.front.posts.post-list-infos.'.$post->thematic->slug.'-tags')

			{{-- Application --}}
			@if(Auth::guard('web')->check())
				@role('registered')
					@if(Auth::guard('web')->user()->hasApplied($post) > 0)
						<div class="mt-4 mr-8 flex items-center font-semibold text-mnw-blue group-hover:text-mnw-blue transition duration-200 ease-in-out">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
							</svg>

							{{ __('You have already contacted for this announcement') }}
						</div>
					@endif
				@endrole
			@endif
		</div>

		{{-- Favorites --}}
		<div class="absolute bottom-4 right-4" {!! ($favorite) ? 'title="'.__('In my favorites').'"' : '' !!}>
			@if($favorite)
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 pointer-events-none">
					<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
				</svg>
			@endif
		</div>
	</article>
</a>
