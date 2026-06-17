<x-space-layout>
	<x-slot name="side_menu">
		@include('components.front.space.profile.side-menu')
	</x-slot>

	<livewire:front.space.profile.my-notifications :key="'notifications-component'" />
</x-space-layout>
