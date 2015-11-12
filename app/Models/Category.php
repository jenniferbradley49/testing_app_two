<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
	

	public function process_categories($arr_categories_raw)
	{
		$arr_categories_processed = array(0 => "please choose an option");
	
		foreach ($arr_categories_raw as $category)
		{
			$arr_categories_processed[$category['id']] = $category['category'];
		}
		 
		return $arr_categories_processed;
	
	}  // end function process_users
	
	
}
