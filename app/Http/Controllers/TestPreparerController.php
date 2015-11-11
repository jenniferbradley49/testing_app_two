<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Role_user;
use Redirect;
use Auth;
use App\classes\RoleHelper;

class TestPreparerController extends Controller
{
	var $obj_logged_in_user;
	var $arr_logged_in_user;
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(Role_user $role_user, RoleHelper $roleHelper)
	{
		$this->middleware('auth');
		if(Auth::check())
		{
		$this->bool_has_role = $role_user->hasRole('test preparer');
		$this->roleHelper = $roleHelper;
		if ($this->bool_has_role)
		{	
			$this->obj_logged_in_user = Auth::user();
    		$this->arr_logged_in_user = $roleHelper->prepare_logged_in_user_info($this->obj_logged_in_user);
		}
		}
	} // end __construct function
	
	
    public function index()
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);    	 
    		return view('test_preparer/dashboard')->with('data', $data);
    	}
    }
    

}
