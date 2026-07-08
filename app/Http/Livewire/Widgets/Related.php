<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;

use App\Models\{Brand, Collection, Watch};

class Related extends Component
{
	public $results;
	public $slug;
	public $type;
	public $typeName;

	public function mount()
	{
		$watch = Watch::findBySlug($this->slug);
		$this->results = collect([]);

		if($watch->exists) {
			if($this->type == 'collection') {
				$this->results = $watch->collection->watches()->where('watches.slug', '<>', $watch->slug)->orderBy('reference', 'ASC')->get();
				$this->typeName = $watch->collection->name;
			}
			elseif($this->type == 'brand') {
				$watchesSlugFromSamecollection = $watch->collection->watches()->pluck('slug');

				$this->results = $watch->getBrand()->watches()->whereNotIn('watches.slug', $watchesSlugFromSamecollection)->orderBy('reference', 'ASC')->get();
				$this->typeName = $watch->getBrand()->name;
			}
		}
	}

	public function render()
	{
		return view('livewire.widgets.related', [
			'results' => $this->results
		]);
	}
}
