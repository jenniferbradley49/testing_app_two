<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThreeStepAdmin extends Model
{

	public function getValidationRulesChangePassword()
	{
		return array(
				'curr_password' => 'required|max:50',
				'password' => 'Required|Confirmed|AlphaNum|Between:6,12',
				'password_confirmation' => 'required|alphaNum|between:6,12'
		);
	}
	

	public function getValidationRulesChangePasswordHint()
	{
		return array(
				'hint' => 'required|max:250'
		);
	}
	

	public function getRequestArrayChangePassword($request)
	{
		return array(
				'curr_password' => $request->curr_password,
				'password' => $request->password
		);
	}
	
	
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

	public function getDataArrayChangePassword($message, $arr_logged_in_user)
	{
		$data = array(
//				'hint' => $hint,
				'arr_logged_in_user' => $arr_logged_in_user
		);
		
		if (isset($message))
		{
			return array_merge($data, array('message' => $message));
		}
		else return $data;
		
	}
	
	

	public function getDataArrayChangePasswordHint($hint, $arr_logged_in_user)
	{
		return array(
				'hint' => $hint,
				'arr_logged_in_user' => $arr_logged_in_user
		);
	}
	
	
}
