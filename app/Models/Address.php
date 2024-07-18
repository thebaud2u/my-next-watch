<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'street',
		'additional_1',
		'additional_2',
		'custom_postcode',
		'custom_province',
		'custom_city',
		'region_id',
		'department_id',
		'city_id',
		'country_id',
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function region()
	{
		return $this->belongsTo(Region::class);
	}

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function model(): MorphTo
	{
		return $this->morphTo();
	}

	public function show()
	{
		if($this->city) return $this->city->name.' ('.$this->city->zip_code.')';

		return $this->custom_city;
	}
}
