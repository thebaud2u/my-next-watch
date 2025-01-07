<div>
	<div class="py-5 px-4 lg:px-6">
		<div class="flex flex-col s:flex-row lg:min-h-[600px]">
			<div class="flex-1">
				<div class="flex flex-row justify-between">
					<x-front.space.space-title>
						{{ __('My saved searches') }}
					</x-front.space.space-title>

					<div class="justify-right">
						<a href="{{ route('posts') }}">
							<x-front.primary-button type="button">
								Faire une recherche
							</x-front.primary-button>
						</a>
					</div>
				</div>

				<div wire:key="alert">
					{{-- Flash message --}}
					@if ($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
						<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
							@include('components.front.home.alert-message')
						</div>
					@endif
				</div>

				{{-- <div>{{ \Carbon\Carbon::now()->format('H:i:s') }}</div> --}}

				@if ($searches->isNotEmpty())
					<div>
						@foreach ($searches as $search)
							<a href="{{ route('posts', [
								'thematic' => $search->thematic ?? null,
								'postType' => $search->postType ?? null,
								'search' => $search,
							]) }}" class="group block mt-4 cursor-pointer">
								<article class="relative min-w-[250px]
									flex flex-col sm:flex-row justify-center sm:items-stretch rounded bg-white opacity-60 hover:opacity-90 hover:bg-gray-50 border border-gray-100 hover:border-gray-200">
									{{-- <div class="overflow-hidden sm:flex-none flex justify-center items-stretch w-full sm:max-w-[200px] h-[173px] rounded-t sm:rounded-l sm:rounded-tr-none">
										<img src="https://dev-annonces.tema-media.fr/storage/8/conversions/img0-optimized.jpg" alt="Jonathan Gimbel" class="object-cover w-full rounded-t-sm sm:rounded-none" :class="hoverOn ? 'scale-[1.15] transition-transform duration-700': ''">
									</div> --}}
									<div class="sm:grow p-4 max-sm:pt-10 sm:pl-12 text-xs lg:text-sm">
										{{-- <div class="float-right text-right ml-4 sm:mt-6 mr-4 sm:mr-0">
											<div class="flex justify-end items-center mt-1 text-gray-600 font-semibold ">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 lg:w-5 lg:h-5 mr-1">
													<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
													<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
												</svg>
												Déjà vu
											</div>
										</div> --}}
										<h2 class="mb-2 text-sm sm:text-base xl:text-lg font-semibold leading-normal text-black group-hover:text-mnw-blue">
											{{ $search->name }}
										</h2>
										<div class="mb-2 text-black transition duration-200 ease-in-out">
											<span class="capitalize font-semibold">
												{{ $search->updated_at->format('d/m/Y') }}
											</span>
										</div>


										<div class="text-gray-400 ">
											<div class="inline-flex items-center mr-4">
												<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
													<path d="M10.9969 21C16.5198 21 20.9969 16.5228 20.9969 11C20.9969 5.47715 16.5198 1 10.9969 1C5.4741 1 0.996948 5.47715 0.996948 11C0.996948 16.5228 5.4741 21 10.9969 21Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M15.4738 7.32233C13.4434 5.29113 10.1514 5.29113 8.121 7.32153C6.0906 9.35193 6.0898 12.6447 8.121 14.6751C10.1514 16.7063 13.4434 16.7063 15.4738 14.6751" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M5.797 9.80078H12.997" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M5.797 12.1992H12.997" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												180€
											</div>
											<div class="inline-flex items-center mr-4">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
													<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
													<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
												</svg>
												Metz (57000)
											</div>
											<div class="inline-flex items-center mr-4">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
													<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"></path>
												</svg>
												{{ ucfirst($search->updated_at->diffForHumans()) }}
											</div>
										</div>

										{{-- <span class="block w-fit px-3 py-1 my-2 md:mr-2 rounded-md font-light inline-block bg-mnw-otherlightblue font-semibold text-sm">
											Catégorie
										</span> --}}
									</div>
									{{-- <div class="absolute bottom-4 right-4" title="Dans mes favoris">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 pointer-events-none">
											<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path>
										</svg>
									</div> --}}
								</article>
							</a>

						@endforeach
					</div>
				@else
					<div x-data="{}" class="py-5 px-4 lg:px-6 flex flex-col items-center">
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
				@endif
			</div>
		</div>
	</div>
</div>
