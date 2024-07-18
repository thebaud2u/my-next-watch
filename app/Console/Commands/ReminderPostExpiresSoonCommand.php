<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\Post;

class ReminderPostExpiresSoonCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reminder:post-expires-soon';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$posts = Post::where('state', '=', 4)
			->get();

		if($posts->isNotEmpty()) {
			foreach($posts as $post) {
				$sendMail = false;
				$archivedAt = Carbon::parse($post->archived_at)->startOfDay();
				$now = Carbon::now()->startOfDay();
				$previousReminder = MailLog::where('user_id', '=', $post->user->id)
					->where('post_id', '=', $post->id)
					->where('type', '=', 'reminder-post-expires-soon')
					->latest('created_at')
					->first();

				if($previousReminder) {
					$lastReminderDate = Carbon::parse($previousReminder->created_at)->startOfDay();

					if($previousReminder->reminder_number == 1 && $lastReminderDate->diffInDays($now) == 4) {
						$sendMail = true;
						$reminderNumber = 2;
					}
					else if($previousReminder->reminder_number == 2 && $lastReminderDate->diffInDays($now) == 1) {
						$sendMail = true;
						$reminderNumber = 3;
					}
				}
				else {
					if($now->diffInDays($archivedAt) == 5) {
						$sendMail = true;
						$reminderNumber = 1;
					}
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $post->user->id;
					$reminder->post_id = $post->id;
					$reminder->type = 'reminder-post-expires-soon';
					$reminder->reminder_number = $reminderNumber;
					$reminder->save();
				}
			}
		}

		return Command::SUCCESS;
	}
}
