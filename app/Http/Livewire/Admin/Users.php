<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Password;

use App\Models\{Role, User};

class Users extends Component
{
	use WithPagination;

	public User $user;

	// Criterias
	public $role;
	public $keyword;

	public $switchState = '';
	public $currentEmail = '';
	public $email;
	public $endDatesAcaced = ['dogs' => null, 'cats' => null];

	protected function rules() {
		return [
			'email' => [],
			'endDatesAcaced' => []
		];
	}

	public function toggleBreederRole()
	{
		if($this->user->exists) {
			if($this->user->hasRole('recruiter')) {
				if($this->user->hasRole('professionnal_breeder')) {
					$this->user->removeValues(['siret', 'company_name', 'siren_document']);
					$this->user->syncRoles(['individual_breeder']);
				}
				elseif($this->user->hasRole('individual_breeder')) {
					$optinsValues = $this->user->values->get('optins');
					$this->user->values = new Collection();
					$this->user->save();

					$this->user->syncRoles(['professionnal_breeder']);

					$this->user->initValues();

					$this->user->updateValue('optins', $optinsValues);
				}

				$this->user->save();

				if($this->user->moderations->isNotEmpty()) {
					foreach($this->user->moderations as $moderation) {
						$moderation->delete();
					}
				}

				$this->dispatch('roles-switched');
				$this->fresh();
			}
		}
	}

	public function toggleUser()
	{
		if($this->user->exists) {
			if($this->user->trashed()) $this->user->restore();
			else $this->user->delete();

			$this->dispatch('account-toggled');
			$this->fresh();
		}
	}

	public function changeEmail()
	{
		if($this->user->exists) {
			$rules = [
				'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
			];

			$messages = [
				'email.required' => __(':element is mandatory', ['element' => __('The email')]),
				'email.email' => __(':element is expected', ['element' => __('An email')]),
				'email.lowercase' => __('Your :element must be in lowercase', ['element' => __('email')]),
				'email.max' => __('Your :element must be :x caracters maximum', ['element' => __('email'), 'x' => 255]),
				'email.unique' => __('An account already exists with this email'),
			];

			$this->validate($rules, $messages);

			$this->user->email = $this->email;
			$this->user->save();

			$this->dispatch('email-changed');
			$this->fresh();
		}
	}

	public function resetPassword()
	{
		if($this->user->exists) {
			$token = Password::createToken($this->user);
			$this->user->sendPasswordResetNotification($token);

			$this->dispatch('password-changed');
			$this->fresh();
		}
	}

	public function verifyEmail($id)
	{
		$user = User::find($id);

		if($user) {
			$user->email_verified_at = Carbon::now();
			$user->save();

			session()->flash('success', __('User ":user" email verified', ['user' => $user->name]));
		}
	}

	public function updateAcacedDates()
	{
		if($this->user->exists) {
			$this->user->updateValue('end_dates_acaced', $this->endDatesAcaced);
			$this->user->save();

			$this->dispatch('acaced-changed');
			$this->fresh();
		}
	}

	public function getUser($id, $modal)
	{
		$user = User::withTrashed()->find($id);

		if($user) {
			$this->user = $user;

			if($modal == 'toggle-account') {
				if($this->user->trashed()) $this->switchState = __('Restore the account');
				else $this->switchState = __('Disable the account');
			}
			elseif($modal == 'change-user-email') $this->currentEmail = $this->user->email;
			elseif($modal == 'update-acaced') $this->endDatesAcaced = $this->user->values->get('end_dates_acaced');

			$this->dispatch('open-modal', $modal);
		}
	}

	public function fresh()
	{
		$this->user = new User;
		$this->switchState = '';
		$this->currentEmail = '';
		$this->email = '';
		$this->endDatesAcaced = ['dogs' => null, 'cats' => null];
		$this->dispatch('user-reset');
	}

	public function mount()
	{
		$this->fresh();
	}

	public function render()
	{
		$users = User::distinct('users.id')
			->when($this->keyword, function($when) {
				$when->where('name', 'LIKE', '%'.$this->keyword.'%')
					->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
					->orWhere('id', 'LIKE', '%'.$this->keyword.'%')
					->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
			})
			->when($this->role, function($when) {
				$when->whereHas('roles', function($whereHas) {
					$whereHas->where('id', $this->role);
				});
			})
			->orderByDesc('last_logon')
			->withTrashed()
			->paginate(10);

		$roles = Role::where('guard_name', 'web')
			->get();

		return view('livewire.admin.users', [
			'users' => $users,
			'roles' => $roles
		]);
	}
}
