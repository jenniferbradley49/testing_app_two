<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Category;
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
    

    public function get_add_category()
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('test_preparer/add_category')->with('data', $data);
    	}
    }
    
    public function post_add_category(Request $request, Category $category)
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$validation_rules = [
    		'category' => 'required|max:50'
    				];
    		$this->validate($request, $validation_rules);
    
    		$arr_category_info = array(
    				'category'     => $request->category,
     		);
    
    		//    		$user = new User;
    		foreach ($arr_category_info as $key =>$val)
    		{
    			$category->$key = $val;
    		}
    
    		$category->save();
    		$category_id = $category->id;
    		 
    		$data = array('arr_category_info' => $arr_category_info,
    				'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    
    		return view('test_preparer/add_category_results')->with('data', $data);
    	}
    } 


    public function get_add_sub_category(Category $category)
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
    		return view('test_preparer/add_sub_category')->with('data', $data);
    	}
    }
    
    public function post_add_sub_category(Request $request, Category $category)
    {
    	if (!$this->bool_has_role)
    	{
    		return $this->roleHelper->call_redirect();
    	}
    	else
    	{
    		$validation_rules = [
   			'category_id' => 'required|integer|min:1',
    		'sub_category' => 'required|max:50'
    				];
    		$validation_messages = [
    			'category_id.min' => 'Please choose a category in the drop down box.  The current choice of &quot;Please choose a category&quot; is not acceptable.',
    			];
    	 
    		$this->validate($request, $validation_rules, $validation_messages);
    		    
    		$arr_category_info = array(
    				'category_id'     => $request->category_id,
    				'sub_category'     => $request->sub_category
    		);
    
    		//    		$user = new User;
    		foreach ($arr_category_info as $key =>$val)
    		{
    			$category->$key = $val;
    		}
    
    		$category->save();
    		$category_id = $category->id;
    		 
    		$data = array('arr_category_info' => $arr_category_info,
    				'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    
    		return view('test_preparer/add_category_results')->with('data', $data);
    	}
    }
    
}
