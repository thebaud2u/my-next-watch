<?php

/**
 * How to set up Uppy image uploader
 *
 * 1. In parent (Livewire ?) controller "app/Http/Livewire/Posts/Create.php", add :
 *    use App\Models\Mediable;
 *    class Create extends Component
 *    {
 *        public Mediable $mediable;
 *        public function mount(Post $post)
 *        {
 *            $this->post = $post;
 *            if (empty($this->post->id)) {
 *                $this->mediable = Mediable::firstOrCreate([
 *                    'user_id' => Auth::id(),
 *                    'type' => 'post'
 *                ]);
 *            }
 *        }
 *    }
 *
 * 2. In main blade files "resources/views/front/posts/{create,edit}", add :
 *    @push('scripts') <script src="{!! asset('js/uppy.js') !!}"></script> @endpush
 *    @push('styles') <x-front.space.uppy-styles /> @endpush
 *
 * 3. In "parent" blade file "resources/views/livewire/posts/create", add (to main or parent div) :
 *    x-data="{component:'',filename:''}"
 *
 * 4. Then, also in parent blade file, call this component like :
 *    @if (empty($post->id))
 *        <livewire:uploader :wire:key="'photos'" :class="\App\Models\Mediable::class" :model_id="$mediable->id" :collection="'post-u'.Auth::user()->id" :max_medias="$max_photos" />
 *    @else
 *        <livewire:uploader :wire:key="'photos'" :class="\App\Models\Post::class" :model_id="$post->id" :collection="'photos'" :max_medias="$max_photos" />
 *    @endif
 *
 *    Note :class, :model_id, :collection and :max_medias attributes are required !
 *
 * 5. Finally, still in parent blade file, add the two modals (add_photo and delete_photo) :
 *    <x-modal name="add_photo" :class="'w-full max-w-2xl'" focusable>
 *        <form id="uploadform" x-on:uploaded.window="setTimeout(()=>{uppy.cancelAll();$dispatch('close')},'2000')">
 *            @csrf
 *            <!-- <input type="hidden" name="tiny" value="1"> --> <!-- If set : max file width/height : 250px ! -->
 *            <input type="hidden" name="filename" x-model="filename">
 *            <div id="uploader"></div>
 *        </form>
 *    </x-modal>
 *    <x-modal name="delete_photo" :class="'w-full max-w-xl"' focusable>
 *        (...)
 *        <x-primary-button type="button" x-on:click="$dispatch('close');setTimeout(()=>{window.Livewire.dispatch('deleteMedia')},'100')">
 *            <span class="mx-auto">{{ __('Yes, delete') }}</span>
 *        </x-primary-button>
 *        (...)
 *    </x-modal>
 *
 * Also, check that the directory "/storage/app/uploads" exists (02755)
 * Don't forget to run "npm update" and "npm run prod"
 *
 */

namespace App\Http\Livewire;

use Livewire\Component;

class Uploader extends Component
{
	public $model_class;
	public $mediable;
	public $collection;
	public $max_medias;
	public $medias;
	public $media_id = 0;
	public $key = 0;

	public $first_is_main = false;
	public $main_label = '';
	public $grid_class = '';
	public $aspect_ratio = '';
	public $object_fit = '';

	public function mount($class, $model_id, $collection)
	{
		if ($this->mediable = $class::findOrFail($model_id)) {
			$this->model_class = (string) $class;
			$this->medias = $this->mediable->getMedia($collection);
		}
		else $this->medias = collect([]);
	}

	protected function getListeners()
	{
		return [
			'saveMedia'.$this->collection => 'save',
			'setBanner'.$this->collection => 'setbanner',
			'deleteMedia'.$this->collection => 'delete',
		];
	}

	public function save($detail=null)
	{
		$file = $detail['file'] ?? null;
		$mime_type = $detail['type'] ?? null;
		$extensions = [
			'image/jpeg' => '.jpg',
			// 'image/webp' => '.webp',
			'image/png' => '.png',
			'image/gif' => '.gif',
		];
		$file_path = storage_path().'/app/uploads/';

		if (!empty($mime_type) && !empty($extensions[$mime_type])) {
			$file_name = $file.$extensions[$mime_type]; /** 2215-71932-img0.jpg */
			$media_name = explode('-', $file)[2].$extensions[$mime_type]; /** img0.jpg */
			if (file_exists($file_path.$file_name)) {
				if (@rename($file_path.$file_name, $file_path.$media_name)) {
					if ($this->key > 0) {
						$media = $this->mediable->getMedia($this->collection)->find($this->media_id);
						$order_keep = $media->order_column;
						if ($media->delete()) {
							if ($new_media = $this->mediable->addMedia($file_path.$media_name)->toMediaCollection($this->collection)) {
								$new_media->order_column = $order_keep;
								$new_media->save();
								session()->flash('success', __('Image correctly updated'));
							} else {
								session()->flash('error', __('New image not created'));
							}
						} else {
							session()->flash('error', __('Image cannot be updated'));
						}
					} else {
						if ($this->mediable->addMedia($file_path.$media_name)->toMediaCollection($this->collection)) {
							session()->flash('success', __('Image correctly created'));
						} else {
							session()->flash('error', __('Image not created'));
						}
					}
				} else {
					session()->flash('error', __('Impossible to create image file'));
				}
			} else {
				session()->flash('error', __('Image file not correctly uploaded'));
			}
		} else {
			session()->flash('error', __('Invalid image file'));
		}
		session()->flash('flash', $this->collection);

		/** Must fully reload "mediable" */
		$this->mediable = $this->model_class::find($this->mediable->id);
		$this->medias = $this->mediable->getMedia($this->collection);
	}

	public function delete()
	{
		if ($this->mediable->getMedia($this->collection)->find($this->media_id)->delete()) session()->flash('success', __('Image correctly deleted'));
		else session()->flash('error', __('Image not deleted'));


		session()->flash('flash', $this->collection);

		/** Must fully reload "mediable" */
		$this->mediable = $this->model_class::find($this->mediable->id);
		$this->medias = $this->mediable->getMedia($this->collection);
	}

	public function setbanner(int $id)
	{
		$media_banner = $this->mediable->getMedia($this->collection)->find($id);
		$media_banner->order_column = 1;
		$media_banner->save();

		$rank = 2;
		$this->medias->each(function (\Spatie\MediaLibrary\MediaCollections\Models\Media $media) use ($id, &$rank) {
			if ($media->id != $id) {
				$media->order_column = $rank;
				$media->save();
				$rank += 1;
			}
		});

		/** Must fully reload "mediable" */
		$this->mediable = $this->model_class::find($this->mediable->id);
		$this->medias = $this->mediable->getMedia($this->collection);
	}

	public function render()
	{
		return view('livewire.uploader');
	}
}
