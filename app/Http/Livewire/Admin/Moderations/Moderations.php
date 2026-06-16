<?php

namespace App\Http\Livewire\Admin\Moderations;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

use App\Enums\PublicationStates;
use App\Enums\ModerationStates;

use App\Models\{Animal, Company, Moderation, Post, ProfessionnalActivity, Publication, Comment, User};

class Moderations extends Component
{
	use WithPagination;

	// Filters
	public $state = 'waiting';
	public $keyword;
	public $type;

	// Lists
	public $moderationStates = [];
	public $types = [];

	public function mount()
	{
		$typesModeration = Moderation::distinct()
			->pluck('model_type')
			->toArray();

		foreach($typesModeration as $typeModeration) {
			if($typeModeration == 'App\Models\Animal') $name = __('Animal');
			elseif($typeModeration == 'App\Models\Company') $name = __('Company');
			elseif($typeModeration == 'App\Models\Post') $name = __('Post');
			elseif($typeModeration == 'App\Models\ProfessionnalActivity') $name = __('Professionnal activity');
			elseif($typeModeration == 'App\Models\Comment') $name = __('Comment');
			elseif($typeModeration == 'App\Models\User') $name = __('User');

			$this->types[$typeModeration] = $name;
		}

		$this->moderationStates = ModerationStates::asHumanArray();
	}

	public function render()
	{
		$latestModerationIds = Moderation::select(DB::raw('MAX(id) as id'))
			->groupBy('model_type', 'model_id')
			->pluck('id')
			->toArray();

		$moderations = Moderation::whereIn('id', $latestModerationIds)
			->when($this->keyword, function ($when) {
				$when->whereHasMorph('model', (empty($this->type) ? [Animal::class, Company::class, Post::class, ProfessionnalActivity::class, Comment::class, User::class] : $this->type), function($whereHas, $type) {
					if($type === Animal::class) {
						$whereHas->where('name', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
							->orWhereHas('company', function($orWhereHasCompany) {
								$orWhereHasCompany->where('name', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
									->orWhereHas('user', function($orWhereHasUser) {
										$orWhereHasUser->where('lastname', 'LIKE', '%'.$this->keyword.'%')
											->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
											->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
											->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
									});
							});
					}
					elseif($type === Company::class) {
						$whereHas->where('name', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
							->orWhereHas('user', function($orWhereHasUser) {
								$orWhereHasUser->where('lastname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
							});
					}
					elseif($type === Post::class) {
						$whereHas->where('name', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
							->orWhereHas('user', function($orWhereHasUser) {
								$orWhereHasUser->where('lastname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
							});
					}
					elseif($type === ProfessionnalActivity::class) {
						$whereHas->where('name', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
							->orWhereHas('user', function($orWhereHasUser) {
								$orWhereHasUser->where('lastname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
							});
					}
					elseif($type === Comment::class) $whereHas->where('content', 'LIKE', '%'.$this->keyword.'%');
					elseif($type === User::class) {
						$whereHas->where('lastname', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
							->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
							->orWhereHas('company', function($orWhereHasCompany) {
								$orWhereHasCompany->where('name', 'LIKE', '%'.$this->keyword.'%')
									->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
							});
					}
				});
			})
			->when($this->type, function($when) {
				if($this->type === Animal::class) $when->where('model_type', Animal::class);
				elseif($this->type === Company::class) $when->where('model_type', Company::class);
				elseif($this->type === Post::class) $when->where('model_type', Post::class);
				elseif($this->type === ProfessionnalActivity::class) $when->where('model_type', ProfessionnalActivity::class);
				elseif($this->type === Comment::class) $when->where('model_type', Comment::class);
				elseif($this->type === User::class) $when->where('model_type', User::class);
			}, function($default) {
				$default->orderByRaw("FIELD(model_type, ?, ?, ?, ?, ?, ?)", [User::class, Company::class, Post::class, Animal::class, ProfessionnalActivity::class, Comment::class])
					->orderBy('created_at', 'desc');
			})
			->when($this->state, function($when) {
				$when->where('state', '=', $this->state);
			})
			->whereHas('model', function($whereHas) {
				$whereHas->whereNull('deleted_at');
			})
			->paginate(10);

		return view('livewire.admin.moderations.moderations', [
			'moderations' => $moderations
		]);
	}
}
