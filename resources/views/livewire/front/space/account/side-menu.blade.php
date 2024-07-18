<div>
	<x-front.space.sidebar-link :active="($active == 'account') ? true : false" wire:click="sideMenuChange('account')">
		{{ __('My account') }}
	</x-front.space.sidebar-link>

	<x-front.space.sidebar-link :active="($active == 'profile') ? true : false" wire:click="sideMenuChange('profile')">
		{{ __('My profile') }}
	</x-front.space.sidebar-link>
</div>
