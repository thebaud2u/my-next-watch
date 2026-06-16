<?php

namespace App\Http\Livewire\Admin\Faqs;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Admin;
use App\Models\Faq;
use App\Models\FaqRubrique;

use App\Enums\FaqStates;

class FaqRubriques extends Component
{
	use WithPagination;

	// Criterias
	public $author;
	public $keyword;
	public $faq;

	public FaqRubrique $newFaqRubrique;
	public $errorOrder;

	protected $rules = [
		'newFaqRubrique.name' => ['required'],
		'newFaqRubrique.faq_id' => ['required'],
		'newFaqRubrique.order' => ['required']
	];

	protected $messages = [
		'newFaqRubrique.name.required' => 'Donnez un nom à votre rubrique de faq',
		'newFaqRubrique.faq_id.required' => 'Sélectionnez à quelle faq la rubrique doit appartenir',
		'newFaqRubrique.order.required' => 'Vous devez définir la position de la rubrique dans la faq'
	];

	public function selectedFaq()
	{
		$this->orderSet();
	}

	public function orderSet()
	{
		if($this->newFaqRubrique->faq) {
			$rubriquesHasOrder = FaqRubrique::where('order', '=', $this->newFaqRubrique->order)
				->whereHas('faq', function($whereHas) {
					$whereHas->where('id', '=', $this->newFaqRubrique->faq->id);
				})
				->first();

			if($rubriquesHasOrder) $this->errorOrder = true;
			else $this->errorOrder = false;
		}
	}

	public function fresh()
	{
		$this->newFaqRubrique = new FaqRubrique;
		$this->errorOrder = false;
	}

	public function get($id)
	{
		$this->newFaqRubrique = FaqRubrique::find($id);
	}

	public function set()
	{
		$new = empty($this->newFaqRubrique->id);

		$this->validate();

		if($this->errorOrder) {
			$rubriquesToShift = FaqRubrique::where('order', '>=', $this->newFaqRubrique->order)
				->whereHas('faq', function($whereHas) {
					$whereHas->where('id', '=', $this->newFaqRubrique->faq->id);
				});

			if(!$new) $rubriquesToShift = $rubriquesToShift->where('id', '<>', $this->newFaqRubrique->id);

			$rubriquesToShift = $rubriquesToShift->get();

			if($rubriquesToShift->isNotEmpty()) {
				foreach($rubriquesToShift as $rubrique) {
					$rubrique->order = $rubrique->order + 1;
					$rubrique->save();
				}
			}
		}

		$this->newFaqRubrique->save();

		if($new) session()->flash('success', __(':element added', ['element' => __('Faq rubrique')]));
		else session()->flash('success', __(':element updated', ['element' => __('Faq rubrique')]));

		$this->dispatch('faq-rubrique-validated');

		$this->fresh();
	}

	public function delete()
	{
		$this->newFaqRubrique->delete();

		session()->flash('success', __(':element deleted', ['element' => __('Faq rubrique')]));

		$this->dispatch('faq-rubrique-deleted');
	}

	public function draft($id)
	{
		$this->get($id);
		$this->newFaqRubrique->state = FaqStates::Draft;
		$this->newFaqRubrique->save();

		session()->flash('success', __('Rubrique set to draft'));
	}

	public function publish($id)
	{
		$this->get($id);
		$this->newFaqRubrique->state = FaqStates::Published;
		$this->newFaqRubrique->save();

		session()->flash('success', __('Rubrique published'));
	}

	public function mount()
	{
		$this->fresh();
	}

	public function render()
	{
		$faqRubriques = FaqRubrique::when($this->author, function($when) {
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
			->when($this->faq, function($when) {
				$when->whereHas('faq', function($whereHas) {
					$whereHas->where('id', '=', $this->faq);
				});
			})
			->orderBy('faq_id', 'ASC')
			->orderBy('order', 'ASC')
			->paginate(10);

		$admins = Admin::orderBy('lastname', 'ASC')
			->orderBy('firstname', 'ASC')
			->get();

		$faqs = Faq::latest('created_at')
			->get();

		return view('livewire.admin.faqs.faq-rubriques', [
			'faqRubriques' => $faqRubriques,
			'admins' => $admins,
			'faqs' => $faqs
		]);
	}
}
