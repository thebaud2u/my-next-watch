<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Uppy extends Component
{
	public $modelClass;
	public $mediable;
	public $collection;
	public $maxMedias;
	public $medias;
	public $mediaId;
	public $key = 0;

	public $gridClass = '';
	public $aspectRatio = '';
	public $objectFit = '';
	public $type = null;

	protected function getListeners()
	{
		return [
			'saveMedia'.$this->collection => 'saveMedia',
			'deleteMedia'.$this->collection => 'deleteMedia'
		];
	}

	public function saveMedia($file, $collection, $extension, $path)
	{
		if(!$path) {
			session()->flash('error', 'Le chemin du fichier est manquant');
			return;
		}

		$fullPath = storage_path('app/' . $path);
		if(!file_exists($fullPath)) {
			session()->flash('error', "Fichier introuvable : $fullPath");
			return;
		}

		if($collection == $this->collection) {
			$extensions = [
				'image/jpeg' => '.jpg',
				'image/png' => '.png',
			];
			
			// Remplacement d’une image existante
			if($this->key > 0) {
				$media = $this->mediable->getMedia($collection)->find($this->mediaId);

				if($media) {
					$orderKeep = $media->order_column;

					if($media->delete()) {
						$newMedia = $this->mediable->addMedia($fullPath)->toMediaCollection($collection);
						
						if($newMedia) {
							$newMedia->order_column = $orderKeep;
							$newMedia->save();
							
							session()->flash('success', __('Image correctly updated'));
						}

						session()->flash('error', __('New image not created'));
					}
				}
				session()->flash('error', __('Image cannot be updated'));
			}
			else {
				if($this->mediable->addMedia($fullPath)->toMediaCollection($collection)) session()->flash('success', __('Image correctly created'));
				else session()->flash('error', __('Image not created'));
			}

			$this->mediable = $this->modelClass::find($this->mediable->id);
			$this->medias = $this->mediable->getMedia($collection);

			if(!is_null($this->type)) $this->dispatch('media-added');
		}
	}

	public function deleteMedia($collection, $mediaId)
	{
		if($collection == $this->collection) {
			$media = $this->mediable->getMedia($collection)->find($mediaId);
			
			if($media) {
				$media->delete();
				session()->flash('success', __('Image correctly deleted'));
			}
			else session()->flash('error', __('Image not deleted'));

			session()->flash('flash', $this->collection);

			/** Must fully reload "mediable" */
			$this->mediable = $this->modelClass::find($this->mediable->id);
			$this->medias = $this->mediable->getMedia($this->collection);

			if(!is_null($this->type)) $this->dispatch('media-deleted');
		}
	}

	public function setMain(int $id)
	{
		$media = $this->mediable->getMedia($this->collection)->find($id);
		$media->order_column = 1;
		$media->save();

		$rank = 2;
		$this->medias->each(function (\Spatie\MediaLibrary\MediaCollections\Models\Media $media) use ($id, &$rank) {
			if ($media->id != $id) {
				$media->order_column = $rank;
				$media->save();
				$rank += 1;
			}
		});

		/** Must fully reload "mediable" */
		$this->mediable = $this->modelClass::find($this->mediable->id);
		$this->medias = $this->mediable->getMedia($this->collection);
	}

	public function mount($class, $modelId, $collection)
	{
		if($this->mediable = $class::findOrFail($modelId)) {
			$this->modelClass = (string) $class;
			$this->medias = $this->mediable->getMedia($collection);
		}
		else $this->medias = new Collection();
	}

	public function render()
	{
		return view('livewire.uppy');
	}
}
