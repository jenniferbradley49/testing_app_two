<?php
namespace App\classes;

use Storage;


class Communication
{
	public function saveFile($arr_info)
	{
		$json_info = json_encode($arr_info);
		Storage::put('communication.txt', $json_info);
		return '';
	}

}