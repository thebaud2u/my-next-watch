<x-space-layout :currentThematic="$thematic" :currentPostType="$postType" :post="$post ?? null" :breadcrumb="(empty($change)) ? 'show-offers' : 'change-offer'">
	<livewire:front.space.posts.show-offers
		:thematic="$thematic"
		:postType="$postType"
		:post="$post"
		:wire:key="'show-offers'" />
</x-space-layout>
