<div class="flex flex-row items-end">
	<div class="w-[54px] border-[3px] border-mnw-blue bg-mnw-blue rounded-full mb-3 mr-6"></div>

	<h2 {{ $attributes->merge(['class' => "mb-1 text-base lg:text-xl font-semibold text-mnw-blue"]) }}>
		{{ $slot }}
	</h2>
</div>
