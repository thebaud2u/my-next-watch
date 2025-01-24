<div class="flex flex-col md:flex-row md:justify-stretch md:h-full">{{-- max-md:space-y-4 md:space-x-4 --}}
	@if(empty($response->id))
		{{-- <div class="grow shadow-lg md:flex md:flex-col md:items-center md:rounded-r-md lg:rounded-l-md bg-white p-3"> --}}
		<div class="grow shadow-lg flex flex-col items-center md:rounded-l-md lg:rounded-md bg-white p-3">
			<div>
				<div class="my-6 text-center text-mnw-blue">
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
					Vous n'avez pas encore de messages
				</h2>

				<p class="my-6 text-center">
					Simple et rapide, la messagerie vous permet d'échanger avec les annonceurs et clients de TÉMA Petites Annonces.
					Bon à savoir : la mise en relation s'effectue toujours depuis une annonce en cliquant sur “Contacter l'annonceur”.
				</p>

				<div class="my-6 text-center">
					<a href="{{ route('posts') }}">
						<x-primary-button type="button">
							Faire une recherche
						</x-primary-button>
					</a>
				</div>
			</div>
		</div>
	@else
		<div x-bind:class="(small&&thread)?'block':'hidden'" class="flex-none md:rounded-r-md lg:rounded-md shadow-lg bg-white mb-4 p-3"{{-- md:hidden --}}>
			<a href="#" class="group" x-on:click.prevent="thread=false">
				<div class="inline-flex flex-row items-center mt-3 text-sm xl:text-base text-mnw-blue group-hover:text-mnw-darkblue font-semibold">
					<svg class="size-5 xl:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
					</svg>

					<span class="ml-3 group-hover:underline">
						Liste des conversations
					</span>
				</div>
			</a>
		</div>

		<div x-bind:class="(!small||thread)?'block':'hidden'" class="md:grow max-md:order-last shadow-lg md:rounded-r-md lg:rounded-md bg-white p-3">
			@if($messages->isNotEmpty())
				{{-- Flash message --}}
				@if(Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info'))
					<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
						@include('components.front.home.alert-message')
					</div>
				@endif

				<ul class="flex flex-col space-y-4 mt-4">
					@foreach ($messages as $msg)
						@if($msg->user_id == Auth::guard('web')->user()->id)
							@php
								$unread = ($interlocutorUnreadMessages->contains($msg->id));
							@endphp
							<li class="group">
								<div class="flex gap-x-3 flex-row-reverse">
									<div class="shrink-0">
										<div class="flex justify-center items-center size-8 rounded-full bg-mnw-lightblue text-mnw-darklightblue text-sm font-semibold">
											{{ \Illuminate\Support\Str::acronym($msg->user_name) }}
										</div>
									</div>

									<div class="flex max-w-sm flex-col gap-y-2 items-end" @if($unread) title="{{ __('Message sent but not read yet') }}" @endif >
										<div class="rounded-lg rounded-tr-none bg-mnw-lightblue px-3 py-2 text-sm xl:text-base text-black">
											<div class="mb-2">
												{!! nl2br(e($msg->body)) !!}
											</div>

											<div class="flex flex-row justify-end items-center text-xs text-right text-gray-400 font-semibold">
												<span>
													{{ $msg->created_at->format('d.m.y - H:i') }}
												</span>

												<svg class="size-4 {{ ($unread) ? '' : 'text-gray-500' }} ml-3" viewBox="0 0 16 10" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1.33203 5.80001L4.00367 9L10.6654 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													@if(!$unread)
														<path d="M7.83398 8.2L8.50563 9L15.1673 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													@endif
												</svg>
											</div>
										</div>
									</div>
								</div>
							</li>
						@else
							@php
								$unread = ($unreadMessages->contains($msg->id));
							@endphp
							@if(!empty($unreadMessages) && $unread && empty($notified))
								@php $notified = true; @endphp
								<li>
									<div class="h-2.5 mb-8 border-b border-mnw-transparentgray text-sm text-center text-gray-500">
										<span class="bg-white px-4" >
											{{ trans_choice('[0,1] :nb unread message|[2,*] :nb unread messages', $unreadMessages->count(), ['nb' => $unreadMessages->count()]) }}
										</span>
									</div>
								</li>
							@endif

							<li class="group">
								<div class="flex gap-x-3">
									<div class="shrink-0">
										<div class="flex justify-center items-center size-8 rounded-full bg-gray-100 text-gray-500 text-sm font-semibold">
											{{ \Illuminate\Support\Str::acronym($msg->user_name) }}
										</div>
									</div>

									<div class="flex max-w-sm flex-col items-start gap-y-2">
										<div class="rounded-lg rounded-tl-none bg-gray-100 px-3 py-2 text-sm xl:text-base text-black">
											<div class="mb-2">
												{!! nl2br(e($msg->body)) !!}
											</div>

											<div class="flex flex-row justify-end items-center text-xs text-right text-gray-400 font-semibold">
												<span>
													{{ $msg->created_at->format('d.m.y - H:i') }}
												</span>

												<svg class="size-4 {{ ($unread) ? '' : 'text-gray-500' }} ml-3" viewBox="0 0 16 10" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1.33203 5.80001L4.00367 9L10.6654 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													@if(!$unread)
														<path d="M7.83398 8.2L8.50563 9L15.1673 1"stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													@endif
												</svg>
											</div>
										</div>
									</div>
								</div>
							</li>
						@endif
					@endforeach

					<li class="pt-6">
						<form wire:submit="send">
							@error('title')
								<div class="error mb-3">
									{{ $message }}
								</div>
							@enderror

							<textarea row="3" wire:model="new" placeholder="Écrivez votre message ..." class="block w-full text-black border-mnw-darkerwhite text-sm xl:text-base bg-white border mb-3 p-2 focus:border-mnw-blue focus:ring-0 rounded-md">{{ $new }}</textarea>

							<div class="text-right">
								<x-primary-button>
									Envoyer
								</x-primary-button>
							</div>
						</form>
					</li>
				</ul>
			@else
				<p>
					{{ __('No message in thread') }} !
				</p>
			@endif
		</div>

		<div x-bind:class="(!small||thread)?'block':'hidden'" class="flex-none md:w-[45%] md:max-w-[300px] md:rounded-l-md lg:rounded-md max-md:mb-4 md:ml-4 bg-white shadow-lg p-3">
			<div class="flex flex-row items-center border-b border-mnw-transparentgray pb-3">
				@foreach($participants as $participant)
					{{-- Auteur de l'annonce --}}
					{{-- @if($participant->user_id == $post->user_id)
						<div class="shrink-0 flex justify-center items-center size-12 rounded-full
							@if($participant->self == 1)
								bg-mnw-lightblue text-mnw-darklightblue
							@else
								bg-gray-100 text-gray-500
							@endif
							text-xl font-semibold mr-3">
							{{ \Illuminate\Support\Str::acronym($participant->user_name) }}
						</div>
						<div class="text-lg font-semibold truncate">
							<span title="{{ $participant->user_name }}">{{ $participant->user_name }}</span>
						</div>
					@endif --}}
					{{-- Interlocuteur --}}
					@if(empty($participant->self))
						<div class="shrink-0 flex justify-center items-center size-12 rounded-full bg-gray-100 text-gray-500 text-xl font-semibold mr-3">
							{{ \Illuminate\Support\Str::acronym($participant->user_name) }}
						</div>

						<div class="text-base xl:text-lg font-semibold truncate">
							<span title="{{ $participant->user_name }}">
								{{ $participant->user_name }}
							</span>
						</div>
					@endif
				@endforeach
			</div>

			@if(!empty($post))
				<h2 class="my-4 text-base xl:text-lg font-semibold {{ (empty($post->deleted_at)) ? '' : 'opacity-50' }}">
					{{ $post->title }}
				</h2>

				<div class="flex flex-row items-center {{ (empty($post->deleted_at)) ? 'border-b border-mnw-transparentgray pb-3' : 'opacity-50' }}">
					<div class="flex-none flex justify-center items-center size-20 aspect-square rounded bg-gray-100 text-gray-300">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
							<path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
							<path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
						</svg>
					</div>

					<div class="grow p-3 text-sm xl:text-base text-gray-400">
						<div class="max-w-fit flex flex-row items-center mb-1 font-semibold text-black truncate">
							<svg class="size-5" viewBox="0 0 20 21" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 19.4927C14.9706 19.4927 19 15.4632 19 10.4927C19 5.52211 14.9706 1.49268 10 1.49268C5.02944 1.49268 1 5.52211 1 10.4927C1 15.4632 5.02944 19.4927 10 19.4927Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M14.0293 7.18365C12.202 5.35557 9.23917 5.35557 7.41181 7.18293C5.58445 9.01029 5.58373 11.9738 7.41181 13.8012C9.23917 15.6292 12.202 15.6292 14.0293 13.8012" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M5.32031 9.4126H11.8003" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M5.32031 11.5728H11.8003" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							<span class="ml-2">
								{{ (empty($post->values_web['price'])) ? '-' : $post->values_web['price'].((is_numeric($post->values_web['price'])) ? ' €' : '') }}
							</span>
						</div>

						<div class="flex flex-row items-center mb-1 truncate">
							@php
								/** Location */
								if ($city = $post->address?->city->name ?? $post->address?->custom_city) {
									$code = $post->address?->city->zip_code ?? ($post->address?->department?->code ?? null);
									$location = $city .($code ? ' ('.$code.')' : '');
								}
								else if ($departement = $post->address?->department?->name) {
									$code = $post->address?->department?->code ?? null;
									$location = $departement .($code ? ' ('.$code.')' : '');
								}
								else if ($region = $post->address?->region?->name) $location = $region;
								else if ($country = $post->address?->country?->name) $location = $country;
								else $location = __('Unknown location');
							@endphp
							<svg class="size-5" viewBox="0 0 21 22" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.3636 9.18206C17.3636 14.7093 9.18182 21.0002 9.18182 21.0002C9.18182 21.0002 1 14.7093 1 9.18206C1 3.65479 4.66364 1.00024 9.18182 1.00024C13.7 1.00024 17.3636 3.65479 17.3636 9.18206Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M9.18129 11.9092C11.1896 11.9092 12.8176 10.2811 12.8176 8.27284C12.8176 6.26453 11.1896 4.63647 9.18129 4.63647C7.17298 4.63647 5.54492 6.26453 5.54492 8.27284C5.54492 10.2811 7.17298 11.9092 9.18129 11.9092Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							<span class="ml-2">
								{{ $location }}
							</span>
						</div>

						<div class="flex flex-row items-center mb-1 truncate">
							<svg class="size-5" viewBox="0 0 21 23" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 1.50781V4.50781" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M14 1.50781V4.50781" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M1.5 8.59766H18.5" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M19 8.00781V16.5078C19 19.5078 17.5 21.5078 14 21.5078H6C2.5 21.5078 1 19.5078 1 16.5078V8.00781C1 5.00781 2.5 3.00781 6 3.00781H14C17.5 3.00781 19 5.00781 19 8.00781Z" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.6953 13.208H13.7043" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.6953 16.208H13.7043" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M9.99609 13.208H10.0051" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M9.99609 16.208H10.0051" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M6.29492 13.208H6.3039" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M6.29492 16.208H6.3039" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

							<span class="ml-2">
								{{ ucfirst($post->published_at->diffForHumans()) }}
							</span>
						</div>
					</div>
				</div>

				@if(!empty($post->deleted_at))
					<div class="border-b border-mnw-transparentgray pb-3">
						<div class="inline-flex flex-row items-center mt-3 text-sm xl:text-base text-red-500 font-semibold">
							<svg class="size-5 xl:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
							</svg>

							<span class="ml-3">
								Annonce supprimée
							</span>
						</div>
					</div>
				@endif

				<a href="#" x-on:click.prevent="$dispatch('open-modal','delete-response-{{ $response->id }}')" class="group">
					<div class="inline-flex flex-row items-center mt-3 text-sm xl:text-base text-mnw-blue group-hover:text-mnw-darkblue font-semibold">
						<svg class="size-5 xl:size-6" viewBox="0 0 18 22" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M16.0051 7.05762V19.1031C16.0051 20.1506 15.1556 20.9999 14.1076 20.9999H4.0188C2.97077 20.9999 2.12109 20.1508 2.12109 19.1031V7.05762" stroke-width="1.5" stroke-miterlimit="10"/>
							<path d="M2.26388 3.82782H15.9356C16.6331 3.82782 17.1997 4.39389 17.1997 5.09128V6.9421H1V5.0911C1 4.39389 1.56635 3.82764 2.26407 3.82764L2.26388 3.82782Z" stroke-width="1.5" stroke-miterlimit="10"/>
							<path d="M5.51562 3.73339V2.0146C5.51562 1.45425 5.9701 1 6.53071 1H11.5968C12.1575 1 12.6119 1.45425 12.6119 2.0146V3.73339" stroke-width="1.5" stroke-miterlimit="10"/>
							<path d="M6.72266 9.64014V17.8469" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
							<path d="M11.4766 9.64014V17.8469" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
						</svg>

						<span class="ml-3 group-hover:underline">
							Supprimer la conversation
						</span>
					</div>
				</a>

				<x-modal name="delete-response-{{ $response->id }}" width="w-full max-w-2xl" wire:key="delete-response-{{ $response->id }}" focusable>
					<section class="p-10">
						<header class="flex flex-col flex-wrap content-center">
							<div class="mt-1 mb-6 text-sm m-auto text-mnw-blue">
								<svg class="size-12" viewBox="0 0 18 22" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16.0051 7.05762V19.1031C16.0051 20.1506 15.1556 20.9999 14.1076 20.9999H4.0188C2.97077 20.9999 2.12109 20.1508 2.12109 19.1031V7.05762" stroke-width="1.5" stroke-miterlimit="10"/>
									<path d="M2.26388 3.82782H15.9356C16.6331 3.82782 17.1997 4.39389 17.1997 5.09128V6.9421H1V5.0911C1 4.39389 1.56635 3.82764 2.26407 3.82764L2.26388 3.82782Z" stroke-width="1.5" stroke-miterlimit="10"/>
									<path d="M5.51562 3.73339V2.0146C5.51562 1.45425 5.9701 1 6.53071 1H11.5968C12.1575 1 12.6119 1.45425 12.6119 2.0146V3.73339" stroke-width="1.5" stroke-miterlimit="10"/>
									<path d="M6.72266 9.64014V17.8469" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
									<path d="M11.4766 9.64014V17.8469" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
								</svg>
							</div>

							<h2 class="text-lg text-center font-semibold">
								Vous êtes sur(e) de vouloir supprimer cette conversation ?
							</h2>

							<p class="text-base text-center italic my-4">
								&laquo; {{ $post->title }} &raquo;
							</p>
						</header>

						<div class="flex flex-row mt-4 justify-center">
							<form method="post" action="{{ route('space.responses.hide', ['response' => $response]) }}">
								@method('delete')
								@csrf

								<x-primary-button class="mr-6">
									Oui, supprimer
								</x-primary-button>
							</form>

							<x-secondary-button x-on:click="$dispatch('close')">
								Non, revenir à la conversation
							</x-secondary-button>
						</div>
					</section>
				</x-modal>
			@endif

			<div class="hidden" x-data="{mark:function(){setTimeout(()=>{if(this.thread&&this.resp>0){$dispatch('read')}},500)}}"
				x-init="$nextTick(()=>{resp={{ $response->id }};mark()})"></div>
		</div>
	@endif
</div>
