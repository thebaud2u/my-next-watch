<?php

namespace App\Traits;

use App\Models\{City, Country, Department, Region};

trait DisplayAddress
{
	public function displayFullAddress(string $collection = null): string
	{
		if(!is_null($collection)) $address = $this->address()->where('collection', $collection)->first();
		else $address = $this->address;

		if($address) {
			if($address->city || $address->custom_city) {
				$street = $address->street ? $address->street.',' : '';
				$city = $address->city ? $address->city->name : $address->custom_city;
				$code = $address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '');

				$address = $street.' '.$city.', '.$code.', '.$address->country->name;
			}
			elseif($address->department) $address = $address->department->name.' ('.$address->department->code.')';
			elseif($address->country && $address->country?->code == 'BEL' && $address->custom_province) $address = $address->custom_province;
			elseif($address->region) $address = $address->region->name;
			elseif($address->country) $address = $address->country->name;
			else $address = __('Unknown location');
		}
		else $address = __('Unknown location');

		return $address;
	}

	public function displayFullAddressForModeration(string $collection = null): string
	{
		if(!is_null($collection)) $address = $this->addressForModeration()->where('collection', $collection)->first();
		else $address = $this->addressForModeration;

		if($address) {
			if($address->city || $address->custom_city) {
				$street = $address->street ? $address->street.',' : '';
				$city = $address->city ? $address->city->name : $address->custom_city;
				$code = $address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '');

				$address = $street.' '.$city.', '.$code.', '.$address->country->name;
			}
			elseif($address->department) $address = $address->department->name.' ('.$address->department->code.')';
			elseif($address->country && $address->country->code == 'BEL' && $address->custom_province) $address = $address->custom_province;
			elseif($address->region) $address = $address->region->name;
			elseif($address->country) $address = $address->country->name;
			else $address = __('Unknown location');
		}
		else $address = __('Unknown location');

		return $address;
	}

	public function displayPartOfAddress(string $part, string $collection = null): string
	{
		if(!is_null($collection)) $address = $this->address()->where('collection', $collection)->first();
		else $address = $this->address;

		if($address) {
			switch($part) {
				case 'department+country':
					$address = ($address?->country?->code == 'FRA' ? ($address->department ? $address->department->name.',' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? $address->custom_province.',' : ''): '')).' '.$address->country->name;
					break;
				case 'department+zipcode+city':
					$address = ($address?->country?->code == 'FRA' ? ($address->department ? $address->department->name : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? $address->custom_province : ''): '')).' '.($address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '')).' '.($address->city ? $address->city->name : $address->custom_city);
					break;
				case 'department_code':
					$address = ($address?->country?->code == 'FRA' ? ($address->department ? '('.$address->department->code.')' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? '('.$address->custom_province.')' : ''): ''));
					break;
				case 'department+department_code':
					$address = ($address?->country?->code == 'FRA' ? ($address->department ? $address->department->name.' ('.$address->department->code.')' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? '('.$address->custom_province.')' : ''): ''));
					break;
				case 'full_alternative':
					if($address->city || $address->custom_city) {
						$street = $address->street ? $address->street : '';
						$code = $address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '');
						$city = $address->city ? $address->city->name : $address->custom_city;

						if($address->department) $department = ' - '.$address->department->name;
						else $department = '';

						$country = ', '.$address->country?->name;

						$address = $street.' '.$code.' '.$city.$department.$country;
					}
					elseif($address->department) $address = $address->department->name.' ('.$address->department->code.')';
					elseif($address->country && $address->country?->code == 'BEL' && $address->custom_province) $address = $address->custom_province;
					elseif($address->region) $address = $address->region->name;
					elseif($address->country) $address = $address->country->name;
					else $address = __('Unknown location');
					break;
				case 'zipcode+city':
					$address = ($address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '')).' '.($address->city ? $address->city->name : $address->custom_city);
					break;
			}
		}
		else $address = __('Unknown location');

		return $address;
	}

	public function displayPartOfAddressForModeration(string $part, string $collection = null): string
	{
		if(!is_null($collection)) $address = $this->addressForModeration()->where('collection', $collection)->first();
		else $address = $this->addressForModeration;

		if($address) {
			switch($part) {
				case 'department+country':
					$address = ($address->country?->code == 'FRA' ? ($address->department ? $address->department->name.',' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? $address->custom_province.',' : ''): '')).' '.$address->country->name;
					break;
				case 'department+zipcode+city':
					$address = ($address->country?->code == 'FRA' ? ($address->department ? $address->department->name : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? $address->custom_province : ''): '')).' '.($address->city ? $address->city->zip_code : (($address->custom_postcode) ? $address->custom_postcode: '')).' '.($address->city ? $address->city->name : $address->custom_city);
					break;
				case 'department_code':
					$address = ($address->country?->code == 'FRA' ? ($address->department ? '('.$address->department->code.')' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? '('.$address->custom_province.')' : ''): ''));
					break;
				case 'department+department_code':
					$address = ($address->country?->code == 'FRA' ? ($address->department ? $address->department->name.' ('.$address->department->code.')' : '') : ($address->country->code == 'BEL' ? ($address->custom_province ? '('.$address->custom_province.')' : ''): ''));
					break;
			}
		}
		else $address = __('Unknown location');

		return $address;
	}
}
