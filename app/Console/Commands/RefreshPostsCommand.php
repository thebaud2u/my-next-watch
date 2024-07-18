<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Enums\PostStatesEnum;

use App\Models\Post;

class RefreshPostsCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'refresh:posts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh posts';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$postsWeeklyRefresh = Post::where('archived_at', '>=', Carbon::now()->format('Y-m-d'))
			->whereHas('options', function($whereHas) {
				$whereHas->where('code', '=', 'weekly_refresh');
			})
			->where(function($where) {
				$where->where('refreshed_at', '<=', Carbon::now()->subWeek()->format('Y-m-d'))
					->orWhereNull('refreshed_at');
			})
			->where('state', '=', PostStatesEnum::Published)
			->get();

		if($postsWeeklyRefresh->isNotEmpty()) {
			foreach($postsWeeklyRefresh as $postWeeklyRefresh) {
				$post = Post::find($postWeeklyRefresh->id);
				$post->refreshed_at = Carbon::now();
				$post->save();
			}
		}

		$postsDailyRefresh = Post::where('archived_at', '>=', Carbon::now()->format('Y-m-d'))
			->whereHas('options', function($whereHas) {
				$whereHas->where('code', '=', 'daily_refresh');
			})
			->where(function($where) {
				$where->where('refreshed_at', '<=', Carbon::now()->subDay()->format('Y-m-d'))
					->orWhereNull('refreshed_at');
			})
			->where('state', '=', PostStatesEnum::Published)
			->get();

		if($postsDailyRefresh->isNotEmpty()) {
			foreach($postsDailyRefresh as $postDailyRefresh) {
				$post = Post::find($postDailyRefresh->id);
				$post->refreshed_at = Carbon::now();
				$post->save();
			}
		}

		return Command::SUCCESS;
	}
}
