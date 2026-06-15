<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
	// Relations
	public function qualify(): MorphOne
	{
		return $this->morphOne(Criteria::class, 'qualifiable');
	}
}
