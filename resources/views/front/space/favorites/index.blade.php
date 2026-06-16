<x-space-layout>
	<x-slot name="side_menu">
		@include('components.front.space.profile.side-menu')
	</x-slot>

	<div class="flex-1 py-5">
		<div class="w-full bg-white px-6 py-10 mb-6 rounded-md text-jobboard-deepblue">
			<div x-data="{isActive : 'posts'}" class="flex flex-col gap-y-6">
				<div class="flex flex-row justify-center items-stretch rounded-full w-[350px] mx-auto font-bold">
					<div x-on:click="isActive = 'posts'" :class="isActive == 'posts' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue rounded-l-full flex justify-center items-center text-semibold text-jobboard-cream text-sm pl-5 px-4 py-3 cursor-pointer">
						{{ __('Posts') }}
					</div>

					<div x-on:click="isActive = 'breeds'" :class="isActive == 'breeds' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue flex justify-center items-center text-semibold text-jobboard-cream text-sm px-4 py-3 cursor-pointer">
						{{ __('Breeds') }}
					</div>

					<div x-on:click="isActive = 'breed-clubs'" :class="isActive == 'breed-clubs' ? '' : 'opacity-50'" class="whitespace-nowrap w-full h-full bg-jobboard-deepblue flex justify-center items-center text-semibold text-jobboard-cream text-sm px-4 py-3 cursor-pointer">
						{{ __('Breed clubs') }}
					</div>

					<div x-on:click="isActive = 'companies'" :class="isActive == 'companies' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue flex justify-center items-center text-semibold text-jobboard-cream text-sm px-4 py-3 cursor-pointer">
						{{ __('Companies') }}
					</div>

					<div x-on:click="isActive = 'professionnal-activity'" :class="isActive == 'professionnal-activity' ? '' : 'opacity-50'" class="whitespace-nowrap w-full h-full bg-jobboard-deepblue rounded-r-full flex justify-center items-center text-semibold text-jobboard-cream text-sm px-4 py-3 pr-5 cursor-pointer">
						{{ __('Professionnal activity') }}
					</div>
				</div>

				<div x-show="isActive == 'posts'">
					<livewire:front.space.favorites.my-favorites
						:type="'posts'"
						:key="'favorites-posts'" />
				</div>

				<div x-show="isActive == 'breeds'">
					<livewire:front.space.favorites.my-favorites
						:type="'breeds'"
						:key="'favorites-breeds'" />
				</div>

				<div x-show="isActive == 'breed-clubs'">
					<livewire:front.space.favorites.my-favorites
						:type="'breed-clubs'"
						:key="'favorites-breed-clubs'" />
				</div>

				<div x-show="isActive == 'companies'">
					<livewire:front.space.favorites.my-favorites
						:type="'companies'"
						:key="'favorites-companies'" />
				</div>

				<div x-show="isActive == 'professionnal-activity'">
					<livewire:front.space.favorites.my-favorites
						:type="'professionnal-activities'"
						:key="'favorites-professionnal-activity'" />
				</div>
			</div>
		</div>
	</div>
</x-space-layout>
