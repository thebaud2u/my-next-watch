<div>
	<div>
		<div class="flex flex-row">
			<x-input-label for="post.post_type_id" :value="__('Which post type would you like to create').' ?'" />
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
				<div>
					<div class="flex flex-row">
						<x-input-label for="post.title" :value="__('Tender or DSP title')" :required="true" />
					</div>

					<x-text-input name="post.title" wire:model="post.title" :disabled="($post->state->color() == 'green' && !Auth::guard('admin')->check()) ? true : false" placeholder="{{ __('Tender or DSP title') }}" :class="'mt-1 block bg-white w-full'" />

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
						<x-input-label for="post.category_id" :value="__('Post\'s sub-category')" />
					</div>

					<select name="post.category_id" wire:model="post.category_id" class="text-gray-400 block mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm sm:w-1/2 w-full">

						@if($categories->isNotEmpty())
							<option value="">{{ __('Choose a post\'s sub-category') }}</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}" wire:key="category-{{ $category->id }}">
									{{ $category->name }}
								</option>
							@endforeach
						@else
							<option value="">{{ __('No sub-category available') }}</option>
						@endif
					</select>

					@error('post.category_id')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				{{-- Description --}}
				<div>
					<div class="flex flex-row">
						<x-input-label for="post.body" :value="__('Offer\'s description')" :required="true" />
					</div>

					<div wire:ignore>
						<textarea id="body" wire:model="post.body" placeholder="{{ __('Write here the offer\'s description') }}" class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm text-gray-400 mt-1 block bg-white w-full">{{ $post->body }}</textarea>
					</div>

					@error('post.body')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				<div>
					<div class="flex flex-row">
						<x-input-label for="address" :value="__('Location')" :required="true" />
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

					@if($post->state->color() == 'green' && !Auth::guard('admin')->check())
						<div class="flex flex-row text-sm text-mnw-gray italic mt-2">
							{{ __('This field can only be modified on justification with the customer service') }}
						</div>
					@endif
				</div>
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
