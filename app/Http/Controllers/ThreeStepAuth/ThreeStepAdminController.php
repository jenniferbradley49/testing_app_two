<?php

namespace App\Http\Controllers\ThreeStepAuth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThreeStepAdminController extends Controller
{
	var $obj_logged_in_user;
	var $arr_logged_in_user;
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(Role_user $role_user, RoleHelper $roleHelper)
	{

		$this->middleware('three_step:admin');
		$this->middleware('auth');
		if (Auth::check()) // must authorize before check for role
		{
			$this->middleware('role:admin');
			$this->obj_logged_in_user = Auth::user();
			$this->arr_logged_in_user = $roleHelper->prepare_logged_in_user_info($this->obj_logged_in_user);
		}  // end if Auth::check()
	} // end __construct function
		
	
    public function index()
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    	return view('three_step_admin/dashboard')->with('data', $data);
    }
	
    

    public function get_add_user()
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
       	return view('three_step_admin/add_user')->with('data', $data);
    }

 
}
