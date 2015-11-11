<?php

namespace App\Http\Controllers\tests;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
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
	
    public function get_add_test()
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('tests/add_test')->with('data', $data);
    	}
    }

    public function post_add_test()
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('tests/add_test')->with('data', $data);
    	}
    }
    
    
    public function get_edit_test()
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('tests/edit_test')->with('data', $data);
    	}
    }

    public function post_edit_test()
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('tests/edit_test')->with('data', $data);
    	}
    }    
}
