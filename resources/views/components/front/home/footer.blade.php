<div class="bg-mnw-deepblue text-mnw-cream w-full flex justify-center px-4">
	<div class="max-w-[1200px] flex flex-col justify-center items-center w-full">
		<div class="w-full flex justify-center border-mnw-cream/30 border-b">
			
		</div>

		<div class="flex flex-row gap-x-4 flex-wrap justify-center text-sm font-medium py-10">
			<a href="{{ route('home') }}" class="flex-shrink-0 flex-grow-0 hover:underline">
				{{ env('APP_NAME') }}
			</a>

			<div class="flex-shrink-0 flex-grow-0">|</div>

			<a href="{{ route('legal-pages.cookies') }}" class="flex-shrink-0 flex-grow-0 hover:underline">
				{{ __('Cookies') }}
			</a>

			<div class="flex-shrink-0 flex-grow-0">|</div>

			<a href="{{ route('legal-pages.about-us') }}" class="flex-shrink-0 flex-grow-0 hover:underline">
				{{ __('Cookies') }}
			</a>
		</div>
	</div>
</div>
