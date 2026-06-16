<?php

namespace App\Http\Livewire\Front\Articles;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Collection;

use App\Enums\ArticleStates;

use App\Models\{Article, ArticleAuthor, ArticleSection, ArticleTag, ArticleTarget, Species};
use Carbon\Carbon;

class Index extends Component
{
	use WithPagination;

	public $filters = [];
	public $argument1;
	public $argument2;

	public function setFilter($slug)
	{
		if(!in_array($slug, $this->filters)) $this->filters[] = $slug;
		else unset($this->filters[array_search($slug, $this->filters)]);
	}

	public function mount()
	{

	}

	/**
	 * Méthode helper pour appliquer les filtres de dates start_publication_date et end_publication_date
	 * Applique les conditions :  dates valides
	 */
	private function applyDateFilters($query)
	{
		return $query->where(function($where) {
				$where->whereNull('start_publication_date')
					  ->orWhere('start_publication_date', '<=', Carbon::now());
			})
			->where(function ($where) {
				$where->whereNull('end_publication_date')
					  ->orWhere('end_publication_date', '>=', Carbon::now());
			});
	}

	public function render()
	{
		$articlesNutrition = new Collection();
		$articlesSelection = new Collection();
		$articlesHealth = new Collection();
		$articlesDog = new Collection();
		$articlesEducation = new Collection();
		$articlesCat = new Collection();
		$articlesReproduction = new Collection();

		$articleAuthor = null;
		$articleSection = null;
		$articleSections = null;
		$articleTag = null;
		$articleTarget = null;
		$articleTargets = null;
		$articleSpecies = null;
		$allSpecies = Species::all();
		$menuEntries = null;

		if($this->argument1) {
			$argument1IsArticleAuthor = ArticleAuthor::findBySlug($this->argument1);
			$argument1IsArticleTag = ArticleTag::findBySlug($this->argument1);
			$argument1IsArticleSection = ArticleSection::findBySlug($this->argument1);
			$argument1IsSpecies = Species::findBySlug($this->argument1, 'fr');
			$argument1IsArticleTarget = ArticleTarget::findBySlug($this->argument1);

			if($argument1IsArticleAuthor) $articleAuthor = $argument1IsArticleAuthor;
			elseif($argument1IsArticleSection) $articleSection = $argument1IsArticleSection;
			elseif($argument1IsArticleTag) $articleTag = $argument1IsArticleTag;
			elseif($argument1IsSpecies) $articleSpecies = $argument1IsSpecies;
			elseif($argument1IsArticleTarget) $articleTarget = $argument1IsArticleTarget;
		}

		if($this->argument2) {
			$argument2IsSpecies = Species::findBySlug($this->argument2, 'fr');
			$argument2IsArticleTarget = ArticleTarget::findBySlug($this->argument2);
			$argument2IsArticleTag = ArticleTag::findBySlug($this->argument2);

			if($argument2IsSpecies) $articleSpecies = $argument2IsSpecies;
			elseif($argument2IsArticleTarget) $articleTarget = $argument2IsArticleTarget;
			elseif($argument2IsArticleTag) $articleTag = $argument2IsArticleTag;
		}

		$articles = $this->applyDateFilters(Article::orderByDesc('last_update_date')
			->where('state', ArticleStates::Published)
			)
			->when($articleSection, function($when) use($articleSection) {
				$when->whereHas('sections', function($whereHas) use($articleSection) {
					$whereHas->where('slug', $articleSection->slug);
				});
			})
			->when($articleTarget, function($when) use($articleTarget) {
				$when->whereHas('targets', function($whereHas) use($articleTarget) {
					$whereHas->where('slug', $articleTarget->slug);
				});
			})
			->when($articleSpecies, function($when) use($articleSpecies) {
				$when->whereHas('species', function($whereHas) use($articleSpecies) {
					$whereHas->where('slug->fr', $articleSpecies->getTranslation('slug', 'fr'));
				});
			})
			->when($articleTag, function($when) use($articleTag) {
				$when->whereHas('tags', function($whereHas) use($articleTag) {
					$whereHas->where('slug', $articleTag->slug);
				});
			})
			->when($this->filters, function($when) {
				$when->where(function($where) {
					$where->whereHas('tags', function($whereHas) {
						$whereHas->whereIn('slug', $this->filters);
					})
					->orWhereHas('targets', function($whereHas) {
						$whereHas->whereIn('slug', $this->filters);
					})
					->orWhereHas('species', function($whereHas) {
						$whereHas->whereIn('slug->fr', $this->filters);
					});
				});
			})
			->when($articleAuthor, function($when) use($articleAuthor) {
				$when->whereHas('author', function($whereHas) use($articleAuthor) {
					$whereHas->where('slug', $articleAuthor->slug);
				});
			});

		$mostRead = $this->applyDateFilters(Article::orderByViews())
			->take(4)
			->latest()
			->get();

		$mostReadsSlug = $mostRead->pluck('slug');

		// Restriction des résultats de la requête si on est sur la home
		if(!$this->argument1) {
			$articles = $articles->latest()
				->take(5)
				->get();

			$articlesSlug = $articles->pluck('slug');

			$articlesSelection = $this->applyDateFilters(Article::where('in_selection', true)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSlug)
				->where('state', ArticleStates::Published))
				->latest()
				->take(4)
				->get();

			$articlesSelectionSlug = $articlesSelection->pluck('slug');

			$articlesDog = $this->applyDateFilters(Article::whereHas('species', function($whereHas) {
					$whereHas->where('slug->fr', 'chien');
				})
				->where('in_selection', false)
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug)
				)
				->latest()
				->take(4)
				->get();

