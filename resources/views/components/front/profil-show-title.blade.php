<div class="flex flex-row items-end">
	<div class="w-[54px] border-[3px] border-jobboard-deepblue bg-jobboard-deepblue rounded-full mb-3 mr-6"></div>

	<h2 {{ $attributes->merge(['class' => "mb-1 text-base lg:text-xl font-semibold text-jobboard-deepblue"]) }}>
		{{ $slot }}
	</h2>
</div>
