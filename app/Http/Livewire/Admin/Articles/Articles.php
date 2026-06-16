<?php

namespace App\Http\Livewire\Admin\Articles;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Enums\ArticleStates;

use App\Models\{Admin, Article, ArticleAuthor, ArticleSection, ArticleTag, ArticleTarget, Breed, Department, Media, Mediable, Species};

class Articles extends Component
{
	use WithFileUploads, WithPagination;

	// Criterias
	public $author;
	public $keyword;
	public $section;
	public $inSelection = false;

	// Lists
	public $authors;
	public $departments;
	public $sections;
	public $species;
	public $tags;
	public $targets;

	// Properties
	public $subComponentKey = 0;

	public Article $article;
	public $title;
	public $mainSectionSelected = null;
	public $sectionsSelected = [];
	public $targetsSelected = [];
	public $speciesSelected = [];
	public $breedsList;
	public $choiceBreed;
	public $breedsSelected;
	public $choiceDepartment;
	public $departmentsSelected;
	public $isInfomercial = false;
	public $isFigoAdopter = false;
	public $isFigoBreeder = false;
	public $tagSearch;
	public $authorSearch;
	public $tagsFound;
	public $authorFound;
	public $tagsSelected;
	public $authorSelected;
	public $photoCredit;
	public $header = '';
	public $body = '';
	public $startPublicationDate;
	public $endPublicationDate;
	public $lastUpdateDate;
	public $createdAtDate;
	public $isInSelection = false;
	public $isPublished = false;

	protected function rules() {
		return [
			'title' => [],
			'mainSectionSelected' => [],
			'sectionsSelected' => [],
			'targetsSelected' => [],
			'speciesSelected' => [],
			'breedsSelected' => [],
			'departmentsSelected' => [],
			'isInfomercial' => [],
			'isFigoAdopter' => [],
			'isFigoBreeder' => [],
			'tagsSelected' => [],
			'photoCredit' => [],
			'header' => [],
			'body' => [],
			'startPublicationDate' => [],
			'endPublicationDate' => [],
			'lastUpdateDate' => [],
			'authorSelected' => [],
			'isInSelection' => [],
			'isPublished' => []
		];
	}

	public function selectSpecies()
	{
		if($this->speciesSelected) {
			$species = Species::whereIn('id', $this->speciesSelected)
				->get();

			if($species->isNotEmpty()) {
				$this->breedsList = new Collection();

				foreach($species as $specie) {
					$this->breedsList = $this->breedsList->concat($specie->breeds)->sortBy('name')->values();
				}
			}

			$this->choiceSpecies = '';
		}
	}

	public function forgetSpecies($slug)
	{
		if($this->breedsSelected->isNotEmpty()) {
			$species = Species::findBySlug($slug);

			if($species) {
				foreach($species->breeds as $breed) {
					$this->breedsSelected = $this->breedsSelected->reject(function($breedSelected) use($breed) {
						return $breedSelected->slug === $breed->slug;
					})->values();
				}
			}
		}

		$this->speciesSelected = $this->speciesSelected->reject(function($species) use($slug) {
			return $species->slug === $slug;
		})->values();

		if($this->speciesSelected->isNotEmpty()) {
			$this->breedsList = new Collection();

			foreach($this->speciesSelected as $species) {
				$this->breedsList = $this->breedsList->concat($species->breeds);
			}
		}
	}

	public function selectBreed()
	{
		if($this->choiceBreed != '') {
			$breed = Breed::findBySlug($this->choiceBreed);

			if($breed) {
				if(!$this->breedsSelected->contains('slug', $breed->slug)) $this->breedsSelected->push($breed);
			}

			$this->choiceBreed = '';
		}
	}

	public function forgetBreed($slug)
	{
		$this->breedsSelected = $this->breedsSelected->reject(function($breed) use($slug) {
			return $breed->slug === $slug;
		})->values();
	}

	public function selectDepartment()
	{
		if($this->choiceDepartment != '') {
			$department = Department::where('slug', $this->choiceDepartment)
				->first();

			if($department) {
				if(!$this->departmentsSelected->contains('slug', $department->slug)) $this->departmentsSelected->push($department);
			}

			$this->choiceDepartment = '';
		}
	}

