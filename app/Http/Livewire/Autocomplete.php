<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\{Breed};

class Autocomplete extends Component
{
	public $entity = null;
	public $type = null;
	public $model = null;
	public $searchValue = null;
	public $fields = null;
	public $results = null;
	public $showResults = false;
	public $withKeywordFilter = false;
	public $placeholder = '';
	public $fieldId = '';
	public $fieldValue = '';
	public $species = null;

	protected $listeners = [
		'reinitialize'
	];

	public function reinitialize()
	{
		$this->model = null;
		$this->searchValue = '';
		$this->results = null;
		$this->showResults = false;

		if($this->type == 'Breed') {
			$this->results = $this->entity::selectRaw('id, slug, CONCAT('.implode(', ", ", ', $this->fields).') AS displayed')
				->whereHas('species', function($whereHas) {
					$whereHas->where('slug->en', $this->species);
				})
				->orderby('name','asc')
				->get();
			$this->showResults = true;
		}

		$this->dispatch('autocomplete-reset');
		// $this->dispatch('modelReinitialized');
		// $this->dispatch('autocompleted', $this->fieldId, 0, $this->fieldValue, '');
	}

	public function search() {
		if(!empty($this->searchValue) && strlen($this->searchValue) > 0) {
			$this->results = $this->entity::selectRaw('id, slug, CONCAT('.implode(', ", ", ', $this->fields).') AS displayed')
				->when($this->searchValue, function($when, $value) {
					$values = explode(' ', trim($value));
					foreach($values as $word) {
						if(!empty($word) && strlen($word) > 1) {
							$when->whereRaw(
								'CONCAT('.implode(', ", ", ', $this->fields).') LIKE ?',
								['%'.$word.'%']
							);
						}
					}

					return $when;
				});

				if($this->species) {
					$this->results = $this->results->whereHas('species', function($whereHas) {
						$whereHas->where('slug->en', $this->species);
					});
				}

				$this->results = $this->results->get();

			$this->showResults = ! $this->results->isEmpty();

			if($this->withKeywordFilter) $this->dispatch('autocomplete_keyword_typed', $this->searchValue);
		}
		else $this->showResults = false;

		// $this->dispatch('autocompleted', $this->fieldId, 0, $this->fieldValue, $this->searchValue);
	}

	public function select($slug) {
		$this->model = $this->entity::findBySlug($slug);
		$this->searchValue = $this->model->name;
		$this->showResults = false;

		if($this->type == 'Breed') {
			$this->searchValue = $this->searchValue.' '.__('or of appearance');
			$this->dispatch('update-selected-breed');
			$this->showResults = true;
		}

		// $this->dispatch('modelSelected', $this->model);
		$this->dispatch('autocompleted', $this->model->slug);
	}

	public function mount()
	{
		if($this->type == 'Breed') {
			$this->entity = Breed::class;
			$this->model = ($this->model instanceof $this->entity) ? $this->model : null;
			$this->fields = ['name'];

			$this->results = $this->entity::selectRaw('id, slug, CONCAT('.implode(', ", ", ', $this->fields).') AS displayed')
				->whereHas('species', function($whereHas) {
					$whereHas->where('slug->en', $this->species);
				})
				->orderby('name','asc')
				->get();
			$this->showResults = true;
		}
	}

	public function render()
	{
		return view('livewire.autocomplete');
	}
}
