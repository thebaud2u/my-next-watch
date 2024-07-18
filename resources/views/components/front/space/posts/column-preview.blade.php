@props([
	'size' => '1/4',
	'post' => null,
	'location' => __('Unknown location')
])

<div class="flex flex-row w-[250px] {{ $size == '1/4' ? 'h-[290px]' : ($size == '1/2' ? 'h-[500px]' : 'h-[1000px]') }}">
	<div class="flex flex-col">
		<div class="bg-[#006590] py-2 text-white text-sm font-bold [writing-mode:vertical-lr]">
			{{ $post->postType->name }}
		</div>
	</div>

	<div class="bg-white px-2 py-4">
		<div class="flex flex-row text-large">
			<div>
				<span class="font-bold">
					{{ $post->user->type == 'Professionnel' ? $post->user->values['company_name'] : $post->user->name }}
				</span> poste
				<span class="font-bold text-[#d0890a]">
					{{ $post->values_print['title']}}
				</span>
			</div>

			<div>
				<img src="{{ asset('/storage/QR_code.png') }}" />
			</div>
		</div>

		<div class="flex flex-row font-bold">
			<ul class="list-disc pl-8">
				<li>{{ $location }}</li>
			</ul>
		</div>

		<div class="flex flex-col mt-4">
			<span class="text-large font-bold">
				{{ __('Description') }} :
			</span>

			{{ $post->values_print['body']}}
		</div>

		<div class="relative">
			<div class="absolute right-[5px] top-[16px] p-0.5 bg-white border-2 border-[#27a982]">
				{{ __('Ref') }} : {{ $post->id }}
			</div>
		</div>
	</div>
</div>
