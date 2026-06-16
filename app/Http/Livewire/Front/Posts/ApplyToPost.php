<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Database\Eloquent\Collection;

use App\Enums\{ContactTypes};

use App\Models\{Contact, Post, User};

class ApplyToPost extends Component
{
	public Post $post;
	public User $user;

	public $step = 1;

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

	public function apply()
	{
		if($this->stepContact == 1) {
			$rules = [
				'email' => ['required', 'string', 'lowercase', 'email'],
				'phone' => ['required', 'phone:BE,FR'],
				'firstname' => ['required'],
				'lastname' => ['required'],
				'message' => ['required'],
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
				'message.required' => __(':element is mandatory', ['element' => __('The message')]),
				'consent.required' => __('You must accept the conditions'),
				'captcha.required' => __(':element is mandatory', ['element' => __('The captcha')])
			];

			$this->validate($rules, $messages);

			$newApplication = new Contact;
			$newApplication->email = strtolower($this->email);
			$newApplication->phone = $this->phone;
			$newApplication->firstname = $this->firstname;
			$newApplication->lastname = $this->lastname;
			$newApplication->type = ContactTypes::Application->value;
			$newApplication->model()->associate($this->post);
			$newApplication->save();

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
		return view('livewire.front.posts.apply-to-post');
	}
}
