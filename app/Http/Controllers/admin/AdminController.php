<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin;
use App\Role;
use App\Role_user;
use Hash;
use Redirect;
use DB;
use Auth;
use App\classes\RoleHelper;
use App\classes\Communication;
use App\classes\CommonCode;

class AdminController extends Controller
{
	var $obj_logged_in_user;
	var $arr_logged_in_user;
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(
			Role_user $role_user, RoleHelper $roleHelper)
	{

//		$this->middleware('three_step:admin');
		$this->middleware('three_step');
		$this->middleware('auth');
		if (Auth::check())
		{
			$this->middleware('role:admin');
			$this->obj_logged_in_user = Auth::user();
			$this->arr_logged_in_user = $roleHelper->prepare_logged_in_user_info($this->obj_logged_in_user);
		}  // end if Auth::check()
	} // end __construct function
		
	
    public function index(Communication $comm)
    {
 		$arr_info = array(0 => 'test message 2');
  		$comm->saveFile($arr_info);
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    	return view('admin/dashboard')->with('data', $data);
    }
	
    

    public function get_add_user()
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
       	return view('admin/add_user_admin')->with('data', $data);
    }

    
    public function post_add_user(
    		Request $request, Admin $admin, 
    		User $user, CommonCode $cCode)
    {
    	$validation_rules = $admin->getValidationRules();
    	$this->validate($request, $validation_rules);

    	$arr_request = $admin->getRequestArray($request);
    	$user = $cCode->getObject($arr_request, $user);			
    	$user->save();
    	$user_id = $user->id;
    	// return to raw password for view
    	$arr_request['password'] = $request->password;

    	$data = $admin->getDataArray(
    		$arr_request, $user_id, 
    		$this->arr_logged_in_user);   	 
    		return view('admin/add_user_results_admin')->with('data', $data); 	 
    }
    

    public function get_edit_user(User $user, Admin $admin)
    {
    	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
    	$arr_users_processed = $user->process_users($arr_users_raw);
    	$data = $admin->getDataArrayGetEditUserAdmin(
    		$arr_users_processed,
    		$this->arr_logged_in_user);
    		
    	return view('admin/edit_user_admin')->with('data', $data);
    }


    public function post_edit_user(Request $request, 
    		User $user, Admin $admin, CommonCode $cCode)
    {   	
    	$bool_include_password = $cCode->setCheckboxVar($request->include_password);
    	$bool_include_email = $cCode->setCheckboxVar($request->include_email);
    	 
    	$validation_rules = $admin->getValidationRulesEditUser();
    	$validation_messages = $admin->getValidationMessagesEditUser();    	 
    	$this->validate($request, $validation_rules, $validation_messages);

		if ($bool_include_email)
		{
			$validation_rules = [
       			'email' => 'required|email|max:50|unique:users',
    			];
    		$this->validate($request, $validation_rules);
		}

		if ($bool_include_password)
		{
			$validation_rules = [
    			'password' => 'required|confirmed|max:50|min:6'
			];
			$this->validate($request, $validation_rules);
		}

    	$obj_user = $user->find($request->user_id);
    	$obj_user->first_name = $request->first_name;
    	$obj_user->last_name = $request->last_name;
    	$arr_request = array();
    	$arr_request['first_name'] = $request->first_name;
    	$arr_request['last_name'] = $request->last_name;
    	if ($bool_include_email)
    	{
    		$obj_user->email = $request->email;
    		$arr_request['email'] = $request->email;
    	}
    	if ($bool_include_password)
    	{
    		$obj_user->password = $request->password;
    		$arr_request['password'] = $request->password;
    	}
    	 
    	$obj_user->save();
    	$user_id = $user->id;

    	$data = $admin->getDataArray(
    		$arr_request, $user_id,
    		$this->arr_logged_in_user);
    		    
    	return view('admin/edit_user_results_admin')->with('data', $data);
    }
    
    
    public function get_add_role(User $user, Admin $admin)
    {
	    $arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	    $arr_users_processed = $user->process_users($arr_users_raw);
    	$data = $admin->getDataArrayGetEditUserAdmin(
    		$arr_users_processed,
    		$this->arr_logged_in_user);
	    return view('admin/add_role_admin')->with('data', $data);	 
    } 

    public function post_add_role(
    		Request $request, User $user, Role $role, 
    		Role_user $role_user, Admin $admin)
    { 	 
    	$validation_rules = $admin->getValidationRulesAddRole();
    	$validation_messages = $admin->getValidationMessagesEditUser();    	     	 
	    $this->validate($request, $validation_rules, $validation_messages);

	    $arr_request = $admin->getRequestArrayAddRole($request);
	    	    	
 		// check for identical rows already in role_user
    	$arr_role_user = DB::table('role_user')
    		->where('user_id', '=', $arr_request['user_id'])
    		->where('role_id', '=', $arr_request['role_id'])
    		->get();
    	if(empty($arr_role_user))
    	{
    		$bool_role_user_exists = 0;
    		$role_user->add_role($arr_request['user_id'], $arr_request['role_id']);
    	}
    	else
    	{
    		$bool_role_user_exists = 1;
    	}
    		
    	//prepare text for output
    	$user = $user->find($arr_request['user_id']);
  		$arr_request['first_name'] = $user->first_name;
  		$arr_request['last_name'] = $user->last_name;
  		$role = $role->find($arr_request['role_id']);
  		$arr_request['role'] = $role->name;
    	 
    	$data = $admin->getDataArray(
    		$arr_request, 0,
    		$this->arr_logged_in_user);
    	
    	if ($bool_role_user_exists)
    	{
    		return view('admin/add_role_results_failure_admin')->with('data', $data); 	
    	}
    	else 
    	{
    		return view('admin/add_role_results_admin')->with('data', $data);
    	} 	
    }    

    public function get_delete_role(User $user, Admin $admin)
    {
 		$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	   	$arr_users_processed = $user->process_users($arr_users_raw);
    	$data = $admin->getDataArrayGetEditUserAdmin(
    		$arr_users_processed,
    		$this->arr_logged_in_user);
 		return view('admin/delete_role_admin')->with('data', $data);
    }
    
    public function post_delete_role(
    		Request $request, User $user, 
    		Role $role, Role_user $role_user, Admin $admin)
    {
    	$validation_rules = $admin->getValidationRulesAddRole();
    	$validation_messages = $admin->getValidationMessagesEditUser();
 		$this->validate($request, $validation_rules, $validation_messages);
    	    
	    $arr_request = $admin->getRequestArrayAddRole($request);
	    $role_user->delete_role($arr_request['user_id'], 
	    	$arr_request['role_id']);
    
	    //prepare text for output
	    $user = $user->find($arr_request['user_id']);
 		$arr_request['first_name'] = $user->first_name;
 		$arr_request['last_name'] = $user->last_name;
 		$role = $role->find($arr_request['role_id']);
 		$arr_request['role'] = $role->name;
    
    	$data = $admin->getDataArray(
    		$arr_request, 0,
    		$this->arr_logged_in_user);
   	 
 		return view('admin/delete_role_results_admin')->with('data', $data);    	
	}  
}



