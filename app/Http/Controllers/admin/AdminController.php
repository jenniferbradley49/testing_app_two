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

class AdminController extends Controller
{
	var $obj_logged_in_user;
	var $arr_logged_in_user;
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(Role_user $role_user, RoleHelper $roleHelper)
	{
		$this->middleware('three_step:admin');
		$this->middleware('auth');
		if (Auth::check())
		{
//			$role_mware_params = array(
//				'role_user' => $role_user,				
//				'role' => 'admin',				
//				'roleHelper' => $roleHelper				
//			);
			$this->middleware('role:admin');
	//				 $role_mware_params);
//			$this->roleHelper = $roleHelper;
//			$this->bool_has_role = $role_user->hasRole('admin');
//			if ($this->bool_has_role)
//			{
				$this->obj_logged_in_user = Auth::user();
				$this->arr_logged_in_user = $roleHelper->prepare_logged_in_user_info($this->obj_logged_in_user);
//			}
//			else 
//			{
//				return $this->roleHelper->call_redirect();
//			}
		}  // end if Auth::check()
	} // end __construct function
		
	
    public function index()
    {
 //   	if (!$this->bool_has_role)
  //  	{
  //  		 return $this->roleHelper->call_redirect();
   // 	}
 //  	else 
  //  	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('admin/dashboard')->with('data', $data);
 //   	}
    }
	
    

    public function get_add_user()
    {
 //   	if (!$this->bool_has_role)
 //   	{
 //   		 return $this->roleHelper->call_redirect();
  //  	}
 //   	else 
 //   	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('admin/add_user_admin')->with('data', $data);
 //   	}
    }
    
    public function post_add_user(
    		Request $request, Admin $admin, 
    		User $user, CommonCode $cCode)
    {
//    	if (!$this->bool_has_role)
//    	{
//    		 return $this->roleHelper->call_redirect();
//    	}
 //   	else 
 //   	{
//    		$validation_rules = [
//   			'first_name' => 'required|max:50',
 //   			'last_name' => 'required|max:50',
 //   			'email' => 'required|email|max:50|unique:users',
 //   			'password' => 'required|confirmed|max:50|min:6'
 //   			]; 
    		$validation_rules = $admin->getValidationRules();
    		$this->validate($request, $validation_rules);
/*    	 
    		$arr_user_info = array(
    			'first_name'     => $request->first_name,
    			'last_name' => $request->last_name,
    			'email'    => $request->email,
    			'password' => Hash::make($request->password)
    		);
 */
    		$arr_request = $admin->getRequestArray($request);
    		
//    		$user = new User;
			$user = getObject($arr_request, $user);			
 //   		foreach ($arr_request as $key =>$val)
//    		{
//    			$user->$key = $val;
//   		}
    	 
    		$user->save();
    		$user_id = $user->id;
    		// return to raw password for view
    		$arr_request['password'] = $request->password;

    		$data = $admin->getDataArray(
    				$arr_request, $user_id, 
    				$this->arr_logged_in_user);
//    		$data = array(
//    			'arr_request' => $arr_request,
//    			'user_id' => $user_id, 'arr_logged_in_user' => $this->arr_logged_in_user
//    		);
    	 
    		return view('admin/add_user_results_admin')->with('data', $data); 	 
//    	}
    }
    

    public function get_edit_user(User $user)
    {
 //   	if (!$this->bool_has_role)
//    	{
//    		 return $this->roleHelper->call_redirect();
//    	}
 //   	else 
 //   	{
 //   		$user = new User;
    		$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
    		$arr_users_processed = $user->process_users($arr_users_raw);
    		$data = $admin->getDataArrayGetEditUserAdmin(
    				$arr_users_processed,
    				$this->arr_logged_in_user);
    		
//    		$data = array(
 //   			'arr_users' => $arr_users_processed,
//   			'arr_logged_in_user' => $this->arr_logged_in_user
 //   		);
    		return view('admin/edit_user_admin')->with('data', $data);
//    	}
    }


    public function post_edit_user(Request $request, 
    		User $user, Admin $admin)
    {
//    	if (!$this->bool_has_role)
//    	{
//    		 return $this->roleHelper->call_redirect();
//    	}
//   	else 
 //   	{
    		if ((isset($request->include_password) && ($request->include_password == 'on')))
    		{
    			$bool_include_password = 1;
    		}
    		else
        	{
    			$bool_include_password = 0;
    		}

        	if ((isset($request->include_email) && ($request->include_email == 'on')))
    		{
    			$bool_include_email = 1;
    		}
    		else
        	{
    			$bool_include_email = 0;
    		}

    		$validation_rules = $admin->getValidationRulesEditUser();
//    		$validation_rules = [
//    			'user_id' => 'required|integer|min:1',
//    			'first_name' => 'required|max:50',
//    			'last_name' => 'required|max:50',
 //   			];
    		$validation_messages = $admin->getValidationMessagesEditUser();
    		
//    		$validation_messages = [
//    			'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
//    		];
    	 
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
    		
//    		$data = array(
 //   			'arr_request' => $arr_request,
 //   			'user_id' => $request->user_id,
 //   			'arr_logged_in_user' => $this->arr_logged_in_user
 //   		);
    
    		return view('admin/edit_user_results_admin')->with('data', $data);
//	    }
    }
    
    
    public function get_add_role(User $user)
    {
//    	if (!$this->bool_has_role)
//    	{
//    		 return $this->roleHelper->call_redirect();
//   	}
//    	else 
//    	{
//	    	$user = new User;
	    	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	    	$arr_users_processed = $user->process_users($arr_users_raw);
    		$data = $admin->getDataArrayGetEditUserAdmin(
    				$arr_users_processed,
    				$this->arr_logged_in_user);
//	    	$data = array(
 //   			'arr_users' => $arr_users_processed,
 //   			'arr_logged_in_user' => $this->arr_logged_in_user
 //	   	);
	    	return view('admin/add_role_admin')->with('data', $data);	 
//	    }
    } 

