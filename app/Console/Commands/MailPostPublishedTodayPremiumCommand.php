<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\Post;

class MailPostPublishedTodayPremiumCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mail:post_published_today_premium';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send Mail listing all posts resumee, and their companies, that have been published today for offer "Premium"';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$postsPublishedTodayPremium = Post::whereHas('offer', function($whereHasOffer) {
				$whereHasOffer->where('slug', 'LIKE', 'F2ASH%');
			})
			->where('state', '=', 4)
			->where('published_at', 'LIKE', Carbon::now()->format('Y-m-d').'%')
			->get();

		$object = 'Relai collectif';
		$body = '';

		if($postsPublishedTodayPremium->isNotEmpty()) {
			foreach($postsPublishedTodayPremium as $postPublishedTodayPremium) {
				if(is_null($postPublishedTodayPremium->short_description)) $resume = '';
				else $resume = $postPublishedTodayPremium->short_description;

				$ville = 'Pas de ville';
				$departement = 'Pas de département';
				if(!is_null($postPublishedTodayPremium->address)) {
					if(!is_null($postPublishedTodayPremium->address->city)) $ville = $postPublishedTodayPremium->address->city->name;
					if(!is_null($postPublishedTodayPremium->address->department)) $departement = $postPublishedTodayPremium->address->department->name.' ('.$postPublishedTodayPremium->address->department->code.')';
				}

				$body .= '<p>'.$postPublishedTodayPremium->company->name.'</p>
					<p>'.$postPublishedTodayPremium->user->name.' - '.$postPublishedTodayPremium->user->email.'</p>
					<p>'.$ville.' - '.$departement.'</p>
					<p>'.$postPublishedTodayPremium->title.'</p>
					<p>'.$resume.'</p>
					<p>'.__('To relay on the social network').' '.$postPublishedTodayPremium->values['social_media_relay'].'</p>
					<p>
						<a href="https://job.tema-transport-logistique.com/offre-emploi/'.$postPublishedTodayPremium->id.'/'.$postPublishedTodayPremium->slug.'">
							https://job.tema-transport-logistique.com/offre-emploi/'.$postPublishedTodayPremium->id.'/'.$postPublishedTodayPremium->slug.'
						</a>
					</p>
					<br/><br/>';
			}
		}
		else $body = '<p>Aucune annonce publiée aujourd\'hui</p>';

		$recipients = [''];

		Mail::send('components/layouts/mail', array('mailData' => $body), function ($message) use ($recipients, $object) {
			$message->to($recipients)->subject($object);
		});

		return Command::SUCCESS;
	}
}
