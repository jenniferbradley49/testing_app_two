<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThreeStepAdmin extends Model
{

	public function getDataArrayViewLog($obj_three_step_log, 
    		$arr_logged_in_user)
	{
		foreach ($obj_three_step_log as $key => $row)
		{
			$arr_three_step_log[$key]['id'] = $row->id;
			$arr_three_step_log[$key]['ip_address'] = $row->ip_address;
			$arr_three_step_log[$key]['step'] = $row->step;
			$obj_created_at = null;
			$obj_created_at = Carbon::parse($row->created_at);
			$arr_three_step_log[$key]['date'] = $obj_created_at->format('M d Y');
			$arr_three_step_log[$key]['time'] = $obj_created_at->format('H:i:s');
		}
		return array(
				'arr_three_step_log' => $arr_three_step_log,
				'arr_logged_in_user' => $arr_logged_in_user
		);
	}
	
	
}