	public function forgetDepartment($slug)
	{
		$this->departmentsSelected = $this->departmentsSelected->reject(function($department) use($slug) {
			return $department->slug === $slug;
		})->values();
	}

	public function autocomplete()
	{
		if($this->tagSearch != '') {
			$foundTag = ArticleTag::where('name', 'like', '%'.$this->tagSearch.'%')
				->get();

			$this->tagsFound = $foundTag;
		}
		elseif($this->authorSearch != '') {
			$foundAuthor = ArticleAuthor::where('name', 'like', '%'.$this->authorSearch.'%')
				->get();

			$this->authorFound = $foundAuthor;
		}
	}

	public function selectTag($slug)
	{
		$tag = ArticleTag::findBySlug($slug);

		if($tag) {
			if(!$this->tagsSelected->contains('slug', $tag->slug)) $this->tagsSelected->push($tag);
		}

		$this->tagSearch = '';
		$this->tagsFound = null;
	}

	public function selectAuthor($slug)
	{
		$author = ArticleAuthor::findBySlug($slug);

		if($author) {
			if($this->authorSelected->isEmpty()) $this->authorSelected->push($author);
		}

		$this->authorSearch = '';
		$this->authorFound = null;
	}

	public function forgetTag($slug)
	{
		$this->tagsSelected = $this->tagsSelected->reject(function($tag) use($slug) {
			return $tag->slug === $slug;
		})->values();
	}

	public function forgetAuthor($slug)
	{
		$this->authorSelected = $this->authorSelected->reject(function($author) use($slug) {
			return $author->slug === $slug;
		})->values();
	}

	public function addTag()
	{
		if($this->tagSearch != '') {
			$newTag = new ArticleTag;
			$newTag->name = $this->tagSearch;
			$newTag->save();

			$this->tagsSelected->push($newTag);
			$this->tagSearch = '';
			$this->tagsFound = null;
		}
	}

	public function addAuthor()
	{
		if($this->authorSearch != '') {
			$newArticleAuthor = new ArticleAuthor;
			$newArticleAuthor->name = $this->authorSearch;
			$newArticleAuthor->values = new Collection();
			$newArticleAuthor->save();

			$this->authorSelected->push($newArticleAuthor);
			$this->authorSearch = '';
			$this->authorFound = null;
		}
	}

	public function fresh()
	{
		$this->article = new Article;
		$this->title = null;
		$this->type = null;
		$this->rolesSelected = [];
		$this->description = null;
		$this->partner = null;
		$this->code = null;
		$this->link = null;
		$this->condition = null;
		$this->endDate = null;

		$this->isInfomercial = false;
		$this->isFigoAdopter = false;
		$this->isFigoBreeder = false;
		$this->photoCredit = null;
		$this->header = '';
		$this->body = '';
		$this->startPublicationDate = null;
		$this->endPublicationDate = null;
		$this->lastUpdateDate = null;
		$this->articleAuthor = null;
		$this->isInSelection = false;
		$this->isPublished = false;

		$this->mainSectionSelected = null;
		$this->sectionsSelected = [];
		$this->targetsSelected = [];
		$this->speciesSelected = [];

		$this->departmentsSelected = new Collection();
		$this->tagsSelected = new Collection();
		$this->authorSelected = new Collection();
		$this->breedsList = new Collection();
		$this->breedsSelected = new Collection();

		// Force uppy instances to refresh
		$this->subComponentKey++;
		$this->dispatch('article-reset');
	}

