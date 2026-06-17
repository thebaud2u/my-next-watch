<div
	x-data="{width:(window.innerWidth>0)?window.innerWidth:screen.width,
		current:1,max:{{ $nbElements }},nb:{{ $display[array_key_first($display)] }},display:1,displayed:1,
		{{ ($autoplay) ? 'int:null,play:function(){this.int=setInterval(()=>{this.next()},5000)},pause:function(){clearInterval(this.int);this.int=null},' : '' }}
		prev:function(){this.current=(this.current==1)?this.max:this.current-1;this.displayed=(this.current-1)*this.nb+1},
		next:function(){this.current=(this.current==this.max)?1:this.current+1;this.displayed=(this.current-1)*this.nb+1},
		goto:function(step){this.current=step;this.displayed=(this.current-1)*this.nb+1},
		resized:function(){
			this.width=(window.innerWidth>0)?window.innerWidth:screen.width;
			this.max=@foreach($display as $res => $nb){{ ($res == 'max') ? ($nbElements / $nb) : '(this.width<'.$res.')?'.($nbElements / $nb).':' }}@endforeach;
			this.nb=@foreach($display as $res => $nb){{ ($res == 'max') ? $nb : '(this.width<'.$res.')?'.$nb.':' }}@endforeach;
			this.display=@foreach($display as $res => $nb){{ ($res == 'max') ? $nb : '(this.width<'.$res.')?'.$nb.':' }}@endforeach;
			this.current=Math.floor((this.displayed-1)/this.nb+1)
		}}"
	x-on:resize.window="resized()" x-init="$nextTick(()=>{resized(){{ ($autoplay) ? ';play()' : '' }}})"
	class="relative w-full h-auto {{ (empty($classes)) ? '' : $classes }}">
	<div class="w-full h-auto flex flex-row items-stretch justify-center">
		{{ $slot }}
	</div>
	<div class="mt-6 flex flex-row items-center justify-center"
		x-show="max<=6">
		@if($autoplay)
			<button x-show="int!=null" x-on:click.prevent="pause()" class="me-4 text-mnw-deepblue/80" title="{{ __('Pause') }}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
					<path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
				</svg>
			</button>
			<button x-show="int==null" x-on:click.prevent="play()" class="me-4 text-mnw-deepblue/80" title="{{ __('Autoplay') }}">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
				</svg>
			</button>
		@endif
		@for($i=0; $i<$nbElements; $i++)
			<button class="flex w-4 h-4 me-3 rounded-full bg-mnw-deepblue/30 hover:bg-mnw-deepblue/80"
				x-bind:class="{'bg-mnw-deepblue/60 hover:bg-mnw-deepblue':current=={{ $i + 1 }}}"
				x-show="max>{{ $i }}" x-on:click.prevent="goto({{ $i + 1 }})"></button>
		@endfor
	</div>
	<div class="mt-6 flex flex-row items-center justify-center"
		x-show="max>6">
		<button x-on:click.prevent="prev()" class="cursor-pointer group text-mnw-deepblue/80 focus:outline-none" title="{{ __('Previous') }}">
			<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"></path>
			</svg>
			<span class="sr-only">{{ __('Previous') }}</span>
		</button>
		<div class="mx-3 text-sm font-bold"><span x-text="current"></span> / <span x-text="max"></span></div>
		@if($autoplay)
			<button x-show="int!=null" x-on:click.prevent="pause()" class="mr-3 text-mnw-deepblue/80" title="{{ __('Pause') }}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
					<path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
				</svg>
			</button>
			<button x-show="int==null" x-on:click.prevent="play()" class="mr-3 text-mnw-deepblue/80" title="{{ __('Autoplay') }}">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
				</svg>
			</button>
		@endif
		<button x-on:click.prevent="next()" class="cursor-pointer group text-mnw-deepblue/80 focus:outline-none" title="{{ __('Next') }}">
			<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"></path>
			</svg>
			<span class="sr-only">{{ __('Next') }}</span>
		</button>
	</div>
	@if($buttons == 'small')
		<button x-on:click.prevent="prev()" class="absolute top-0 -left-4 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none">
			<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-mnw-deepblue/20 group-hover:bg-mnw-deepblue group-focus:outline-none">{{-- group-focus:ring-2 group-focus:ring-mnw-deepblue/80 --}}
				<svg class="mr-0.5 w-3 h-3 text-mnw-deepblue/80 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"></path>
				</svg>
				<span class="sr-only">{{ __('Previous') }}</span>
			</span>
		</button>
		<button x-on:click.prevent="next()" class="absolute top-0 -right-4 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none">
			<span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-mnw-deepblue/20 group-hover:bg-mnw-deepblue group-focus:outline-none">{{-- group-focus:ring-2 group-focus:ring-mnw-deepblue/80 --}}
				<svg class="ml-0.5 w-3 h-3 text-mnw-deepblue/80 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"></path>
				</svg>
				<span class="sr-only">{{ __('Next') }}</span>
			</span>
		</button>
	@else
		<button x-on:click.prevent="prev()" class="absolute top-0 -left-6 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none text-6xl">
			<svg class="h-8 w-8 s:h-12 s:w-12 text-mnw-deepblue/80" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
			</svg>
			<span class="sr-only">{{ __('Previous') }}</span>
		</button>
		<button x-on:click.prevent="next()" class="absolute top-0 -right-6 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none text-6xl">
			<svg class="h-8 w-8 s:h-12 s:w-12 text-mnw-deepblue/80" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
			</svg>
			<span class="sr-only">{{ __('Next') }}</span>
		</button>
	@endif
</div>
