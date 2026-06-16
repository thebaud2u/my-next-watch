<?php

namespace App\Http\Livewire\Front\Companies;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Enums\ContactTypes;

use App\Models\{Company, Contact, User};

class CallCompany extends Component
{
	public Company $company;
	public User $user;

	public $step = 1;
	public $companyPhoneNumber;

	// Properties
	public $phone;
	public $email;
	public $firstname;
	public $lastname;
	public $consent = false;
	public $captcha;

	protected function rules()
	{
		return [
			'message' => [],
			'phone' => [],
			'email' => [],
			'consent' => [],
			'captcha' => []
		];
	}

	public function form()
	{
		if($this->step == 1) {
			$rules = [
				'email' => ['required', 'string', 'lowercase', 'email'],
				'phone' => ['required', 'phone:BE,FR'],
				'firstname' => ['required'],
				'lastname' => ['required'],
				'consent' => ['required'],
				'captcha' => ['required', 'captcha']
			];

			$messages = [
				'email.required' => __(':element is mandatory', ['element' => __('The email')]),
				'email.email' => __(':element is expected', ['element' => __('An email')]),
				'email.lowercase' => __('Your :element must be in lowercase', ['element' => __('email')]),
				'phone.required' => __(':element is mandatory', ['element' => __('Your phone number')]),
				'phone.phone' => __('Your phone number format is invalid'),
				'firstname.required' => __(':element is mandatory', ['element' => __('Your firstname')]),
				'lastname.required' => __(':element is mandatory', ['element' => __('Your firstname')]),
				'consent.required' => __('You must accept the conditions'),
				'captcha.required' => __(':element is mandatory', ['element' => __('The captcha')])
			];

			$this->validate($rules, $messages);

			$newCall = new Contact;
			$newCall->email = strtolower($this->email);
			$newCall->phone = $this->phone;
			$newCall->firstname = $this->firstname;
			$newCall->lastname = $this->lastname;
			$newCall->type = ContactTypes::Call->value;
			$newCall->model()->associate($this->company);
			$newCall->save();

			$this->companyPhoneNumber = $this->company->phone;
			$this->step++;
		}
	}

	public function mount()
	{
		if(Auth::guard('web')->check()) {
			$this->user = Auth::guard('web')->user();
			$this->email = $this->user->email;
			$this->phone = $this->user->phone;
			$this->firstname = $this->user->firstname;
			$this->lastname = $this->user->lastname;
		}
		else $this->user = new User;
	}

	public function render()
	{
		return view('livewire.front.companies.call-company');
	}
}