	public function getArticle($id, $modal)
	{
		$this->fresh();

		$this->article = Article::find($id);
		$this->title = $this->article->title;
		$this->isInfomercial = $this->article->values->get('infomercial');
		$this->isFigoAdopter = $this->article->values->get('figoAdopter');
		$this->isFigoBreeder = $this->article->values->get('figoBreeder');
		$this->photoCredit = $this->article->values->get('photoCredit');
		$this->header = $this->article->header;
		$this->body = $this->article->body;
		$this->startPublicationDate = $this->article->start_publication_date?->format('Y-m-d H:i');
		$this->endPublicationDate = $this->article->end_publication_date?->format('Y-m-d H:i');
		$this->lastUpdateDate = $this->article->last_update_date?->format('Y-m-d H:i');
		$this->createdAtDate =  $this->article->created_at?->format('Y-m-d H:i');
		$this->isInSelection = $this->article->in_selection ? true : false;

		if($this->article->state === ArticleStates::Published) $this->isPublished = true;

		$this->authorSelected->push($this->article->author);

		if($this->article->species->isNotEmpty()) {
			foreach($this->article->species as $articleSpecies) {
				$this->speciesSelected[] = $articleSpecies->id;
			}
		}

		$this->tagsSelected = $this->article->tags;

		$this->mainSectionSelected = $this->article->mainSection()->id;

		if($this->article->secondarySections()->isNotEmpty()) {
			foreach($this->article->secondarySections() as $section) {
				$this->sectionsSelected[] = $section->id;
			}
		}
		
		if($this->article->targets->isNotEmpty()) {
			foreach($this->article->targets as $target) {
				$this->targetsSelected[] = $target->id;
			}
		}

		if($this->article->departments->isNotEmpty()) {
			foreach($this->article->departments as $address) {
				$this->departmentsSelected->push($address->department);
			}
		}

		$this->selectSpecies();
		$this->breedsSelected = $this->article->breeds;

		// Force uppy instances to refresh
		$this->subComponentKey++;
		$this->dispatch('open-modal', $modal);
		$this->dispatch('article-loaded');
	}

	public function setArticle()
	{
		$rules = [
			'title' => ['required'],
			'targetsSelected' => ['required'],
			'mainSectionSelected' => ['required'],
			'speciesSelected' => ['required'],
			'tagsSelected' => ['required'],
			'body' => ['required'],
			'authorSelected' => ['required'],
			'startPublicationDate' => ['nullable', 'date'],
			'endPublicationDate' => ['nullable', 'date',  'after_or_equal:startPublicationDate'],
			'lastUpdateDate' =>['nullable', 'date']
		];

		$messages = [
			'title.required' => __(':element is mandatory', ['element' => __('The article\'s title')]),
			'targetsSelected.required' => __(':element is mandatory', ['element' => __('The article\'s target')]),
			'mainSectionSelected.required' => __(':element is mandatory', ['element' => __('The article\'s main section')]),
			'speciesSelected.required' => __(':element is mandatory', ['element' => __('At least a species')]),
			'tagsSelected.required' => __(':element is mandatory', ['element' => __('At least a tag')]),
			'body.required' => __(':element is mandatory', ['element' => __('The article\'s body')]),
			'authorSelected.required' => __(':element is mandatory', ['element' => __('The article\'s author')]),
			'startPublicationDate.date' => __(':element is expected', ['element' => __('A date (dd/mm/yyyy)')]),
			'endPublicationDate.date' => __(':element is expected', ['element' => __('A date (dd/mm/yyyy)')]),
			'endPublicationDate.after_or_equal' => __('The end date must be after or equal to the start date'),
			'lastUpdateDate.date' => __(':element is expected', ['element' => __('A date (dd/mm/yyyy)')])
		];

		$this->validate($rules, $messages);

		if($this->article) $newArticle = $this->article;

		$values = new Collection();
		$values->put('infomercial', $this->isInfomercial)
			->put('figoAdopter', $this->isFigoAdopter)
			->put('figoBreeder', $this->isFigoBreeder)
			->put('photoCredit', $this->photoCredit);

		$newArticle->admin_id = Auth::guard('admin')->user()->id;
		$newArticle->title = $this->title;
		$newArticle->article_author_id = $this->authorSelected->first()->id;
		$newArticle->values = $values;
		$newArticle->header = $this->header;
		$newArticle->body = $this->body;
		$newArticle->start_publication_date = $this->startPublicationDate ?: null;
		$newArticle->end_publication_date = $this->endPublicationDate ?: null;
		$newArticle->last_update_date = $this->manageLastUpdateDate($this->lastUpdateDate, $this->startPublicationDate, $this->createdAtDate);
		
		$newArticle->in_selection = $this->isInSelection;

		if($this->isPublished) {
			if(($this->startPublicationDate && $this->startPublicationDate > now()) && ($this->endPublicationDate && $this->endPublicationDate > now())) $newArticle->state = ArticleStates::WaitingPublication;
			else $newArticle->state = ArticleStates::Published;
		}
		elseif($newArticle->state === ArticleStates::Published) $newArticle->state = ArticleStates::Unpublished;

		$newArticle->save();

		$newArticle->setSections($this->mainSectionSelected, $this->sectionsSelected);
		$newArticle->targets()->sync($this->targetsSelected);
		$newArticle->species()->sync($this->speciesSelected ?? []);
		$newArticle->breeds()->sync($this->breedsSelected ?? []);
		$newArticle->tags()->sync($this->tagsSelected ?? []);

		if($this->departmentsSelected->isNotEmpty()) {
			$newArticle->departments->each->delete();

			foreach($this->departmentsSelected as $departmentSelected) {
				$newArticle->department()->create([
					'department_id' => $departmentSelected->id
				]);
			}
		}
		else $newArticle->departments()->delete();

		// The Media associated with a Mediable is taken back and transferred to the newly created article
		$mediablePhoto = Auth::guard('admin')->user()->mediable->where('type', 'article-photo')->first();
		$mediaPhoto = $mediablePhoto->media->first();
		if($mediaPhoto) {
			$newArticle->addMedia($mediaPhoto->getPath())
				->usingName($mediaPhoto->name)
				->usingFileName($mediaPhoto->file_name)
				->toMediaCollection('photo');

			$mediaPhoto->delete();
			$mediablePhoto->delete();
		}

		$this->dispatch('article-validated');

		$this->fresh();
	}

