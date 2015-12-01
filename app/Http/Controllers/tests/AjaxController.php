<?php

namespace App\Http\Controllers\tests;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Role_user;
//use Redirect;
//use DB;
use Auth;
use App\classes\RoleHelper;
use App\Models\Category;

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
	

	public function get_sub_categories(Request $request, Role $role, Role_user $role_user, Category $category)
	{
		if (!$this->bool_has_role)
		{
			return $this->roleHelper->call_redirect();
		}
		else
		{
			$validation_rules = [
				'category_id' => 'required|integer|min:1'
			];
			 
			$this->validate($request, $validation_rules);
	
			$arr_sub_categories = $category->get_sub_categories($category_id);
//			$arr_roles_possessed = $role_user->get_roles_possessed($request->user_id);
//			$arr_roles_possessed = $role_user->process_roles_possessed_output($arr_roles_possessed);
//			$arr_roles_available = $role_user->get_roles_available($request->user_id);
//			$data = array('arr_roles_possessed' => $arr_roles_possessed,
//					'arr_roles_available' => $arr_roles_available
//			);
//		return response()->json($data);
		}
	}	

}