			$articlesDogSlug = $articlesDog->pluck('slug');
				
			$articlesCat = $this->applyDateFilters(Article::whereHas('species', function($whereHas) {
					$whereHas->where('slug->fr', 'chat');
				})
				->where('in_selection', false)
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug))
				->latest()
				->take(4)
				->get();

			$articlesCatSlug = $articlesCat->pluck('slug');

			$articleSections = ArticleSection::all();
			$articleSections = $articleSections->reverse();

			$articleTargets = ArticleTarget::all();
			$articleTargets = $articleTargets->reverse();

			$articlesNutrition = $this->applyDateFilters(Article::whereHas('sections', function($whereHas) {
					$whereHas->where('slug', 'nutrition')
						->where('is_main', true);
				})
				->where('in_selection', false)
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug)
				->whereNotIn('slug', $articlesDogSlug)
				->whereNotIn('slug', $articlesCatSlug))
				->latest()
				->take(4)
				->get();

			$articlesHealth = $this->applyDateFilters(Article::whereHas('sections', function($whereHas) {
					$whereHas->where('slug', 'sante')
						->where('is_main', true);
				})
				->where('in_selection', false)
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug)
				->whereNotIn('slug', $articlesDogSlug)
				->whereNotIn('slug', $articlesCatSlug))
				->latest()
				->take(4)
				->get();

			$articlesEducation = $this->applyDateFilters(Article::whereHas('sections', function($whereHas) {
					$whereHas->where('slug', 'education-comportement')
						->where('is_main', true);
				})
				->where('in_selection', false)
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug)
				->whereNotIn('slug', $articlesDogSlug)
				->whereNotIn('slug', $articlesCatSlug))
				->latest()
				->take(4)
				->get();

			$articlesReproduction = $this->applyDateFilters(Article::whereHas('sections', function($whereHas) {
					$whereHas->where('slug', 'reproduction-genetique')
						->where('is_main', true);
				})
				->where('state', ArticleStates::Published)
				->whereNotIn('slug', $articlesSlug)
				->whereNotIn('slug', $mostReadsSlug)
				->whereNotIn('slug', $articlesSelectionSlug)
				->whereNotIn('slug', $articlesDogSlug)
				->whereNotIn('slug', $articlesCatSlug))
				->latest()
				->take(4)
				->get();
		}
		else $articles = $articles->paginate(15);

		if($this->argument1 && $articleSection) {
			if(!$this->argument2) {
				$targets = ArticleTarget::withCount('articles')
					->whereHas('articles.sections', function($whereHas) use($articleSection) {
						$whereHas->where('slug', $articleSection->slug);
					})
					->distinct()
					->orderByDesc('articles_count')
					->get();

				$species = Species::withCount('articles')
					->whereHas('articles.sections', function($whereHas) use($articleSection) {
						$whereHas->where('slug', $articleSection->slug);
					})
					->distinct()
					->orderByDesc('articles_count')
					->get();

				$tags = ArticleTag::withCount('articles')
					->whereHas('articles.sections', function($whereHas) use($articleSection) {
						$whereHas->where('slug', $articleSection->slug);
					})
					->distinct()
					->orderByDesc('articles_count')
					->get();

				$menuEntries = $targets->concat($species)->concat($tags);
			}
		}
		else $menuEntries = ArticleSection::orderBy('id', 'ASC')->get();

		return view('livewire.front.articles.index', [
			'argument1' => $this->argument1,
			'argument2' => $this->argument2,
			'allSpecies' => $allSpecies,
			'articles' => $articles,
			'articleAuthor' => $articleAuthor,
			'articlesHealth' => $articlesHealth,
			'articlesCat' => $articlesCat,
			'articlesDog' => $articlesDog,
			'articlesNutrition' => $articlesNutrition,
			'articlesEducation' => $articlesEducation,
			'articlesReproduction' => $articlesReproduction,
			'articlesSelection' => $articlesSelection,
			'articleTag' => $articleTag,
			'articleTarget' => $articleTarget,
			'articleTargets' => $articleTargets,
			'menuEntries' => $menuEntries,
			'mostRead' => $mostRead,
			'articleSections' => $articleSections,
			'articleSection' => $articleSection,
			'articleSpecies' => $articleSpecies
		]);
	}
}
