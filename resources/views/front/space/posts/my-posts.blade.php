<x-space-layout :breadcrumb="'my-posts'">
	<x-slot name="side_menu">
		<livewire:front.space.posts.side-menu :wire:key="'side-menu'" />
	</x-slot>

	<livewire:front.space.posts.slot :wire:key="'slot'" />
</x-space-layout>
