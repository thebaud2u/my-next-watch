<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;

use App\Models\Thematics;

class General extends Component
{
	public $thematics;

	public function switchThematic($id)
	{
		$thematic = Thematic::find($id);

		if($thematic->enabled) {
			$thematic->enabled = 0;
			$state = 'disabled';
		}
		else {
			$thematic->enabled = 1;
			$state = 'enabled';
		}

		$thematic->save();

		session()->flash('success', __('Thematic ":thematic" :state', ['thematic' => $thematic->name, 'state' => __($state)]));
	}

	public function mount()
	{

	}

	public function render()
	{
		$this->thematics = Thematic::withoutGlobalScope('enabled-thematic')
			->get();

		return view('livewire.admin.settings.general');
	}
}
