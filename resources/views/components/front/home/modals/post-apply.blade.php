<section class="p-8">
	<header class="flex flex-row border-b-2 border-gray-300 pb-4 items-end">
		<div class="max-w-[111px] border rounded shadow-md mr-6">
			<div class="m-2">
				@if($media = $post->company->getFirstMedia('logo'))
					<img src="{{ $media->getAvailableUrl(['optimized']) }}" title="{{ __('Logo of') }} {{ $post->company->name }}" class="object-contain" />
				@endif
			</div>
		</div>

		<div class="flex flex-col w-auto">
			<h2 class="text-lg font-semibold">
				{{ $post->title }}
			</h2>

			<p class="mt-1 text-sm">
				{{ $post->company->name }}
			</p>
		</div>
	</header>

	<form method="post" action="{{ route('space.responses.apply', ['post' => $post]) }}" enctype="multipart/form-data">
		@csrf

		<div class="mt-6 space-y-4">
			<div class="mt-4 flex flex-col">
				<div class="flex flex-col mb-2">
					@if(Auth::user()->getFirstMedia('cvs'))
						<label class="block font-semibold text-sm mr-5" for="cv">
							{{ __('Resumes I\'ve uploaded') }} :
						</label>

						<div class="flex flex-col mt-2">
							@foreach(Auth::user()->getMedia('cvs') as $index => $cvs)
								<div class="flex flex-row items-center">
									<input type="radio" id="cv-{{ $index }}" name="cvs" value="{{ $cvs->id }}" class="mr-2 checked:bg-annonces-blue checked:hover:bg-annonces-blue checked:active:bg-annonces-blue checked:focus:bg-annonces-blue focus:bg-annonces-blue focus:outline-none focus:ring-1 focus:ring-annonces-blue" @if($index == 0) checked @endif>

									<a href="{{ $cvs->getAvailableUrl(['optimized']) }}" target="_blank">
										<label for="cv-{{ $index }}" class="font-semibold">
											{{ $cvs->file_name }}
										</label>
									</a>
								</div>
							@endforeach
						</div>
					@endif
				</div>

				<div class="flex flex-col mt-4 mb-2">
					<div class="flex flex-col">
						<label class="block font-semibold text-sm underline mb-2 @error('cv') text-danger-700 @enderror" for="cv">
							{{ __('Upload a new resume') }}
						</label>

						<input type="file" id="cv" name="cv" accept=".txt,.rtf,.pdf,.doc,.docx,.odt,.jpg,.jpeg,.png" @if(!Auth::user()->getFirstMedia('cvs')) required @endif class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-annonces-blue file:bg-annonces-blue hover:border-annonces-blue bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-annonces-blue file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-annonces-blue dark:file:bg-annonces-blue dark:file:text-neutral-100 dark:focus:border-primary" />
					</div>
				</div>

				<div class="flex flex-col mt-4 mb-2">
					<div class="flex flex-col">
						<label class="block font-semibold text-sm underline mb-2 @error('doc') text-danger-700 @enderror" for="doc">
							{{ __('Upload another document') }}
						</label>

						<input type="file" id="doc" name="doc" accept=".txt,.rtf,.pdf,.doc,.docx,.odt,.jpg,.jpeg,.png" class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-annonces-blue file:bg-annonces-blue hover:border-annonces-blue bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-annonces-blue file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-annonces-blue dark:file:bg-annonces-blue dark:file:text-neutral-100 dark:focus:border-primary" />
					</div>
				</div>

				<div class="flex flex-col mt-4 mb-2 @if($errors->any()) text-danger-700 @endif">
					{{ __('File weight must be :weight MB max each', ['weight' => 2]) }}
				</div>
			</div>

			<div class="mt-4">
				<label class="block font-semibold text-sm" for="motivation">
					{{ __('Your message') }}
				</label>

				<textarea rows="6" id="motivation" name="motivation" required class="border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm mt-1 block w-full text-gray-400">{{ old('motivation') }}</textarea>
			</div>
		</div>

		<div class="mt-6 flex justify-start">
			<input type="submit" value="{{ __('Send my application') }}" class="px-3 py-1.5 whitespace-nowrap bg-annonces-blue hover:bg-annonces-blue border-2 border-annonces-blue hover:border-annonces-blue rounded-md text-sm xl:text-base text-white font-medium focus:outline-none focus:ring-0 transition ease-in-out duration-150 block" />
		</div>
	</form>
</section>
