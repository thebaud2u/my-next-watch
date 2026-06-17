<div class="hidden xlsm:flex xlsm:flex-row xlsm:items-center max-w-[1200px] text-xs xlsm:justify-between xlsm:gap-x-14 xlsm:text-sm xl:text-base leading-5 w-full" x-data="{showNotifications: false}">
	<div class="flex gap-x-4 items-center" @mouseover="showNotifications= false">
		{{-- Logo --}}
		<div class="shrink-0 flex items-center z-40 mr-4 h-[100px] w-auto">
			<x-front.logo :link="true" :href="route('home')" />
		</div>
	</div>
</div>
