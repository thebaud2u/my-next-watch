<div>
	<div class="border-transparent">
		<div class="flex flex-col s:flex-row lg:min-h-[600px] border-transparent">
			<div class="flex-1 mt-4">
				@if($favorites->isNotEmpty())
					<div class="flex flex-row justify-start flex-wrap gap-4">
						@foreach($favorites as $favorite)
							@if($type == 'posts')
								@if($favorite instanceof \App\Models\Animal)
									{{-- Si l'animal est associé à une portée, c'est un enfant --}}
									@if($favorite->litters->isNotEmpty())
										@php
											$post = $favorite->getPostFromLitter();
										@endphp

										<livewire:front.animals.litter-animals.litter-animal
											:animal="$favorite"
											:litter="$favorite->litters->first()"
											:smallCards="true"
											:showTitle="false"
											:showCount="false"
											:post="$post"
											:postDisplay="true"
											:key="'litter-animal-'.$favorite->id" />
									@else
										@php
											$post = $favorite->post;
										@endphp

										<livewire:front.animals.breeders.breeder
											:animal="$favorite"
											:company="$favorite->company"
											:smallCards="true"
											:showTitle="false"
											:showCount="false"
											:post="$post"
											:postDisplay="true"
											:key="'breeder-'.$favorite->id" />
									@endif
								@elseif($favorite instanceof \App\Models\Post)
									@php
										$post = $favorite;
									@endphp

									@if($post->type->getTranslation('slug', 'en') == 'litter-yet-to-come')
										@include('components.front.posts.litter-yet-to-come-card')
									@elseif($post->type->getTranslation('slug', 'en') == 'litter' && $post->model->animals->isEmpty())
										@include('components.front.posts.litter-card')
									@endif
								@endif
							@elseif($type == 'breeds')
								@php
									$breed = $favorite;
								@endphp
								@include('components.front.breeds.card')
							@elseif($type == 'breed-clubs')
								@php
									$breedClub = $favorite;
								@endphp
								<a href="{{ route('breed-club-search.breed-club.show', ['breedClub' => $breedClub->slug]) }}">
									@include('components.front.space.breed-clubs.card')
								</a>
							@elseif($type == 'companies')
								@php
									$company = $favorite;
								@endphp
								@include('components.front.companies.card')
							@elseif($type == 'professionnal-activities')
								@php
									$professionnalActivity = $favorite;
								@endphp
								<a href="{{ route('space.professionnal-activities.my-professionnal-activity', ['professionnalActivity' => $professionnalActivity->slug]) }}">
									@include('components.front.space.professionnal-activities.card')
								</a>
							@endif
						@endforeach

						<div class="mt-8">
							{!! $favorites->links() !!}
						</div>
					</div>
				@else
					<div class="flex flex-col p-6 gap-y-4 justify-center items-center">
						{{ __('You haven\'t favorited :element', ['element' => __('any '.$type)]) }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
