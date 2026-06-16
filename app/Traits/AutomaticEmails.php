<?php

namespace App\Traits;
use Illuminate\Support\Carbon;

use App\Notifications\NotificationOnly;

use App\Models\{Animal, Company, MailLog, Post, ProfessionnalActivity, Response, Subscription};

trait AutomaticEmails
{
	public function sendAutomaticEmail(string $type, int $param1 = null, int $param2 = null)
	{
		$newMailLog = new MailLog;
		$newMailLog->user_id = $this->id;
		$newMailLog->type = $type;

		if($type == 'animal-reserved-for-unknown-user') {
			$animal = Animal::find($param1);

			if($animal) $newMailLog->model()->associate($animal);
		}
		elseif($type == 'bank-transfer-received') {
			$subscription = Subscription::find($param1);

			if($subscription) $newMailLog->model()->associate($subscription);
		}
		elseif($type == 'animal-adopted-for-known-user' && $param1) {
			$response = Response::find($param1);

			if($response) $newMailLog->model()->associate($response);
		}
		elseif($type == 'breeder-account-denied') $newMailLog->model()->associate($this->lastModeration);
		elseif($type == 'professionnal-account-denied') $newMailLog->model()->associate($this->lastModeration);
		elseif($type == 'post-validated') {
			$post = Post::find($param1);

			if($post) $newMailLog->model()->associate($post);
		}
		elseif($type == 'post-denied') {
			$post = Post::find($param1);

			if($post) $newMailLog->model()->associate($post->lastModeration);
		}
		elseif($type == 'company-validated') {
			$company = Company::find($param1);

			if($company) $newMailLog->model()->associate($company);
		}
		elseif($type == 'company-denied') {
			$company = Company::find($param1);

			if($company) $newMailLog->model()->associate($company->lastModeration);
		}
		elseif($type == 'professionnal-activity-validated') {
			$professionnalActivity = ProfessionnalActivity::find($param1);

			if($professionnalActivity) $newMailLog->model()->associate($professionnalActivity);
		}
		elseif($type == 'professionnal-activity-denied') {
			$professionnalActivity = ProfessionnalActivity::find($param1);

			if($professionnalActivity) $newMailLog->model()->associate($professionnalActivity->lastModeration);
		}
		elseif($type == 'animal-denied') {
			$animal = Animal::find($param1);

			if($animal) $newMailLog->model()->associate($animal->lastModeration);
		}

		$newMailLog->save();
	}

	public function sendNotificationOnly(string $type, int $param1 = null, int $param2 = null)
	{
		$model = null;

		if($type == 'adoption-congratulation') {
			$response = Response::find($param1);

			if($response) $model = $response;
		}

		$this->notify(new NotificationOnly($this, $type, $model));
	}
}
