<article class="border border-mnw-greige rounded-xl p-6 text-mnw-deepblue cursor-pointer">
	<div class="flex flex-col gap-2 w-full">
		<div class="font-bold text-[28px]">
			{{ $watch->getBrand()->name }} {{ $watch->name }}
		</div>

		<div class="flex font-medium text-sm w-full">
			{{ __('Reference : :reference', ['reference' => $watch->reference]) }}
		</div>

		<div class="flex gap-2 flex-wrap">
			<a href="{{ route('brand.show', ['brand' => $watch->getBrand()->slug]) }}" class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange">
				{{ $watch->getBrand()->name }}
			</a>

			<a href="{{ route('collection.show', ['collection' => $watch->collection->slug]) }}" class="p-2 flex justify-center items-center rounded font-medium text-xs bg-mnw-orange">
				{{ $watch->collection->name }}
			</a>

			<div class="p-2 flex gap-x-1 justify-center items-center rounded font-medium text-xs bg-mnw-orange">
				{{ $watch->release_price }} €
			</div>

			<div class="p-2 flex gap-x-1 justify-center items-center rounded font-medium text-xs bg-mnw-orange">
				<svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 7.95455C15 12.6527 8 18 8 18C8 18 1 12.6527 1 7.95455C1 3.25636 4.13444 1 8 1C11.8656 1 15 3.25636 15 7.95455Z" stroke="#0E1954" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.00003 10.2726C9.71825 10.2726 11.1111 8.88879 11.1111 7.18173C11.1111 5.47467 9.71825 4.09082 8.00003 4.09082C6.28181 4.09082 4.88892 5.47467 4.88892 7.18173C4.88892 8.88879 6.28181 10.2726 8.00003 10.2726Z" stroke="#0E1954" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>

				{{ $watch->getBrand()->country->name }}
			</div>
		</div>

		<a href="{{ route('watch.show', ['watch' => $watch->slug]) }}">
			<x-front.secondary-button>
				{{ __('Learn more') }}
			</x-front.secondary-button>
		</a>
	</div>
</article>