	private function manageLastUpdateDate($lastUpdateDate, $startPublicationDate, $createdAtDate)
	{
		if ($this->article->exists) {
			// En mode update
			return $lastUpdateDate ?? $startPublicationDate ?? $createdAtDate;
		}
		
		// En mode création, si $lastUpdateDate non renseigné donc date now
		return $lastUpdateDate ?? now();
	}
		
		

	public function deleteArticle()
	{
		if($this->article->exists) {
			$this->article->delete();

			$this->dispatch('article-deleted');
		}
	}

	public function mount()
	{
		$this->authors = ArticleAuthor::orderBy('name', 'ASC')
			->get();
		$this->departments = Department::orderBy('name', 'ASC')
			->get();
		$this->sections = ArticleSection::orderBy('name', 'ASC')
			->get();
		$this->species = Species::orderBy('name', 'ASC')
			->get();
		$this->tags = ArticleTag::orderBy('name', 'ASC')
			->get();
		$this->targets = ArticleTarget::orderBy('name', 'ASC')
			->get();
		$this->fresh();
	}

	public function render()
	{
		$articles = Article::withoutGlobalScope('published')
			->when($this->author, function($when) {
				$when->whereHas('author', function($whereHas) {
					$whereHas->where('slug', $this->author);
				});
			})
			->when($this->keyword, function($when) {
				$when->where(function($where) {
					$where->where('title', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('header', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('body', 'LIKE', '%'.$this->keyword.'%');
				});
			})
			->when($this->section, function($when) {
				$when->whereHas('sections', function($whereHas) {
					$whereHas->where('id', $this->section);
				});
			})
			->when($this->inSelection, function($when) {
				$when->where('in_selection', $this->inSelection);
			})
			->orderBy('id', 'ASC')
			->paginate(10);

		/*
			By default we will load a Mediable class that will allow us to temporarily store the banner and logo
			If we are looking to edit a benefit (benefit), we have previously retrieved an id via getArticle($id)
			If an id exists, we find the advantage, if it exists, we replace the Mediable by the Article class, so when a media will be loaded, it will be associated with Article
			In summary:
			- if creation -> temporary storage of images at a Mediable, once the form is sent: transfers images (stored in Media::class) to Article::class
			- if update -> preloading images via Article:class (we will define the Article class as Mediable so that the media of the advantage are preloaded)
		*/
		$mediableClassPhoto = Mediable::class;
		$adminMediablePhoto = Mediable::firstOrCreate([
			'admin_id' => Auth::guard('admin')->user()->id,
			'type' => 'article-photo'
		]);
		$mediableIdPhoto = $adminMediablePhoto->id;

		if($this->article) {
			if($this->article->getFirstMedia('photo')) {
				$mediableClassPhoto = Article::class;
				$mediableIdPhoto = $this->article->id;
			}
		}

		$this->subComponentKey++;

		return view('livewire.admin.articles.articles', [
			'articles' => $articles,
			'mediableClassPhoto' => $mediableClassPhoto,
			'mediableIdPhoto' => $mediableIdPhoto
		]);
	}
}
