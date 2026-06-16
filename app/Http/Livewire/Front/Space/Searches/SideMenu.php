<?php

namespace App\Http\Livewire\Front\Space\Searches;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Search;

class SideMenu extends Component
{
	public $searches = null;
	public $keywords = '';
	public $orderBy = 0;

	public function mount()
	{
		$query = Search::where('user_id', Auth::guard('web')->user()->id)
			->orderByDesc('updated_at');
		// $query->ddRawSql();
		$this->searches = $query->get();

	}

	public function search()
	{
		$this->dispatch('search', [
			'keywords' => $this->keywords,
			'orderBy' => (int) $this->orderBy,
		])->to(Slot::class);
	}

	public function resetForm()
	{
		$this->keywords = '';
		$this->orderBy = 0;
		$this->search();
	}

	public function render()
	{
		return view('livewire.front.space.searches.side-menu');
	}
}
