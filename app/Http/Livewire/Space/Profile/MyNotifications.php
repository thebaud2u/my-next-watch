<?php

namespace App\Http\Livewire\Front\Space\Profile;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\{ReadNotification, User};

class MyNotifications extends Component
{
	public User $user;
	public $notifications;
	public $notReadNotifications;
	public $tab = 'all';
	public $loaded = false;

	// Settings
	public $showLink = false;
	public $limit = false;
	public $isMenu = false;

	public function showNotifications($type)
	{
		$this->tab = $type;

		if($type == 'all') $this->notifications = $this->user->getAllNotifications($this->limit);
		elseif($type == 'notRead') $this->notifications = $this->user->getNotReadNotifications($this->limit);
		elseif($type == 'read') $this->notifications = $this->user->getReadNotifications($this->limit);
	}

	public function markAsRead($id, $url)
	{
		ReadNotification::create([
			'notification_id' => $id,
			'user_id' => $this->user->id
		]);

		$this->redirectTo($url);
	}

	public function redirectTo($url)
	{
		return redirect()->to($url);
	}

	public function loadNotifications()
	{
		$this->notifications = $this->user->getAllNotifications($this->limit);
		$this->notReadNotifications = $this->user->getNotReadNotifications($this->limit)->pluck('id')->toArray();
		$this->loaded = true;
	}

	public function mount()
	{
		$this->user = Auth::guard('web')->user();
	}

	public function render()
	{
		return view('livewire.front.space.profile.my-notifications');
	}
}
