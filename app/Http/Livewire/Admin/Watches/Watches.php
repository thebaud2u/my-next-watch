<?php

namespace App\Http\Livewire\Admin\Watches;

use Auth;
use DB;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Movement;
use App\Models\Watch;

class Watches extends Component
{
	use WithPagination;

	// Criterias
	public $admin;
	public $keyword;
	public $status;

	// Data
	public $admins;
	public $brands;
	public $collections;
	public $movements;

	// Singles
	public $brand_id;
	public Brand $brand;
	public Collection $newCollection;
	public Movement $newMovement;
	public Watch $newWatch;

	protected function rules()
	{
		return [
			'brand_id' => [''],

			'newCollection.name' => [''],

			'newMovement.name' => [''],
			'newMovement.type' => [''],
			'newMovement.COSC' => [''],
			'newMovement.METAS' => [''],
			'newMovement.manufactured_caliber' => [''],
			'newMovement.description' => [''],
			'newMovement.nationality' => [''],

			'newWatch.collection_id' => [''],
			'newWatch.name' => [''],
			'newWatch.reference' => [''],
			'newWatch.movement_id' => ['']
		];
	}

	public function brandSelected()
	{
		if($this->brand_id != '') {
			$this->brand = Brand::find($this->brand_id);

			$this->collections = Collection::whereHas('brand', function($whereHas) {
					$whereHas->where('id', $this->brand->id);
				})
				->get();

			$this->movements = Movement::whereHas('brand', function($whereHas) {
					$whereHas->where('id', $this->brand->id);
				})
				->get();
		}
	}

	public function addCollection()
	{
		$rules = [
			'newCollection.name' => ['required']
		];

		$messages = [
			'newCollection.name.required' => __('The collection\'s name is mandatory')
		];

		$this->validate($rules, $messages);

		$this->newCollection->brand_id = $this->brand->id;
		$this->newCollection->admin_id = Auth::guard('admin')->user()->id;
		$this->newCollection->save();

		$this->newCollection = new Collection;

		$this->collections = Collection::all();

		$this->dispatch('collection-added');
	}

	public function addMovement()
	{
		$rules = [
			'newMovement.name' => ['required'],
			'newMovement.type' => ['required']
		];

		$messages = [
			'newMovement.name.required' => __('The :field is mandatory', ['field' => 'movement\'s name']),
			'newMovement.type.required' => __('The :field is mandatory', ['field' => 'movement\'s type'])
		];

		$this->validate($rules, $messages);

		if($this->newMovement->name != '') {
			$this->newMovement->brand_id = $this->brand->id;
			$this->newMovement->admin_id = Auth::guard('admin')->user()->id;
			$this->newMovement->save();

			$this->newMovement = new Movement;

			$this->movements = Movement::all();

			$this->dispatch('movement-added');
		}
	}

	public function addWatch()
	{
		$rules = [
			'brand_id' => ['required'],
			'newWatch.collection_id' => ['required'],
			'newWatch.name' => ['required'],
			'newWatch.reference' => ['required'],
			'newWatch.movement_id' => ['required']
		];

		$messages = [
			'brand_id.required' => __('The :field is mandatory', ['field' => 'watch\'s brand']),
			'newWatch.collection_id.required' => __('The :field is mandatory', ['field' => 'watch\'s collection']),
			'newWatch.name.required' => __('The :field is mandatory', ['field' => 'watch\'s name']),
			'newWatch.reference.required' => __('The :field is mandatory', ['field' => 'watch\'s reference']),
			'newWatch.movement_id.required' => __('The :field is mandatory', ['field' => 'watch\'s movement']),
		];

		$this->validate($rules, $messages);
	}

	public function mount()
	{
		$this->admins = Admin::all();
		$this->brands = Brand::all();
		$this->newCollection = new Collection;
		$this->newMovement = new Movement;
		$this->newWatch = new Watch;
	}

	public function render()
	{
		$watches = Watch::when($this->keyword, function ($query, $value) {
				$query->where('name', 'LIKE', '%'.$value.'%');
				$query->orWhere('reference', 'LIKE', '%'.$value.'%');
			})
			->withTrashed()
			->paginate(25);

		return view('livewire.admin.watches.watches', [
			'watches' => $watches
		]);
	}
}
