<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThreeStepAdmin extends Model
{
	protected $table = 'three_step_admin';
	
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
				'new_hint' => 'required|max:250'
		);
	}
	

	public function getValidationRulesConfigure()
	{
		return array(
				'ts_implement' => 'required|integer|between:0,1',
				'ts_bypass' => 'Required|integer|min:0|max:1',
				'permit_delay' => 'required|integer|between:0,120'
		);
	}
	
	
	
	public function getRequestArrayChangePassword($request)
	{
		return array(
				'curr_password' => $request->curr_password,
				'password' => $request->password
		);
	}
	

	public function getRequestArrayChangePasswordHint($request)
	{
		return array(
				'new_hint' => $request->new_hint
		);
	}
	

	public function getRequestArrayConfigure($request)
	{
		return array(
				'ts_implement' => $request->ts_implement,
				'ts_bypass' => $request->ts_bypass,
				'permit_delay' => $request->permit_delay
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

	public function getDataArrayConfig($arrConfigInfo, $arrConfigDropDownOptions, $arr_logged_in_user)
	{
		return array(
			'arrConfigInfo' => $arrConfigInfo,
			'arrConfigDropDownOptions' => $arrConfigDropDownOptions,
			'arr_logged_in_user' => $arr_logged_in_user
		);
	}
	
	
	public function getConfigDropDownOptions()
	{
		$arrTSImplementOpts = array(0 => 'no, do NOT implement / enforce three step security', 
				1 => 'Yes, do implement / enforce three step security'
			);
		$arrTSBypassOpts = array(0 => 'no, do NOT bypass three step security',
				1 => 'Yes, do bypass three step security'
			);
		$arrPermitDelayOpts = array(5 => 5,
				10 => 10,				
				15 => 15,
				30 => 30,	
				45 => 45,
				60 => 60,
				120 => 120,
				0 => 'never' 
		);
		
		return array('arrTSImplementOpts' => $arrTSImplementOpts,
				'arrTSBypassOpts' => $arrTSBypassOpts,
				'arrPermitDelayOpts' => $arrPermitDelayOpts	
			);
	}
	
	
	public function getConfigInfo($user)
	{
		$objResults = $this->where('ts_user', 'admin')->first();
		$arrConfigInfo = array();
		$arrConfigInfo['ts_implement'] = $objResults->ts_implement;
		$arrConfigInfo['ts_bypass'] = $objResults->ts_bypass;
		$arrConfigInfo['permit_delay'] = $objResults->permit_delay;
		return $arrConfigInfo;
	}

	
	public function getTSImplement()
	{
		$objResults = $this->where('ts_user', 'admin')->first();
		return $objResults->ts_implement;
	}

	
	public function getTSBypass()
	{
		$objResults = $this->where('ts_user', 'admin')->first();
		return $objResults->ts_bypass;
	}
	
}




