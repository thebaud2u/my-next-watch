<x-app-layout>
	@push('seo')
		<title>{{ __('Faq').' - '.env('APP_NAME').' JOB' }}</title>
	@endpush

	{{-- Page main title (home) --}}
	<x-slot name="mainTitle">
		<div class="h-[200px] bg-cover bg-center flex flex-col items-center justify-center bg-[url('/storage/header_background/background-5.jpg')]">
			<h1 class="mb-1 text-base lg:text-2xl font-bold text-white">
				{{ __('Faq') }}
			</h1>

			<h1 class="mb-1 text-base lg:text-2xl font-bold text-white">
				{{ ucfirst($type) }}
			</h1>
		</div>
	</x-slot>

	<div class="w-full">
		@if($faq)
			@if($faq->getPublishedRubriques()->isNotEmpty())
				<div class="min-h-[300px] max-w-[1280px] m-auto flex flex-col lg:flex-row mt-12 mb-12 lg:mb-0" x-data="{
					@foreach($faq->getPublishedRubriques() as $key => $rubrique)
						deployRubrique{{ $rubrique->id }}: @if($key > 0) false @else true @endif,
						@if($rubrique->getPublishedQuestions()->isNotEmpty())
							@foreach($rubrique->getPublishedQuestions() as $question)
								deployQuestion{{ $question->id }}: false,
							@endforeach
						@endif
					@endforeach

					hideAll:function() {
						@foreach($faq->getPublishedRubriques() as $rubrique)
							this.deployRubrique{{ $rubrique->id }}= false;
							@if($rubrique->getPublishedQuestions()->isNotEmpty())
								@foreach($rubrique->getPublishedQuestions() as $question)
									this.deployQuestion{{ $question->id }} = false;
								@endforeach
							@endif
						@endforeach
					}
				}">
					<div class="flex flex-col">
						@foreach($faq->getPublishedRubriques() as $rubrique)
							<div class="flex flex-row justify-center items-center p-2 lg:min-w-[300px] lg:max-w-[450px] lg:mr-8">
								<span x-on:click="hideAll(); deployRubrique{{ $rubrique->id }} = !deployRubrique{{ $rubrique->id }};" class="cursor-pointer">
									<span x-show="deployRubrique{{ $rubrique->id }}">
										<x-front.header.header-button :class="'w-[300px] justify-start !whitespace-normal text-left'">
											{{ $rubrique->order }}. {{ $rubrique->name }}
										</x-front.header.header-button>
									</span>

									<span x-show="!deployRubrique{{ $rubrique->id }}">
										<x-front.primary-button :class="'w-[300px] justify-start !whitespace-normal text-left'">
											{{ $rubrique->order }}. {{ $rubrique->name }}
										</x-front.primary-button>
									</span>
								</span>
							</div>
						@endforeach
					</div>

					<div class="flex flex-col w-full">
						@foreach($faq->getPublishedRubriques() as $rubrique)
							<div x-show="deployRubrique{{ $rubrique->id }}" x-transition>
								@if($rubrique->getPublishedQuestions()->isNotEmpty())
									@foreach($rubrique->getPublishedQuestions() as $question)
										<div class="flex flex-col border-b border-annonces-transparentgray px-6 py-4 my-4">
											<span x-on:click="deployQuestion{{ $question->id }} = !deployQuestion{{ $question->id }};" class="flex flex-row cursor-pointer">
												<span class="flex-1 font-semibold">
													{{ $rubrique->order }}.{{ $question->order }}. {{ $question->question }}
												</span>

												<span class="inline-block text-annonces-gray" x-show="deployQuestion{{ $question->id }}">
													<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
														<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
													</svg>
												</span>

												<span class="inline-block text-annonces-gray" x-show="!deployQuestion{{ $question->id }}">
													<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
														<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
													</svg>
												</span>
											</span>

											<div x-show="deployQuestion{{ $question->id }}" x-transition class="mt-4 p-4 ck ck-content">
												{!! $question->answer !!}
											</div>
										</div>
									@endforeach
								@endif
							</div>
						@endforeach
					</div>
				</div>
			@endif
		@endif
	</div>
</x-app-layout>
