<?php

namespace App\Http\Livewire\Front\Space\Alerts;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\{Alert, Breed, PostType, Species};

class MyAlerts extends Component
{
	public Alert $alert;

	public $alerts;
	public $filters;
	public $showForm = false;

	public $breeds;
	public $postTypes;
	public $name;
	public $sex = 'both';
	public $pureBreed = 'both';

	#[On('location-selected')]
	public function locationSelected($filters)
	{
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['region_id'] = $filters['region_id'];
		$this->filters['department_id'] = $filters['department_id'];
		$this->filters['city_id'] = $filters['city_id'];
		$this->filters['cities'] = $filters['cities'];
		$this->filters['distance'] = $filters['distance'];
	}

	public function removeLocalisation()
	{
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = null;

		$this->dispatch('location-reset');
	}

	public function loadBreeds()
	{
		$this->breeds = Species::findBySlug($this->filters['species'], 'en')->breeds;
	}

	public function	breedSelected()
	{
		if($this->filters['breed']) {
			$breed = Breed::findBySlug($this->filters['breed']);

			if($breed) {
				$this->name = $breed->name;

				if($this->filters['post_type']) $this->postTypeSelected();
			}
		}
	}

	public function postTypeSelected()
	{
		if($this->filters['post_type']) {
			$postType = PostType::findBySlug($this->filters['post_type'], 'en');

			if($postType) {
				if($postType->getTranslation('slug', 'en') == 'litter') {
					if($this->filters['species'] == 'dog') $this->name = __('Puppy').' '.$this->name;
					else $this->name = __('Kitty').' '.$this->name;
				}
				else $this->name = __(ucfirst($postType->name)).' '.$this->name;
			}
		}
	}

	public function sexSelected()
	{
		if($this->sex) {
			$this->filters['sex'] = $this->sex == 'both' ? null : [$this->sex];
		}
	}

	public function pureBreedSelected()
	{
		if($this->pureBreed) {
			$this->filters['pure_breed'] = $this->pureBreed == 'both' ? null : ($this->pureBreed == 'yes' ? true : false);
		}
	}

	public function goToSearch($id)
	{
		$alert = Alert::find($id);

		if($alert->user->slug == Auth::guard('web')->user()->slug) {
			$filters['breed'] = $alert->values->get('breed');
			$filters['post_type'] = $alert->values->get('post_type');
			$filters['country_id'] = $alert->values->get('country_id');
			$filters['region_id'] = $alert->values->get('region_id');
			$filters['department_id'] = $alert->values->get('department_id');
			$filters['city_id'] = $alert->values->get('city_id');
			$filters['cities'] = $alert->values->get('cities');
			$filters['distance'] = $alert->values->get('distance');
			$filters['max_price'] = $alert->values->get('max_price');
			$filters['min_price'] = $alert->values->get('min_price');

			if($alert->values->get('pure_breed') == 'yes') $filters['pure_breed'] = true;
			elseif($alert->values->get('pure_breed') == 'both') $filters['pure_breed'] = null;

			if($alert->values->get('sex') == 'male') $filters['sex'] = ['male'];
			elseif($alert->values->get('sex') == 'female') $filters['sex'] = ['female'];
			else $filters['sex'] = null;

			session()->put('filters', $filters);

			$postType = PostType::findBySlug($alert->values->get('post_type'), 'en');

			if($postType) return redirect()->route('post-search.'.$alert->values->get('species').'-posts-with-breed', ['postType' => __($postType->getTranslation('slug', 'fr')), 'breed' => $alert->values->get('breed')]);
		}
	}

	public function refreshAlerts()
	{
		$this->alerts = Auth::guard('web')->user()
			->alerts()
			->latest()
			->get();
	}

	public function toggleShowForm(bool $reset = false)
	{
		if($reset) {
			$this->filters['species'] = 'dog';
			$this->filters['breed'] = null;
			$this->filters['post_type'] = null;
			$this->filters['country_id'] = null;
			$this->filters['region_id'] = null;
			$this->filters['department_id'] = null;
			$this->filters['city_id'] = null;
			$this->filters['cities'] = null;
			$this->filters['distance'] = null;
			$this->filters['max_price'] = null;
			$this->filters['min_price'] = null;
			$this->pureBreed = 'yes';
			$this->sex = 'male';
		}

		$this->showForm = !$this->showForm;
	}

	public function toggleAlert($id)
	{
		$alert = Alert::find($id);

		if($alert->user->slug == Auth::guard('web')->user()->slug) {
			$alert->enabled = !$alert->enabled;
			$alert->save();

			$this->refreshAlerts();
		}
	}

