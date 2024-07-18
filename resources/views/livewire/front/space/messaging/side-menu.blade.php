<div class="flex flex-col gap-y-2 md:max-lg:max-h-[300px] lg:max-h-[500px] overflow-x-hidden md:overflow-y-auto py-2 pr-1"
	x-data="{active:{{ $activeResponse->id ?? 0 }}}"
	@if (! empty($activeResponse->id))
		x-init="$nextTick(()=>{$refs.link{{ $activeResponse->id }}.scrollIntoView({block:'end'})})"
	@endif
	x-bind:class="(small&&thread)?'hidden':'block'"
	x-on:read.window="$wire.read(resp) {{-- ;console.log('read('+resp+')') --}} ">
	<div class="flex flex-row ml-3 pb-4 @if ($responses->count() > 0) border-b border-annonces-transparentgray @endif ">
		<div class="flex-none text-annonces-blue mr-3">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" class="size-6">
				<path d="M19.487 16.2696C20.4435 14.7391 21 12.9391 21 11C21 5.47827 16.5217 1 11 1C5.47824 1 1 5.47827 1 11C1 16.5218 5.47824 21 11 21C12.9391 21 14.7391 20.4435 16.2696 19.487L21 21L19.487 16.2696Z" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.08594 8.82617H14.912" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.08594 13.1741H12.3033" stroke="#0082FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
		<div class="flex-1 font-semibold xl:text-lg text-black">
			{{ trans_choice('[0,1] :nb conversation|[2,*] :nb conversations', count($responses), ['nb' => count($responses)]) }}
		</div>
	</div>
	@foreach ($responses as $response)
		<a href="#" class="block relative group cursor-pointer border-l-2 border-transparent hover:border-annonces-blue hover:bg-annonces-lightblue transition duration-200 ease-in-out"
			wire:click.prevent="show({{ $response->id }})" x-ref="link{{ $response->id }}"
			x-bind:class="{'bg-annonces-lightblue':active=={{ $response->id }}&&!small}"
			x-on:click="active={{ $response->id }};thread=true;resp=({{ $response->id }})"
			title="{{ $response->post->title }}">
			<div class="flex flex-row items-center ml-3">
				@php
					$nbUnreads = count($response->thread->userUnreadMessages(Auth::guard('web')->user()->id));
				@endphp
				<div class="flex-none flex justify-center items-center size-14 aspect-square rounded bg-gray-100 text-gray-300">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
						<path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
						<path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
					</svg>
				</div>
				<div class="flex-1 max-w-[calc(100%-3.5rem)] p-3 text-gray-500">
					<div class="max-w-fit text-sm xl:text-base text-black font-semibold truncate">{{ $response->post->title }}</div>
					<div class="text-sm truncate">{{ strip_tags($response->thread->getLatestMessageAttribute()->body) }}</div>
					<div class="max-w-fit text-xs flex truncate">
						<span class="font-semibold">{{ $interlocutors[$response->id] }}</span> -
						{{ $response->thread->updated_at->format('d/m/Y') }}
					</div>
				</div>
			</div>
			@if ($nbUnreads > 0)
				<div class="absolute top-1 right-1 inline-flex justify-center items-center size-5 rounded-full border-2 bg-red-500 group-hover:bg-red-600 border-white transition duration-150 ease-in-out text-white text-xs font-semibold">{{ $nbUnreads }}</div>
			@endif
		</a>
	@endforeach
</div>
