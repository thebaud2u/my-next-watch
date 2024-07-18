<?php

namespace App\Http\Livewire\Admin;

use DB;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;

class Users extends Component
{
	use WithPagination;

	// Criterias
	public $role;
	public $keyword;

	public $user;

	public function disableUser($id)
	{
		$user = User::find($id);
		$user->delete();

		session()->flash('success', __('User ":user" disabled', ['user' => $user->name]));
	}

	public function enableUser($id)
	{
		$user = User::withTrashed()
			->find($id);
		$user->restore();

		session()->flash('success', __('User ":user" enabled', ['user' => $user->name]));
	}

	public function mount()
	{

	}

	public function render()
	{
		$users = User::distinct('users.id')
			->when($this->keyword, function ($query, $value) {
				$query->where('name', 'LIKE', '%'.$value.'%');
				$query->orWhere('email', 'LIKE', '%'.$value.'%');
			})
			->when($this->role, function ($query, $value) {
				$query->whereHas('roles', function($subquery) {
					$subquery->where('name', $this->role);
				});
			})
			->withTrashed()
			->paginate(10);

		return view('livewire.admin.users', [
			'users' => $users
		]);
	}
}