	public function getAlert($id)
	{
		$this->alert = Alert::find($id);

		if($this->alert->exists && $this->alert->user->slug == Auth::guard('web')->user()->slug) {
			$this->name = $this->alert->name;
			$this->filters['species'] = $this->alert->values->get('species');

			$this->loadBreeds();

			$this->filters['breed'] = $this->alert->values->get('breed');
			$this->filters['post_type'] = $this->alert->values->get('post_type');
			$this->filters['country_id'] = $this->alert->values->get('country_id');
			$this->filters['region_id'] = $this->alert->values->get('region_id');
			$this->filters['department_id'] = $this->alert->values->get('department_id');
			$this->filters['city_id'] = $this->alert->values->get('city_id');
			$this->filters['cities'] = $this->alert->values->get('cities');
			$this->filters['distance'] = $this->alert->values->get('distance');
			$this->filters['max_price'] = $this->alert->values->get('max_price');
			$this->filters['min_price'] = $this->alert->values->get('min_price');
			$this->pureBreed = $this->alert->values->get('pure_breed');
			$this->sex = $this->alert->values->get('sex');

			session()->put('filters', $this->filters);

			$this->toggleShowForm();
		}
	}

	public function deleteAlert($id)
	{
		$alert = Alert::find($id);

		if($alert->user->slug == Auth::guard('web')->user()->slug) {
			$alert->delete();

			$this->refreshAlerts();
		}
	}

	public function form()
	{
		$rules = [
			'name' => ['required'],
			'filters.breed' => ['required'],
			'filters.post_type' => ['required']
		];

		$messages = [
			'name.required' => __(':element is mandatory', ['element' => __('The alert name')]),
			'filters.breed.required' => __(':element is mandatory', ['element' => __('The breed')]),
			'filters.post_type.required' => __(':element is mandatory', ['element' => __('The post type')])
		];

		$this->validate($rules, $messages);

		$values = new Collection();
		$values->put('species', $this->filters['species'])
			->put('breed', $this->filters['breed'])
			->put('post_type', $this->filters['post_type'])
			->put('country_id', $this->filters['country_id'])
			->put('region_id', $this->filters['region_id'])
			->put('department_id', $this->filters['department_id'])
			->put('city_id', $this->filters['city_id'])
			->put('cities', $this->filters['cities'])
			->put('distance', $this->filters['distance'])
			->put('pure_breed', $this->pureBreed)
			->put('sex', $this->sex);

		if($this->filters['max_price'] != "") $values->put('max_price', $this->filters['max_price']);
		else $values->put('max_price', null);

		if($this->filters['min_price'] != "") $values->put('min_price', $this->filters['min_price']);
		else $values->put('min_price', null);

		$this->alert->values = $values;
		$this->alert->name = $this->name;
		$this->alert->user_id = Auth::guard('web')->user()->id;
		$this->alert->save();

		$this->refreshAlerts();
		$this->toggleShowForm();
	}

	public function mount()
	{
		$this->filters['species'] = 'dog';
		$this->filters['breed'] = null;
		$this->filters['post_type'] = null;
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = null;
		$this->filters['max_price'] = null;
		$this->filters['min_price'] = null;
		$this->pureBreed = 'both';
		$this->sex = 'both';

		$this->postTypes = PostType::whereNot('slug->en', 'litter-yet-to-come')
			->get();

		$this->refreshAlerts();
		$this->alert = new Alert;

		if(session()->has('save-search-with-filters')) {
			$this->filters = session()->get('save-search-with-filters');

			$this->breeds = Species::findBySlug($this->filters['species'], 'en')->breeds;

			if($this->filters['breed']) $this->breedSelected();
			elseif($this->filters['post_type']) $this->postTypeSelected();
			
			if($this->filters['sex']) {
				if(count($this->filters['sex']) > 1) $this->sex = 'both';
				else $this->sex = $this->filters['sex'][0];
			}

			if($this->filters['pure_breed'] === true) $this->pureBreed = 'yes';
			
			$filters = session()->get('save-search-with-filters');
			$filters['species'] = null;
			$filters['breed'] = null;
			$filters['post_type'] = null;
			$filters['max_price'] = null;
			$filters['min_price'] = null;
			$filters['sex'] = null;
			$filters['pure_breed'] = null;

			session()->put('filters', $filters);
		}
		else $this->breeds = Species::findBySlug($this->filters['species'], 'en')->breeds;
	}

	public function render()
	{
		if(session()->has('save-search-with-filters')) {
			$this->showForm = true;
			session()->forget('save-search-with-filters');
		}

		return view('livewire.front.space.alerts.my-alerts');
	}
}
