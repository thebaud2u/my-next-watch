<x-messaging-layout :response="$response" :breadcrumb="'messaging'">
	<x-slot name="side_menu">
		<div id="sidemenu" class="flex-1 w-full lg:flex-none lg:w-[30%] lg:max-w-[300px] lg:rounded-md shadow-lg bg-white py-3 pr-1">
			<livewire:front.space.messaging.search-slot :wire:key="'search-slot'" :response="$response" />
			<livewire:front.space.messaging.side-menu :wire:key="'side-menu'" :activeResponse="$response" />
		</div>
	</x-slot>
	<livewire:front.space.messaging.slot :wire:key="'slot'" :response="$response" />
</x-messaging-layout>
