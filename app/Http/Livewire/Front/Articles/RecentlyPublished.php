<?php

namespace App\Http\Livewire\Front\Articles;

use Livewire\Component;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

use App\Enums\ArticleStates;

use App\Models\{Article};

class RecentlyPublished extends Component
{
	public $articles;
	public $forBreed = null;
	public $forArticleSections = null;
	public $forSpecies = null;
	public $forArticleTargets = null;
	public $forArticleTags = null;
	public $forFigo = false;
	public $mode = 4;
	public $random = false;
	public $smallCard = false;
	public $title = true;
	public $isGrid = false;
	public $displayAllTags = true;

	public function render()
	{
		if(!$this->random) {
			$key = 'recently_published_breeders_' . md5(json_encode([
				'forArticleSections' => $this->forArticleSections,
				'forArticleTargets' => $this->forArticleTargets,
				'forSpecies' => $this->forSpecies,
				'forBreed' => $this->forBreed,
				'forFigo' => $this->forFigo,
				'mode' => $this->mode,
				'forArticleTags' => $this->forArticleTags,
			]));

			$this->articles = Cache::remember($key, now()->addDay(), function () {
				return Article::latest()
					->when($this->forArticleSections, function($when) {
						$when->whereHas('sections', function($whereHas) {
							$whereHas->whereIn('slug', $this->forArticleSections);
						});
					})
					->when($this->forArticleTargets, function($when) {
						$when->whereHas('targets', function($whereHas) {
							$whereHas->whereIn('slug', $this->forArticleTargets);
						});
					})
					->when($this->forSpecies, function($when) {
						$when->whereHas('species', function($whereHas) {
							$whereHas->where('slug->en', $this->forSpecies);
						});
					})
					->when($this->forBreed, function($when) {
						$when->whereHas('breeds', function($whereHas) {
							$whereHas->where('slug', $this->forBreed);
						});
					})
					->when($this->forArticleTags, function($when) {
						$when->whereHas('tags', function($whereHas) {
							$whereHas->whereIn('slug', $this->forArticleTags);
						});
					})
					->when($this->forFigo, function($when) {
						$when->where(function($where) {
							$where->where('values->figoAdopter', true)
								->orWhere('values->figoBreeder', true);
						});
					})
					->where('state', ArticleStates::Published)
					->take($this->mode)
					->get();
			});
		}
		else {
			$this->articles = Article::when($this->forArticleSections, function($when) {
					$when->whereHas('sections', function($whereHas) {
						$whereHas->where('slug', $this->forArticleSections);
					});
				})
				->when($this->forSpecies, function($when) {
					$when->whereHas('species', function($whereHas) {
						$whereHas->where('slug->en', $this->forSpecies);
					});
				})
				->when($this->forBreed, function($when) {
					$when->whereHas('breeds', function($whereHas) {
						$whereHas->where('slug', $this->forBreed);
					});
				})
				->when($this->forArticleTags, function($when) {
					$when->whereHas('tags', function($whereHas) {
						$whereHas->whereIn('slug', $this->forArticleTags);
					});
				})
				->when($this->forFigo, function($when) {
					$when->where(function($where) {
						$where->where('values->figoAdopter', true)
							->orWhere('values->figoBreeder', true);
					});
				})
				->where('state', ArticleStates::Published)
				->inRandomOrder()
				->take($this->mode)
				->get();
		}

		return view('livewire.front.articles.recently-published');
	}
}
