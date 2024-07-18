<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
	use HasFactory;

	public function qualify()
	{
		return $this->morphOne(Criteria::class, 'qualifiable');
	}
}
