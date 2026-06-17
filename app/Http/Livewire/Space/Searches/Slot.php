<?php

namespace App\Http\Livewire\Front\Space\Searches;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\Search;

class Slot extends Component
{
	use WithPagination;

	public $searches = null;

	public function mount()
	{
		$query = Search::where('user_id', Auth::guard('web')->user()->id)
			->orderByDesc('updated_at');

		$this->searches = $query->get();
	}

	#[On('search')]
	public function search(array $values)
	{
		$query = Search::where('user_id', Auth::guard('web')->user()->id);
		if(! empty($values['keywords'])) {
			$query->where('name', 'like', '%'.$values['keywords'].'%');
		}
		if(empty($values['orderBy'])) {
			$query->orderByDesc('updated_at');
		} else {
			$query->orderBy('updated_at');
		}

		$this->searches = $query->get();
	}

	public function toggleAlert(string $uuid)
	{
		$search = Search::where('user_id', Auth::guard('web')->user()->id)
			->where('uuid', $uuid)
			->first();

		$search->email_alert = ! $search->email_alert;
		$search->save();
	}

	public function render()
	{
		return view('livewire.front.space.searches.slot');
	}
}