    public function post_add_role(Request $request, User $user, Role $role, Role_user $role_user)
    { 	 
 //   	if (!$this->bool_has_role)
 //   	{
 //   		 return $this->roleHelper->call_redirect();
 //   	}
  //  	else 
 //   	{
    	$validation_rules = $admin->getValidationRulesAddRole();
    	 
 //   	$validation_rules = [
//		    	'user_id' => 'required|integer|min:1',
//		    	'role_id' => 'required|integer|min:1',
// 		   	];

    		$validation_messages = $admin->getValidationMessagesEditUser();
    	 
// 		   	$validation_messages = [
	//	    	'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
	//    	];
    	 
	    	$this->validate($request, $validation_rules, $validation_messages);

	    	$arr_request = $admin->getRequestArrayAddRole($request);
	    	
//	    	$arr_user_role_info = array(
 //		   		'user_id'	=> $request->user_id,
//	    		'role_id' 	=> $request->role_id
//	    	);
    	
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
    	 
  		  	/**
  		  	 *
  		  	 */
    		$data = $admin->getDataArray(
    				$arr_request, 0,
    				$this->arr_logged_in_user);
//  		  	$data = array(
 //   			'arr_request' => $arr_request,
 //   			'arr_logged_in_user' => $this->arr_logged_in_user
 //  		 	);
    	
    		if ($bool_role_user_exists)
    		{
    			return view('admin/add_role_results_failure_admin')->with('data', $data); 	
    		}
    		else 
    		{
    			return view('admin/add_role_results_admin')->with('data', $data);
    		} 	
//	    } 
    }    

    public function get_delete_role_admin()
    {
//    	if (!$this->bool_has_role)
//    	{
//    		 return $this->roleHelper->call_redirect();
//    	}
//    	else 
//    	{
 		   	$user = new User;
 		   	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	    	$arr_users_processed = $user->process_users($arr_users_raw);
    		$data = $admin->getDataArrayGetEditUserAdmin(
    				$arr_users_processed,
    				$this->arr_logged_in_user);
//	    	$data = array(
//    			'arr_users' => $arr_users_processed,
//    			'arr_logged_in_user' => $this->arr_logged_in_user
// 		   	);
 		   	return view('admin/delete_role_admin')->with('data', $data);
//	    }
    }
    
    public function post_delete_role_admin(Request $request, User $user, Role $role, Role_user $role_user)
    {
 //   	if (!$this->bool_has_role)
 //   	{
 //   		 return $this->roleHelper->call_redirect();
 //   	}
 //   	else 
 //  	{
    	$validation_rules = $admin->getValidationRulesAddRole();
//    	$validation_rules = [
//  			  	'user_id' => 'required|integer|min:1',
//   			 	'role_id' => 'required|integer|min:1',
//   		 	];
    
    		$validation_messages = $admin->getValidationMessagesEditUser();
 //   	$validation_messages = [
 //  			 	'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
//   		 	];
    	 
 		   	$this->validate($request, $validation_rules, $validation_messages);
    	    
	    	$arr_request = $admin->getRequestArrayAddRole($request);
 //		   	$arr_user_role_info = array(
  //  			'user_id'	=> $request->user_id,
 //   			'role_id' 	=> $request->role_id
//	    	);
    		
	    	$role_user->delete_role($arr_request['user_id'], $arr_user_role_info['role_id']);
    
	    	//prepare text for output
	    	/**
	    	 *
	    	 */
	    	$user = $user->find($arr_request['user_id']);
 		   	$arr_request['first_name'] = $user->first_name;
 		   	$arr_request['last_name'] = $user->last_name;
 		   	$role = $role->find($arr_request['role_id']);
 		   	$arr_request['role'] = $role->name;
    
    		$data = $admin->getDataArray(
    				$arr_request, 0,
    				$this->arr_logged_in_user);
 //		   	$data = array(
//    			'arr_user_role_info' => $arr_user_role_info,
//    			'arr_logged_in_user' => $this->arr_logged_in_user
// 		   	);
    	 
 		   	return view('admin/delete_role_results_admin')->with('data', $data);    	
//		} 
	}  
}



