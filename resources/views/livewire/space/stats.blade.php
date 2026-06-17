<div wire:init="loadStats" class="flex flex-col s:flex-row w-full items-center justify-center gap-4 my-4 text-mnw-deepblue">
	@if(!$loaded)
		<x-front.secondary-button>
			<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
				<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
			</svg>

			{{ __('Loading ...') }}
		</x-front.secondary-button>
	@else
		<div class="flex flex-row items-center gap-x-2 font-medium">
			<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.4999 25.8496C20.4011 25.8496 25.9957 20.2532 25.9957 13.3496C25.9957 6.44605 20.4011 0.849609 13.4999 0.849609C6.59869 0.849609 1.00415 6.44605 1.00415 13.3496C1.00415 20.2532 6.59869 25.8496 13.4999 25.8496Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M19.8528 9.10306C18.3331 7.58284 15.8738 7.58284 14.3541 9.10306L13.5035 9.95395L12.6529 9.10306C11.1332 7.58284 8.67389 7.58284 7.15419 9.10306C5.63448 10.6233 5.63448 13.0834 7.15419 14.6036L13.5071 20.9587L19.8599 14.6036C21.3796 13.0834 21.3796 10.6233 19.8599 9.10306H19.8528Z" stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			{{ $favorites > 1 ? __(':x favorites', ['x' => $favorites]) : __(':x favorite', ['x' => $favorites]) }}
		</div>

		<div class="border border-mnw-greige h-[25px] max-s:hidden"></div>

		<div class="flex flex-row items-center gap-x-2 font-medium">
			<svg width="31" height="26" viewBox="0 0 31 26" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M29.9959 13.3496C29.9959 13.3496 24.9524 22.8496 15.4959 22.8496C6.03933 22.8496 0.99585 13.3496 0.99585 13.3496C0.99585 13.3496 6.03933 3.84961 15.4959 3.84961C24.9524 3.84961 29.9959 13.3496 29.9959 13.3496Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.4958 19.0504C18.6294 19.0504 21.1697 16.4984 21.1697 13.3504C21.1697 10.2024 18.6294 7.65039 15.4958 7.65039C12.3622 7.65039 9.8219 10.2024 9.8219 13.3504C9.8219 16.4984 12.3622 19.0504 15.4958 19.0504Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			{{ $views > 1 ? __(':x views', ['x' => $views]) : __(':x view', ['x' => $views]) }}
		</div>

		<div class="border border-mnw-greige h-[25px] max-s:hidden"></div>

		<div class="flex flex-row items-center gap-x-2 font-medium">
			<svg width="21" height="26" viewBox="0 0 21 26" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18.5584 18.3557C19.4671 16.9018 19.9958 15.1918 19.9958 13.3496C19.9958 8.10396 15.7414 3.84961 10.4958 3.84961C5.25012 3.84961 0.995789 8.10396 0.995789 13.3496C0.995789 18.5953 5.25012 22.8496 10.4958 22.8496C12.338 22.8496 14.048 22.3209 15.5019 21.4122L19.9958 22.8496L18.5584 18.3557Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.77838 11.2852H14.2132" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.77838 15.416H11.7349" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			{{ $responses > 1 ? __(':x making contacts', ['x' => $responses]) : __(':x making contact', ['x' => $responses]) }}
		</div>
	@endif
</div>
