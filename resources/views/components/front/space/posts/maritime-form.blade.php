<div>
	<div>
		<div class="flex flex-row">
			<x-front.input-label for="post.post_type_id" :value="__('Which post type would you like to create').' ?'" />
		</div>

		<select name="post.post_type_id" wire:model.live="post.post_type_id" wire:change="postTypeSelected" @disabled(($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false) class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
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

		@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
			<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
				{{ __('This field can only be modified on justification with the customer service') }}
			</div>
		@endif
	</div>

	<div style="padding:0 0 0 40px;">
		<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
			@if($post->postType)
				@if($post->postType->slug == 'maritime')
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.title" :value="__('Post title')" :required="true" />
						</div>

						<x-front.text-input name="post.title" wire:model="post.title" :disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false" placeholder="{{ __('Post title') }}" :class="'mt-1 block bg-white w-full'" />

						@error('post.title')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
							<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
								{{ __('This field can only be modified on justification with the customer service') }}
							</div>
						@endif
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="goodsType" :value="__('Goods type')" :required="true" />
						</div>

						@foreach($criterias['goods-type'] as $goodType)
							<div wire:key="goods-type-{{ $goodType->id }}">
								<input type="checkbox" name="goodsType" value="{{ $goodType->id }}" wire:model="goodsType" class="w-4 h-4 text-mnw-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
								<x-front.input-label for="goodsType" :value="$goodType->name" :class="'ml-2 inline-block font-normal'"/>
							</div>
						@endforeach

						@error('goodsType')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.values_web.starting_point" :value="__('Starting point')" />
						</div>

						<select name="post.values_web.starting_point" wire:model="post.values_web.starting_point" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">
							<option value="">{{ __('Choose a starting point') }}</option>
							@foreach($criterias['starting-point'] as $startingPoint)
								<option value="{{ $startingPoint->id }}" wire:key="starting-point-{{ $startingPoint->id }}">
									{{ $startingPoint->name }}
								</option>
							@endforeach
						</select>

						@error('post.values_web.starting_point')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<div class="flex flex-row">
							<x-front.input-label for="destinations" :value="__('Destinations')" />
						</div>

						@foreach($criterias['destinations'] as $destination)
							<div wire:key="destinations-{{ $destination->id }}">
								<input type="checkbox" name="destinations" value="{{ $destination->id }}" wire:model="destinations" class="w-4 h-4 text-mnw-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
								<x-front.input-label for="destinations" :value="$destination->name" :class="'ml-2 inline-block font-normal'"/>
							</div>
						@endforeach

						@error('destinations')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					{{-- Description --}}
					<div>
						<div class="flex flex-row">
							<x-front.input-label for="post.body" :value="__('Post description')" :required="true" />
						</div>

						<div wire:ignore>
							<textarea id="body" wire:model="post.body" placeholder="{{ __('Write here the post\'s description') }}" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full">{{ $post->body }}</textarea>
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
