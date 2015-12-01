<?php

namespace App\Http\Controllers\tests;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Role_user;
use Redirect;
use Auth;
use App\classes\RoleHelper;
use App\Models\Category;

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
	
    public function get_add_test(Category $category)
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$arr_categories_raw = $category->all()->toArray();
    		$arr_categories_processed = $category->process_categories($arr_categories_raw);
    		$data = array(
    			'arr_logged_in_user' => $this->arr_logged_in_user,
    			'arr_categories_processed' => $arr_categories_processed    				
    		);
    		return view('tests/add_test')->with('data', $data);
    	}
    }

    public function post_add_test(Test $test)
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$validation_rules = [
    			'category' => 'required|max:50',
    			'sub_category' => 'required|max:50'
    			]; 
    		$this->validate($request, $validation_rules);
    	 
    		$arr_test_info = array(
    			'category'     => $request->category,
    			'sub_category' => $request->sub_category
    		);
    	 
//    		$user = new User;
    		foreach ($arr_test_info as $key =>$val)
    		{
    			$test->$key = $val;
    		}
    	 
    		$test->save();
    		$test_id = $test->id;
    		// return to raw password for view
//    		$arr_user_info['password'] = $request->password;
    	
    		$data = array('arr_test_info' => $arr_test_info,
    			'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    	 
    		return view('test/add_test_results')->with('data', $data); 	 
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
