<?php

namespace App\Http\Livewire\Admin\Faqs;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Admin;
use App\Models\Faq;
use App\Models\FaqRubrique;
use App\Models\FaqQuestion;

use App\Enums\FaqStates;

class FaqQuestions extends Component
{
	use WithPagination;

	// Criterias
	public $author;
	public $keyword;
	public $criteriaFaq;
	public $criteriaFaqRubrique;

	public $faqRubriquesCriteria;
	public $faqRubriquesForm;

	public FaqQuestion $newFaqQuestion;
	public $faq;
	public $errorOrder;

	protected $rules = [
		'newFaqQuestion.question' => ['required'],
		'newFaqQuestion.answer' => ['required'],
		'newFaqQuestion.faq_rubrique_id' => ['required'],
		'newFaqQuestion.order' => ['required']
	];

	protected $messages = [
		'newFaqQuestion.question.required' => 'Saisissez la question',
		'newFaqQuestion.answer.required' => 'Saisissez la réponse',
		'newFaqQuestion.faq_rubrique_id.required' => 'Sélectionnez à quelle rubrique la question doit appartenir',
		'newFaqQuestion.order.required' => 'Vous devez définir la position de la question dans la rubrique'
	];

	public function selectedFaqCriteria()
	{
		$this->faqRubriquesCriteria = Faq::find($this->criteriaFaq)->rubriques;
	}

	public function selectedFaqForm()
	{
		$this->faqRubriquesForm = Faq::find($this->faq)->rubriques()->orderBy('order', 'ASC')->get();
	}

	public function selectedFaqRubriqueForm()
	{
		$this->orderSet();
	}

	public function orderSet()
	{
		if($this->newFaqQuestion->rubrique) {
			$questionsHasOrder = FaqQuestion::where('order', '=', $this->newFaqQuestion->order)
				->whereHas('rubrique', function($whereHas) {
					$whereHas->where('id', '=', $this->newFaqQuestion->rubrique->id);
				})
				->first();

			if($questionsHasOrder) $this->errorOrder = true;
			else $this->errorOrder = false;
		}
	}

	public function fresh()
	{
		$this->newFaqQuestion = new FaqQuestion;
		$this->faq = null;
		$this->errorOrder = false;
		$this->dispatch('question-reset');
	}

	public function get($id)
	{
		$this->newFaqQuestion = FaqQuestion::find($id);

		$this->faq = $this->newFaqQuestion->rubrique->faq->id;
		$this->faqRubriquesForm =  $this->newFaqQuestion->rubrique->faq->rubriques;

		$this->dispatch('question-loaded');
	}

	public function set()
	{
		$new = empty($this->newFaqQuestion->id);

		$this->validate();

		if($this->errorOrder) {
			$questionsToShift = FaqQuestion::where('order', '>=', $this->newFaqQuestion->order)
				->whereHas('rubrique', function($whereHas) {
					$whereHas->where('id', '=', $this->newFaqQuestion->rubrique->id);
				});

			if(!$new) $questionsToShift = $questionsToShift->where('id', '<>', $this->newFaqQuestion->id);

			$questionsToShift = $questionsToShift->get();

			if($questionsToShift->isNotEmpty()) {
				foreach($questionsToShift as $question) {
					$question->order = $question->order + 1;
					$question->save();
				}
			}
		}

		$this->newFaqQuestion->save();

		if($new) session()->flash('success', __(':element added', ['element' => __('Faq question')]));
		else session()->flash('success', __(':element updated', ['element' => __('Faq question')]));

		$this->dispatch('faq-question-validated');

		$this->fresh();
	}

	public function delete()
	{
		$this->newFaqQuestion->delete();

		session()->flash('success', __(':element deleted', ['element' => __('Faq question')]));

		$this->dispatch('faq-question-deleted');
	}

	public function draft($id)
	{
		$this->get($id);
		$this->newFaqQuestion->state = FaqStates::Draft;
		$this->newFaqQuestion->save();

		session()->flash('success', __('Question set to draft'));
	}

	public function publish($id)
	{
		$this->get($id);
		$this->newFaqQuestion->state = FaqStates::Published;
		$this->newFaqQuestion->save();

		session()->flash('success', __('Question published'));
	}

	public function mount()
	{
		$this->fresh();
	}

	public function render()
	{
		$faqQuestions = FaqQuestion::when($this->author, function($when) {
				$when->whereHas('author', function($whereHas) {
					$whereHas->where('id', '=', $this->author);
				});
			})
			->when($this->keyword, function ($when) {
				$when->where(function($where) {
					$where->where('question', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('answer', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('id', 'LIKE', '%'.$this->keyword.'%');
				});
			})
			->when($this->criteriaFaq, function($when) {
				$when->whereHas('rubrique', function($whereHas) {
					$whereHas->whereHas('faq', function($whereHasFaq) {
						$whereHasFaq->where('id', '=', $this->criteriaFaq);
					});
				});
			})
			->when($this->criteriaFaqRubrique, function($when) {
				$when->whereHas('rubrique', function($whereHas) {
					$whereHas->where('id', '=', $this->criteriaFaqRubrique);
				});
			})
			->orderBy('faq_rubrique_id', 'ASC')
			->orderBy('order', 'ASC')
			->paginate(10);

		$admins = Admin::orderBy('lastname', 'ASC')
			->orderBy('firstname', 'ASC')
			->get();

		$faqsCriteria = Faq::latest('created_at')
			->get();

		$faqsForm = Faq::latest('created_at')
			->get();

		return view('livewire.admin.faqs.faq-questions', [
			'faqQuestions' => $faqQuestions,
			'admins' => $admins,
			'faqsCriteria' => $faqsCriteria,
			'faqsForm' => $faqsForm
		]);
	}
}
