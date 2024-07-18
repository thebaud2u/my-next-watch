<x-space-layout :breadcrumb="'my-searches'">
	<x-slot name="side_menu">
		<livewire:front.space.searches.side-menu :wire:key="'side-menu'" />
	</x-slot>

	<livewire:front.space.searches.slot :wire:key="'slot'" />
</x-space-layout>

{{-- <x-space-layout :breadcrumb="'my-searches'">

	<x-slot name="side_menu">
		Side menu
	</x-slot>

	<div x-data="{}" class="py-5 px-4 lg:px-6 flex flex-col items-center">
        @if(empty(false))
                {{-- <div class="grow shadow-lg md:flex md:flex-col md:items-center md:rounded-r-md lg:rounded-l-md bg-white p-3"> -- }}
            {{-- <div class="grow shadow-lg flex flex-col items-center md:rounded-l-md lg:rounded-md bg-white p-3"> -- }}
                <div>
                    <div class="my-6 text-center text-annonces-blue">
                        <svg width="70" height="70" class="mx-auto" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.2371 13C46.7493 13 54.459 20.7481 54.459 30.3077C54.459 34.0115 53.2917 37.4365 51.3189 40.2519L54.459 47.6153L47.132 44.4596C44.3306 46.4422 40.9226 47.6153 37.2371 47.6153C27.7249 47.6153 20.0152 39.8673 20.0152 30.3077C20.0152 20.7481 27.7249 13 37.2371 13Z" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35.5664 51.0077C32.4225 55.2577 27.4032 58 21.7372 58C18.0518 58 14.6418 56.8231 11.8442 54.8423L4.51538 58L7.65932 50.6346C5.68646 47.8231 4.51538 44.3962 4.51538 40.6924C4.51538 32.5751 10.0685 25.7655 17.5791 23.8962H17.5887" stroke="#002C6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="33" y="23" width="8.66667" height="14" rx="4.33333" stroke="#002C6A" stroke-width="2"/>
                            <path d="M69.75 27.9875L54.75 13L62.849 13C66.6552 13 69.75 16.0798 69.75 19.8953L69.75 28" fill="#002C6A"/>
                            <path d="M50.1191 55.0125L35.1191 70H43.2181C47.0243 70 50.1191 66.9202 50.1191 63.1047V55" fill="#0082FF"/>
                            <path d="M0.249998 19.9834L20.25 -1.90735e-06L9.45133 -9.63299e-07C4.37645 -5.19639e-07 0.249997 4.1064 0.249997 9.19368L0.249998 20" fill="#0082FF"/>
                        </svg>
                    </div>

                    <h2 class="my-6 text-xl text-center font-bold">
                        Vous n'avez pas encore de recherche sauvegardée
                    </h2>

                    <p class="my-6 text-center">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                    </p>

                    <div class="my-6 text-center">
                        <a href="{{ route('posts') }}">
                            <x-front.primary-button type="button">
                                Faire une recherche
                            </x-front.primary-button>
                        </a>
                    </div>
                </div>
            {{-- </div> -- }}
        @endif
	</div>
</x-space-layout> --}}
