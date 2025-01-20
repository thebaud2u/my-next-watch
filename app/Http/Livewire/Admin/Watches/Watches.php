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

	public function mount()
	{
		$this->admins = Admin::all();
		$this->brands = Brand::all();
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
