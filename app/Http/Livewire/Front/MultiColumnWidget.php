<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

use Illuminate\Support\Facades\Cache;

use App\Models\{Breed, Species};

class MultiColumnWidget extends Component
{
	public Species $forSpecies;
	public $breeds;

	public function mount()
	{
		if($this->forSpecies->getTranslation('slug', 'en') == 'dog') {
			$this->breeds = Cache::remember('top_dog_breeds_12', now()->addDays(7), function () {
				return Breed::query()
					->whereHas('species', function ($whereHas) {
						$whereHas->where('slug->en', $this->forSpecies->getTranslation('slug', 'en'));
					})
					->whereNotNull('values->top_breed')
					->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(`values`, "$.top_breed")) AS UNSIGNED) ASC')
					->limit(12)
					->get();
			});
		}
		elseif($this->forSpecies->getTranslation('slug', 'en') == 'cat') {
			$this->breeds = Cache::remember('top_cat_breeds_list_12', now()->addDays(7), function () {
				return Breed::whereIn('name', [
						'Maine Coon',
						'Sacré de birmanie',
						'British shorthair',
						'Ragdoll',
						'Bengal',
						'Persan',
						'Sibérien',
						'Norvégien',
						'Chartreux',
						'British longhair'
					])
					->get();
			});
		}
	}

	public function render()
	{
		return view('livewire.front.multi-column-widget');
	}
}
