<?php

namespace App\Http\Controllers\test_preparer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(Role_user $role_user, RoleHelper $roleHelper)
	{
		$this->middleware('auth');
		if (Auth::check())
		{
			$this->roleHelper = $roleHelper;
			$this->bool_has_role = $role_user->hasRole('test preparer');
		}  // end if Auth::check()
	} // end __construct function
	

	public function get_sub_categories(Request $request, Role $role, Role_user $role_user)
	{
		if (!$this->bool_has_role)
		{
			return $this->roleHelper->call_redirect();
		}
		else
		{
			$validation_rules = [
			'user_id' => 'required|integer|min:1'
					];
			 
			$this->validate($request, $validation_rules);
	
			$arr_all_roles = $role->all();
			$arr_roles_possessed = $role_user->get_roles_possessed($request->user_id);
			$arr_roles_possessed = $role_user->process_roles_possessed_output($arr_roles_possessed);
			$arr_roles_available = $role_user->get_roles_available($request->user_id);
			$data = array('arr_roles_possessed' => $arr_roles_possessed,
					'arr_roles_available' => $arr_roles_available
			);
			return response()->json($data);
		}
	}	

}
