<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

use Mail;

class OfficeMailChannel
{
	public function send($notifiable, Notification $notification)
	{
		$mailData = $notification->toOfficeMailChannel($notifiable);

		Mail::send('components/layouts/mail', array('mailData' => $mailData['body']), function ($message) use ($mailData) {
			$message->to($mailData['recipient'])->subject($mailData['object']);
		});

		$causer = (! empty(Auth::guard('admin')->user()->id)) ? Auth::guard('admin')->user() : ((! empty(Auth::guard('web')->user()->id)) ? Auth::guard('web')->user() : null);
		activity('notification')
			// ->performedOn($notification) // $notification not a model => error
			->causedBy($causer)
			->event('sent')
			// ->withProperties(['content' => $mailContent])
			->withProperties([
				'content' => [
					'recipient' => $mailData['recipient'],
					'data' => [
						'objectJobboard' => $mailData['object'],
						'bodyJobboard' => $mailData['body']
					],
				]
			])
			->log('Notification sent');

		return true;
	}
}
