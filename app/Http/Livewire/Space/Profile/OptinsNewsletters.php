<?php

namespace App\Http\Livewire\Front\Space\Profile;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Services\BrevoService;

use App\Models\User;

class OptinsNewsletters extends Component
{
	public User $user;

	public $optinNewsletter = 0;
	public $optinReceiveInfo = 0;
	public $optinReceiveDeals = 0;

	protected $brevoService;

	protected function rules()
	{
		return [
			'optinNewsletter' => [],
			'optinReceiveInfo' => [],
			'optinReceiveDeals' => []
		];
	}

	public function updateOptinsInfo()
	{
		$suffix = '';
		$attributes = [];

		if($this->user->hasRole('recruiter')) $suffix = 'ELEVEUR';
		elseif($this->user->hasRole('professionnal')) $suffix = 'PROFESSIONNEL';
		elseif($this->user->hasRole('applicant')) $suffix = 'ADOPTANT';

		$this->brevoService = new BrevoService;

		if($this->optinNewsletter == 1) $attributes['OPTIN_NL_'.$suffix] = 1;
		else $attributes['OPTIN_NL_'.$suffix] = 2;

		if($this->optinReceiveInfo == 1) $attributes['OPTIN_MARKETING_'.$suffix] = 1;
		else $attributes['OPTIN_MARKETING_'.$suffix] = 2;

		if($this->optinReceiveDeals == 1) $attributes['OPTIN_PARTENAIRE_'.$suffix] = 1;
		else $attributes['OPTIN_PARTENAIRE_'.$suffix] = 2;

		$result = $this->brevoService->addContactToList(
			$this->user->email,
			[9],
			$attributes
		);

		$this->user->updateValue('optins', [
			'optin_newsletter' => $this->optinNewsletter,
			'optin_receive_info' => $this->optinReceiveInfo,
			'optin_receive_deals' => $this->optinReceiveDeals,
			'optin_figo' => $this->user->values->get('optins')['optin_figo']
		]);

		$this->user->save();
	}

	public function mount()
	{
		$this->user = Auth::guard('web')->user();

		$this->optinNewsletter = data_get($this->user->values, 'optins.optin_newsletter');
		$this->optinReceiveInfo = data_get($this->user->values, 'optins.optin_receive_info');
		$this->optinReceiveDeals = data_get($this->user->values, 'optins.optin_receive_deals');
	}

	public function render()
	{
		return view('livewire.front.space.profile.optins-newsletters');
	}
}
