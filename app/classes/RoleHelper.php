<?php
namespace App\classes;

class RoleHelper
{
	public function prepare_logged_in_user_info($obj_logged_in_user)
	{
		return array(
				'user_id' => $obj_logged_in_user->id,
				'first_name' => $obj_logged_in_user->first_name,
				'last_name' => $obj_logged_in_user->last_name,
				'email' => $obj_logged_in_user->email
		);	
	}
	
	public function call_redirect()
	{
		//    	return Redirect::to('auth/login')
//		return back()
//		->withErrors(array('message' => 'Your login does not have the appropriate privileges to view the intended page'));
		return view('auth/no_permission');
	}
}