<?php

namespace App\Http\Livewire\Admin\Faqs;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Admin;
use App\Models\Faq;

use App\Enums\FaqStates;

class Faqs extends Component
{
	use WithPagination;

	// Criterias
	public $author;
	public $keyword;
	public $state;

	public Faq $newFaq;

	protected $rules = [
		'newFaq.name' => ['required']
	];

	protected $messages = [
		'newFaq.name.required' => 'Donnez un nom à votre faq'
	];

	public function fresh()
	{
		$this->newFaq = new Faq;
	}

	public function get($id)
	{
		$this->newFaq = Faq::find($id);
	}

	public function set()
	{
		$new = empty($this->newFaq->id);

		$this->validate();

		$this->newFaq->save();

		if($new) session()->flash('success', __(':element added', ['element' => 'Faq']));
		else session()->flash('success', __(':element updated', ['element' => 'Faq']));

		$this->dispatch('faq-validated');

		$this->fresh();
	}

	public function delete()
	{
		$this->newFaq->delete();

		session()->flash('success', __(':element deleted', ['element' => 'Faq']));

		$this->dispatch('faq-deleted');
	}

	public function draft($id)
	{
		$this->get($id);
		$this->newFaq->state = FaqStates::Draft;
		$this->newFaq->save();

		session()->flash('success', __('Faq set to draft'));
	}

	public function publish($id)
	{
		$this->get($id);
		$this->newFaq->state = FaqStates::Published;
		$this->newFaq->save();

		session()->flash('success', __('Faq published'));
	}

	public function mount()
	{
		$this->fresh();
	}

	public function render()
	{
		$faqs = Faq::when($this->author, function($when) {
				$when->whereHas('author', function($whereHas) {
					$whereHas->where('id', '=', $this->author);
				});
			})
			->when($this->keyword, function ($when) {
				$when->where(function($where) {
					$where->where('name', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('id', 'LIKE', '%'.$this->keyword.'%');
				});
			})
			->when($this->state, function($when) {
				$when->where('state', '=', $this->state);
			})
			->latest('created_at')
			->paginate(10);

		$admins = Admin::orderBy('lastname', 'ASC')
			->orderBy('firstname', 'ASC')
			->get();

		return view('livewire.admin.faqs.faqs', [
			'faqs' => $faqs,
			'admins' => $admins
		]);
	}
}
