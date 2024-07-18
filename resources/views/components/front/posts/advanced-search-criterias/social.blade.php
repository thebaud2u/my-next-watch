{{-- Notice type --}}
<div class="py-4 border-b-2 border-annonces-transparentgray mt-4">
	<div x-data="{
		deploy: false,
		tLbl:'{{ str_replace("'", "\\'", __('Notice types')) }}',
		checkEls:function() {
			t = [];
			els = document.querySelectorAll('[id^=notice_types_checkbox_]');
			[...els].map((el, key) => {
				if(el.checked) t.push(el.value);
			});

			this.tLbl = '{{ str_replace("'", "\\'", __('Notice types')) }} '+((t.length > 0) ? '[ '+t.length+' ]' : '');
		}
	}" x-init="$nextTick(() => { checkEls() })" wire:key="wire_key_notice_types">
		<div class="bg-white lg:flex-1 px-2 py-1 text-annonces-gray">
			<div class="relative mt-1" x-data="{ open:false }" x-on:click.outside="open=false" x-on:close.stop="open=false">
				<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
					<input type="text" readonly x-bind:value="tLbl" class="block w-full p-0 font-semibold text-annonces-gray text-sm xl:text-base border-none focus:ring-0 focus:outline-none cursor-pointer" />
					<span class="inline-block text-annonces-gray" x-show="deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
						</svg>
					</span>

					<span class="inline-block text-annonces-gray" x-show="!deploy">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
						</svg>
					</span>
				</span>

				<div x-show="deploy" x-transition class="mt-4 p-4">
					<div>
						@foreach($criterias['notice-type'] as $noticeType)
							<div wire:key="notice-types-{{ $noticeType->id }}" class="flex items-center py-1 text-annonces-blue">
								<input type="checkbox" id="notice_types_checkbox_{{ $noticeType->id }}" value="{{ $noticeType->id }}" x-on:click="checkEls()" wire:model="filters.notice_types" wire:change="search" class="w-4 h-4 text-annonces-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
								<label for="notice_types_checkbox_{{ $noticeType->id }}" class="ml-2 text-xs lg:text-sm cursor-pointer">{{ $noticeType->name }}</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Closing date --}}
<div x-data="{ deploy: false }" class="flex flex-col py-4 border-b-2 border-annonces-transparentgray mt-4 lg:flex-1 pr-2 pl-0 text-annonces-gray">
	<span x-on:click="deploy = !deploy" class="flex flex-row cursor-pointer">
		<span class="flex-1 font-semibold text-annonces-gray">
			{{ __('Closing date') }}
		</span>

		<span class="inline-block text-annonces-gray" x-show="deploy">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
			</svg>
		</span>

		<span class="inline-block text-annonces-gray" x-show="!deploy">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
			</svg>
		</span>
	</span>

	<div x-show="deploy" x-transition class="mt-4 p-4">
		<x-front.text-input type="date" name="filters.closing_date_min" wire:model="filters.closing_date_min" placeholder="{{ __('Minimum closing date') }}" min="{{ \Carbon\Carbon::now() }}" :class="'mt-1 inline-block bg-white w-full'" />

		<x-front.text-input type="date" name="filters.closing_date_max" wire:model="filters.closing_date_max" placeholder="{{ __('Maximum closing date') }}" :class="'mt-1 inline-block ml-4 bg-white w-full'" />
	</div>
</div>
