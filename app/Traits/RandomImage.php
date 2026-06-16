<?php

namespace App\Traits;

trait RandomImage
{
	public function __getRandomImage($id)
	{
		$image = 'default-images/thematics/'.$id.'/';

		if($id == 1 || $id == 3 || $id == 7 || $id == 8 || $id == 9) $image .= '1.jpg';
		else if($id == 2 || $id == 4 || $id == 6) $image .= rand(1, 2).'.jpg';
		else if($id == 5) $image .= rand(1, 3).'.jpg';

		return $image;
	}
}
