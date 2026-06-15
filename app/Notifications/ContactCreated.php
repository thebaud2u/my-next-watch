<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

use App\Models\Contact;

class ContactCreated extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(public Contact $contact)
	{
		//
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		$recipient = 'contact@eleveurs-online.com';

		if($notifiable->object == 'information') $object = __('Information');
		elseif($notifiable->object == 'ad') $object = __('Problem with an ad');
		elseif($notifiable->object == 'beeding-page') $object = __('Problem with a breeding page');
		elseif($notifiable->object == 'product-or-service-activity') $object = __('Problem with a product or service activity page');
		elseif($notifiable->object == 'application') $object = __('Problem with an inquire');
		elseif($notifiable->object == 'report') $object = __('Report fraudulent behaviour or advertisement');
		elseif($notifiable->object == 'account') $object = __('Account Certification');
		elseif($notifiable->object == 'other') $object = __('Other request');
		elseif($notifiable->object == 'advertiser') {
			$object = __('I am an advertiser and want more information');
			$recipient = 'elodie.gauchet@1health.fr';
		}
		elseif($notifiable->object == 'professionnal-breeder') $object = __('I\'m a professionnal breeder and I\'d like to switch to an individual breeder');
		elseif($notifiable->object == 'application-rdv-issue') $object = __('Report an issue about a inquire or a rendez-vous');
		elseif($notifiable->object == 'member-snpcc') $object = __('Request to benefit from 20% as an SNPCC member');
		elseif($notifiable->object == 'data-deletion') $object = __('I wish to delete my account and the removal of all my personnal data');

		$object = env('APP_NAME').' - '.__('New contact email').' - '.$object;

		$message = (new MailMessage)
			->to($recipient)
			->subject($object)
			->greeting(__('Hello').', '.$notifiable->firstname.' '.$notifiable->lastname)
			->line(__('This is an email sent from the contact form'))
			->line(__('Sender').': '.$notifiable->firstname.' '.$notifiable->lastname.' ('.$notifiable->email.') - '.$notifiable->phone)
			->line(__('Message').':')
			->line($notifiable->body);

		if($notifiable->file) {
			$message->action(__('Download attachment'), Storage::disk('public')->url($notifiable->file));
		}

		return $message;
	}
}
