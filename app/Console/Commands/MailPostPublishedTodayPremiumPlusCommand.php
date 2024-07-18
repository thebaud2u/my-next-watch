<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\Post;

class MailPostPublishedTodayPremiumPlusCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mail:post_published_today_premium_plus';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send Mail listing all posts resumee, and their companies, that have been published today for offer "Premium +"';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$postsPublishedTodayPremiumPlus = Post::whereHas('offer', function($whereHasOffer) {
				$whereHasOffer->where('slug', 'LIKE', 'F3ASH%');
			})
			->where('state', '=', 4)
			->where('published_at', 'LIKE', Carbon::now()->format('Y-m-d').'%')
			->get();

		$object = 'Relai individuel';
		$body = '';

		if($postsPublishedTodayPremiumPlus->isNotEmpty()) {
			foreach($postsPublishedTodayPremiumPlus as $postPublishedTodayPremiumPlus) {
				if(is_null($postPublishedTodayPremiumPlus->short_description)) $resume = '';
				else $resume = $postPublishedTodayPremiumPlus->short_description;

				$ville = 'Pas de ville';
				$departement = 'Pas de département';
				if(!is_null($postPublishedTodayPremiumPlus->address)) {
					if(!is_null($postPublishedTodayPremiumPlus->address->city)) $ville = $postPublishedTodayPremiumPlus->address->city->name;
					if(!is_null($postPublishedTodayPremiumPlus->address->department)) $departement = $postPublishedTodayPremiumPlus->address->department->name.' ('.$postPublishedTodayPremiumPlus->address->department->code.')';
				}

				$body .= '<p>'.$postPublishedTodayPremiumPlus->company->name.'</p>
					<p>'.$postPublishedTodayPremiumPlus->user->name.' - '.$postPublishedTodayPremiumPlus->user->email.'</p>
					<p>'.$ville.' - '.$departement.'</p>
					<p>'.$postPublishedTodayPremiumPlus->title.'</p>
					<p>'.$resume.'</p>
					<p>'.__('To relay on the social network').' '.$postPublishedTodayPremiumPlus->values['social_media_relay'].'</p>
					<p>
						<a href="https://job.tema-transport-logistique.com/offre-emploi/'.$postPublishedTodayPremiumPlus->id.'/'.$postPublishedTodayPremiumPlus->slug.'">
							https://job.tema-transport-logistique.com/offre-emploi/'.$postPublishedTodayPremiumPlus->id.'/'.$postPublishedTodayPremiumPlus->slug.'
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
