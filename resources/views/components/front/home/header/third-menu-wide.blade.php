@php
	$thirdMenuPostTypes = App\Models\PostType::whereHas('thematic', function($whereHas) use ($currentThematic) {
			$whereHas->where('slug', '=', $currentThematic->slug);
		})
		->get();
	$justify = "justify-center";
	if ($currentThematic->slug == 'bois') {
			$justify = "justify-start";
		}
	elseif ($currentThematic->slug == 'transport') {
		$justify = "xl:justify-center justify-start";
	}
@endphp
@if ($thirdMenuPostTypes->isNotEmpty())
	@if ($currentThematic->slug == 'bois')
		<div class="block bg-annonces-lightblue scrollbar-thin overflow-x-scroll noscrollbar">
	@else
		<div class="block bg-annonces-lightblue max-xl:overflow-x-scroll noscrollbar">
	@endif
		<div class="mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex h-12 items-center space-x-6 {{$justify}}">
				@foreach($thirdMenuPostTypes as $thirdMenuPostType)
					<x-front.header.nav-link :class="'pt-0'" :href="route('posts', ['thematic' => $currentThematic, 'postType' => $thirdMenuPostType])" :active="$thirdMenuPostType->slug == $currentPostType->slug">
						{{ $thirdMenuPostType->name }}
					</x-front.header.nav-link>
				@endforeach
			</div>
		</div>
	</div>
	@php
		$arrowPostType;
		if ($currentThematic->slug == 'bois') {
			$arrowPostType = "relative";
		}
		elseif ($currentThematic->slug == 'transport'){
			$arrowPostType = "relative xl:hidden";
		}
		else $arrowPostType = "hidden";
	@endphp
	<div class="{{$arrowPostType}}">
		<div class="absolute bg-annonces-lightblue absolute right-0 z-10 w-[30px] h-10 top-[-40px]">
			<svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-[14px] right-[12px]">
				<path d="M7 9L11 5L7 1" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M10.9439 5L0.582031 5" stroke="#262423" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
	</div>
@endif
