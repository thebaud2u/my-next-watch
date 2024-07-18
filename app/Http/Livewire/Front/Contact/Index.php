<?php

namespace App\Http\Livewire\Front\Contact;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mail;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Contact;
use App\Models\User;

use Mews\Captcha\Facades\Captcha;

class Index extends Component
{
	use WithFileUploads;

	public $steps = [1, 2];
	public $active = 1;
	public $captcha_img;

	public $contact_choice;
	public $firstname;
	public $lastname;
	public $phone;
	public $email;
	public $body;
	public $file;
	public $type_report;
	public $reported;
	public $consent;
	public $captcha = '';

	protected function rules()
	{
		return [
			'contact_choice' => [],
			'firstname' => [],
			'lastname' => [],
			'phone' => [],
			'email' => [],
			'type_report' => [],
			'reported' => [],
			'consent' => [],
			'captcha' => []
		];
	}

	public function refreshCaptcha()
	{
		$this->captcha_img = Captcha::img();
		$this->captcha = '';
	}

	public function submitFirstStep()
	{
		$rules = [
			'contact_choice' => ['required']
		];

		$messages = [
			'contact_choice.required' => 'Choisissez le type de votre demande'
		];

		$this->validate($rules, $messages);

		$this->active = 2;
	}

	public function submitSecondStep()
	{
		$rules = [
			'firstname' => ['required'],
			'lastname' => ['required'],
			'phone' => ['required'],
			'email' => ['required', 'email'],
			'consent' => ['required']
		];

		$messages = [
			'firstname.required' => 'Votre prénom est obligatoire',
			'lastname.required' => 'Votre nom est obligatoire',
			'phone.required' => 'Un numéro de téléphone est obligatoire',
			'email.required' => 'Une adresse email est obligatoire',
			'email.email' => 'Une adresse email est attendue',
			'consent.required' => 'Vous devez accepter les conditions'
		];

		if($this->contact_choice != 6) {
			$rules['body'] = ['required'];
			$messages['body.required'] = 'Le détail de votre demande est obligatoire';

			if($this->contact_choice == 1) $messages['body.required'] = 'Le détail de votre demande de modification est obligatoire';
			elseif($this->contact_choice == 2) $messages['body.required'] = 'Le détail de votre problème technique est obligatoire';
			elseif($this->contact_choice == 4) $messages['body.required'] = 'Le détail de votre signalement est obligatoire';
			elseif($this->contact_choice == 8) $messages['body.required'] = 'Veuillez préciser pour quelle annonce vous souhaitez élargir la diffusion';
		}

		if($this->contact_choice == 4) {
			$rules['type_report'] = ['required'];
			$rules['reported'] = ['required'];
			$messages['type_report.required'] = 'Sélectionnez le type de signalement';
			$messages['reported.required'] = 'Veuillez préciser l\'entité que vous signalez (dénomination de la personne / annonce / entreprise)';
		}

		$this->validate($rules, $messages);

		if(captcha_check($this->captcha) == false) {
			$this->addError('captcha', 'Le captcha est obligatoire');
			$this->refreshCaptcha();
		}
		else {
			$newContact = new Contact;
			$newContact->contact_choice = $this->contact_choice;
			$newContact->firstname = $this->firstname;
			$newContact->lastname = $this->lastname;
			$newContact->email = $this->email;
			$newContact->phone = $this->phone;

			if($this->contact_choice == 4) {
				$newContact->type_report = $this->type_report;
				$newContact->reported = $this->reported;
			}

			$newContact->body = $this->body;

			if($this->file) {
				$filePath = $this->file->store('contact', 'public');
				$newContact->file = $filePath;
			}

			$newContact->save();

			if($this->contact_choice == 1) $contact_choice = 'J\'ai une demande spécifique de modification d\'annonces à faire auprès du service client';
			if($this->contact_choice == 2) $contact_choice = 'J\'ai un problème technique lié à la plateforme';
			if($this->contact_choice == 4) $contact_choice = 'Je souhaite signaler un CV ou une annonce ou une entreprise';
			if($this->contact_choice == 5) $contact_choice = 'Je suis annonceur';
			if($this->contact_choice == 6) $contact_choice = 'Je souhaite obtenir plus d\'informations';
			if($this->contact_choice == 7) $contact_choice = 'Autre demande';
			if($this->contact_choice == 8) $contact_choice = 'Je souhaite élargir la zone de diffusion de mon annonce';
			if($this->contact_choice == 9) $contact_choice = 'Je souhaite demander une augmentation de ma limite journalière de téléchargements de CV sur la CVthèque';

			$body = "<p>Expéditeur : ".$this->firstname." ".$this->lastname." [ ".$this->email." ] - ".$this->phone."</p>\n";

			if($this->contact_choice == 4) {
				$body .= "<p>Type de signalement : ".nl2br(e($this->type_report))."</p>\n"
					."<p>Entité signalée : ".nl2br(e($this->reported))."</p>\n";
			}

			$body .= "<p>Message : ".nl2br(e($this->body))."</p>";

			if($this->file) $body .= "\n<p>Pièce jointe : <a href=".Storage::disk('public')->url($filePath).">Lien de téléchargement unique</a></p>";

			$recipients = 'transport-logistique-job@temagroupe.com';

			if($this->contact_choice == 5) $recipients = 's.papin@info6tm.com';

			$object = config('app.name', 'Jobboard').' - '.$contact_choice;

			Mail::send('components/layouts/mail', array('mailData' => $body), function ($message) use ($recipients, $object) {
				$message->to($recipients)->subject($object);
			});

			return redirect()->route('home')->with('success', __('Your request has been sent, thank you for contacting us'));
		}
	}

	public function back()
	{
		$this->active--;
	}

	public function goto($index)
	{
		$this->active = $index;
	}

	public function mount()
	{
		$this->captcha_img = Captcha::img();
	}

	public function render()
	{
		return view('livewire.front.contact.index');
	}
}
