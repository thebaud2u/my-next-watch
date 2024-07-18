<div>
	<div>
		<div class="flex flex-row">
			<x-front.input-label for="post.post_type_id" :value="__('Which post type would you like to create').' ?'" />
		</div>

		<select name="post.post_type_id" wire:model.live="post.post_type_id" wire:change="postTypeSelected" @disabled(($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false) class="text-gray-400 block mt-1 border border-gray-300 focus:border-annonces-blue focus:ring-annonces-blue rounded-md shadow-sm sm:w-1/2 w-full">
			<option value="">{{ __('Choose a post type') }}</option>
			@foreach($postTypes as $postType)
				<option value="{{ $postType->id }}" wire:key="post-type-{{ $postType->id }}">
					{{ $postType->name }}
				</option>
			@endforeach
		</select>

		@error('post.post_type_id')
			<span class="error text-danger-700">
				{{ $message }}
			</span>
		@enderror
	</div>

	<div style="padding:0 0 0 40px;">
		<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
			@if($post->postType)
				@if($post->postType->slug == 'appel-offre-dsp')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.title" :value="__('Tender or DSP title')" :required="true" />
						</div>

						<x-front.text-input name="post.title" wire:model="post.title" :disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false" placeholder="{{ __('Tender or DSP title') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.title')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.market_type" :value="__('Market type')" :required="true" />
						</div>

						<select name="post.values_web.market_type" wire:model="post.values_web.market_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-annonces-blue focus:ring-annonces-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a market type') }}</option>
							@foreach($criterias['market-type'] as $marketType)
								<option value="{{ $marketType->id }}" wire:key="market-type-{{ $marketType->id }}">
									{{ $marketType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.market_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.notice_type" :value="__('Notice type')" :required="true" />
						</div>

						<select name="post.values_web.notice_type" wire:model="post.values_web.notice_type" class="text-gray-400 block mt-1 border border-gray-300 focus:border-annonces-blue focus:ring-annonces-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a notice type') }}</option>
							@foreach($criterias['notice-type'] as $noticeType)
								<option value="{{ $noticeType->id }}" wire:key="notice-type-{{ $noticeType->id }}">
									{{ $noticeType->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.notice_type')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.closing_date" :value="__('Closing date')" />
						</div>

						<x-front.text-input type="date" name="post.values_web.closing_date" wire:model="post.values_web.closing_date" min="{{ \Carbon\Carbon::now() }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.values_web.closing_date')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					{{-- Description --}}
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.body" :value="__('Tender\'s description')" :required="true" />
						</div>

						<div wire:ignore>
							<textarea id="body" wire:model="post.body" placeholder="{{ __('Write here the tender\'s description') }}" class="border-gray-300 focus:border-annonces-blue focus:ring-annonces-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full">{{ $post->body }}</textarea>
						</div>

						@error('post.body')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					{{-- Photos --}}
					<div class="flex flex-col mt-5">
						<div class="italic text-sm gray mt-2">
							<p>
								{{ __('These images are used to illustrate your post') }}.
							</p>

							<p class="mt-4">
								{{ __('The first image (marked with the star) is your post banner and main image') }}.
								{{ __('You can change your banner image (and thus reorder your images display) by clicking on the star') }}.
							</p>

							<p class="mt-4">
								{{ __('You can insert').' '.trans_choice('{1} :nb image|[2,*] up to :nb images', $maxPhotos, ['nb' => $maxPhotos]) }}.
							</p>
						</div>

						<livewire:uploader
							:max_medias="$maxPhotos"
							:first_is_main="true"
							:main_label="'[ '.__('Banner').' ]'"
							:class="\App\Models\Post::class"
							:model_id="$post->id"
							:collection="'photos'"
							:grid_class="'mt-6 sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-4'"
							:aspect_ratio="'aspect-video'"
							:object_fit="'object-cover'"
							:wire:key="'photos-'.$post->postType->id" />
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="address" :value="__('Location')" :required="true" />
						</div>

						<livewire:address
							:address="$address"
							:city_required="true"
							:country_required="true"
							:additionnal_2="false"
							:disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false"
							:wire:key="'address-'.$post->postType->id" />

						@error('address.city_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.custom_city')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@error('address.country_id')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				@endif
			@endif
		</div>
	</div>

	@push('scripts')
		<script src="{!! asset('js/ckeditor.js') !!}"></script>
		<script>
			var ckEditorInstance = null;
			const postTypeSelect = document.querySelector("select[name='post.post_type_id']");

			function initClassicEditor() {
				if(ckEditorInstance == null) {
					ClassicEditor
					.create(document.querySelector('#body'), {
						// Editor configuration.
						simpleUpload: {
							// Feature configuration.

							// The URL that the images are uploaded to.
							uploadUrl: "{{ route('space.posts.upload') }}",
						},
						style: {
							definitions: [
								// Styles definitions.
								{
									name: 'Article category',
									element: 'h3',
									classes: [ 'category' ]
								},
								{
									name: 'Title',
									element: 'h2',
									classes: [ 'document-title' ]
								},
								// ...
								{
									name: 'Texte rouge',
									element: 'span',
									classes: [ 'text-red' ]
								},
							]
						}
					})
					.then(editor => {
						ckEditorInstance = editor;

						editor.model.document.on('change:data', () => {
							@this.set('post.body', editor.getData());
						})
					})
					.catch(error => {
						console.error(error);
					});
				}
				else {
					ckEditorInstance.destroy();
					ckEditorInstance = null;

					setTimeout(function() {
						initClassicEditor();
					}, 500);
				}
			};

			window.addEventListener('postTypeChanged', event => {
				initClassicEditor();
			});

			initClassicEditor();
		</script>
	@endpush
</div>
