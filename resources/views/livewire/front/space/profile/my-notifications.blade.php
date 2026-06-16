<div wire:init="loadNotifications" class="flex flex-col w-full justify-center p-6 gap-4 my-4 text-jobboard-deepblue @if($isMenu) max-w-[500px] @endif">
	@if(!$loaded)
		<x-front.secondary-button>
			<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
				<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
			</svg>

			{{ __('Loading ...') }}
		</x-front.secondary-button>
	@else
		<div class="font-bold text-jobboard-deepblue text-[28px] mb-4 @if(!$isMenu) mx-auto @endif">
			{{ _('Notification') }}
		</div>
		<div class="flex flex-row w-full justify-center items-center mb-4">
			<div class="flex flex-row justify-center items-center rounded-full w-[350px] md:w-[458px] mx-auto" x-data="{ tab: @entangle('tab') }">
				<div wire:click="showNotifications('all')" x-on:click="tab = 'all'" :class="tab == 'all' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue rounded-l-full flex justify-center items-center font-bold text-jobboard-cream text-sm px-1 py-3 cursor-pointer">
					{{ __('All notifications') }}
				</div>

				<div wire:click="showNotifications('notRead')" x-on:click="tab = 'notRead'" :class="tab == 'notRead' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue flex justify-center items-center font-bold text-jobboard-cream text-sm px-1 py-3 cursor-pointer">
					{{ __('Not read') }}
				</div>

				<div wire:click="showNotifications('read')" x-on:click="tab = 'read'" :class="tab == 'read' ? '' : 'opacity-50'" class="w-full h-full bg-jobboard-deepblue rounded-r-full flex justify-center items-center font-bold text-jobboard-cream text-sm px-1 py-3 cursor-pointer">
					{{ __('Read') }}
				</div>
			</div>
		</div>

		<div class="flex flex-col gap-4 text-jobboard-deepblue">
			@if($notifications->isNotEmpty())
				@foreach($notifications as $notification)
					@php
						$notRead = false;

						if(in_array($notification->id, $notReadNotifications)) $notRead = true;
					@endphp

					<div @if($notRead) wire:click="markAsRead('{{ $notification->id }}', '{{ $notification->data['url'] }}')" @else wire:click="redirectTo('{{ $notification->data['url'] }}')" @endif @if($isMenu)class="max-w-[500px]" @endif>
						<div class="flex flex-row py-4 border-b justify-between items-center w-full">
							<p class="break-words text-sm leading-tight hyphens-auto whitespace-normal mr-4">
								{{ $notification->data['body'] }}
							</p>

							<div class="flex flex-col items-end gap-y-4">
								<span class="text-sm text-gray-400">
									{{ $notification->created_at->diffForHumans() }}
								</span>

								@if($notRead)
									<span class="w-[10px] h-[10px] rounded-full bg-jobboard-coral"></span>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="flex flex-row justify-center p-4">
					{{ __('No notifications yet') }}
				</div>
			@endif
		</div>

		@if($showLink)
			<div class="flex flex-row justify-center items-center w-[350px] mx-auto text-jobboard-deepblue font-bold p-4">
				<a href="{{ route('space.profile.my-notifications') }}">
					{{ __('Show all the notifications') }}
				</a>
			</div>
		@endif
	@endif
</div>