<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
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
		$this->middleware('auth');
		$this->roleHelper = $roleHelper;
		$this->bool_has_role = $role_user->hasRole('admin');
		if ($this->bool_has_role)
		{
			$this->obj_logged_in_user = Auth::user();
			$this->arr_logged_in_user = $roleHelper->prepare_logged_in_user_info($this->obj_logged_in_user);
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
    		return view('admin/dashboard')->with('data', $data);
    	}
    }
	
    

    public function get_add_user_admin()
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
    		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    		return view('admin/add_user_admin')->with('data', $data);
    	}
    }
    
    public function post_add_user_admin(Request $request)
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
    		$validation_rules = [
    			'first_name' => 'required|max:50',
    			'last_name' => 'required|max:50',
    			'email' => 'required|email|max:50|unique:users',
    			'password' => 'required|confirmed|max:50|min:6'
    			]; 
    		$this->validate($request, $validation_rules);
    	 
    		$arr_user_info = array(
    			'first_name'     => $request->first_name,
    			'last_name' => $request->last_name,
    			'email'    => $request->email,
    			'password' => Hash::make($request->password)
    		);
    	 
    		$user = new User;
    		foreach ($arr_user_info as $key =>$val)
    		{
    			$user->$key = $val;
    		}
    	 
    		$user->save();
    		$user_id = $user->id;
    		// return to raw password for view
    		$arr_user_info['password'] = $request->password;
    	
    		$data = array('arr_user_info' => $arr_user_info,
    			'user_id' => $user_id, 'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    	 
    		return view('admin/add_user_results_admin')->with('data', $data); 	 
    	}
    }
    

    public function get_edit_user_admin()
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
    		$user = new User;
    		$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
    		$arr_users_processed = $user->process_users($arr_users_raw);
    		$data = array(
    			'arr_users' => $arr_users_processed,
    			'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    		return view('admin/edit_user_admin')->with('data', $data);
    	}
    }


    public function post_edit_user_admin(Request $request, User $user)
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
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
    	
    		$validation_rules = [
    			'user_id' => 'required|integer|min:1',
    			'first_name' => 'required|max:50',
    			'last_name' => 'required|max:50',
    			];
    		$validation_messages = [
    			'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
    			];
    	 
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

    		$user = User::find($request->user_id);
    		$user->first_name = $request->first_name;
    		$user->last_name = $request->last_name;
    		$arr_user_info = array();
    		$arr_user_info['first_name'] = $request->first_name;
    		$arr_user_info['last_name'] = $request->last_name;
    		if ($bool_include_email)
    		{
    			$user->email = $request->email;
    			$arr_user_info['email'] = $request->email;
    		}
    		if ($bool_include_password)
    		{
    			$user->password = $request->password;
    			$arr_user_info['password'] = $request->password;
    		}
    	 
    		$user->save();
    		$user_id = $user->id;
    
    		$data = array('arr_user_info' => $arr_user_info,
    			'user_id' => $request->user_id,
    			'arr_logged_in_user' => $this->arr_logged_in_user
    		);
    
    		return view('admin/edit_user_results_admin')->with('data', $data);
	    }
    }
    
    
    public function get_add_role_admin()
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
	    	$user = new User;
	    	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	    	$arr_users_processed = $user->process_users($arr_users_raw);
 		   	$data = array(
    			'arr_users' => $arr_users_processed,
    			'arr_logged_in_user' => $this->arr_logged_in_user
 	   	);
	    	return view('admin/add_role_admin')->with('data', $data);	 
	    }
    } 

    public function post_add_role_admin(Request $request, User $user, Role $role, Role_user $role_user)
    { 	 
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
	    	$validation_rules = [
		    	'user_id' => 'required|integer|min:1',
		    	'role_id' => 'required|integer|min:1',
 		   	];
    
 		   	$validation_messages = [
		    	'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
	    	];
    	 
	    	$this->validate($request, $validation_rules, $validation_messages);
    	
	    	$arr_user_role_info = array(
 		   		'user_id'	=> $request->user_id,
	    		'role_id' 	=> $request->role_id
	    	);
    	
 		   	// check for identical rows already in role_user
    		$arr_role_user = DB::table('role_user')
    					->where('user_id', '=', $arr_user_role_info['user_id'])
    					->where('role_id', '=', $arr_user_role_info['role_id'])
    					->get();
    		if(empty($arr_role_user))
    		{
    			$bool_role_user_exists = 0;
    			$role_user->add_role($arr_user_role_info['user_id'], $arr_user_role_info['role_id']);
    		}
    		else
    		{
    			$bool_role_user_exists = 1;
    		}
    		
    		//prepare text for output
    		$user = User::find($arr_user_role_info['user_id']);
  		  	$arr_user_role_info['first_name'] = $user->first_name;
  		  	$arr_user_role_info['last_name'] = $user->last_name;
  		  	$role = Role::find($arr_user_role_info['role_id']);
  		  	$arr_user_role_info['role'] = $role->name;
    	 
  		  	$data = array(
    			'arr_user_role_info' => $arr_user_role_info,
    			'arr_logged_in_user' => $this->arr_logged_in_user
   		 	);
    	
    		if ($bool_role_user_exists)
    		{
    			return view('admin/add_role_results_failure_admin')->with('data', $data); 	
    		}
    		else 
    		{
    			return view('admin/add_role_results_admin')->with('data', $data);
    		} 	
	    } 
    }    

    public function get_delete_role_admin()
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
 		   	$user = new User;
 		   	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
	    	$arr_users_processed = $user->process_users($arr_users_raw);
	    	$data = array(
    			'arr_users' => $arr_users_processed,
    			'arr_logged_in_user' => $this->arr_logged_in_user
 		   	);
 		   	return view('admin/delete_role_admin')->with('data', $data);
	    }
    }
    
    public function post_delete_role_admin(Request $request, User $user, Role $role, Role_user $role_user)
    {
    	if (!$this->bool_has_role)
    	{
    		 return $this->roleHelper->call_redirect();
    	}
    	else 
    	{
  		  	$validation_rules = [
  			  	'user_id' => 'required|integer|min:1',
   			 	'role_id' => 'required|integer|min:1',
   		 	];
    
   		 	$validation_messages = [
   			 	'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
   		 	];
    	 
 		   	$this->validate($request, $validation_rules, $validation_messages);
    	    
 		   	$arr_user_role_info = array(
    			'user_id'	=> $request->user_id,
    			'role_id' 	=> $request->role_id
	    	);
    		
	    	$role_user->delete_role($arr_user_role_info['user_id'], $arr_user_role_info['role_id']);
    
	    	//prepare text for output
	    	$user = User::find($arr_user_role_info['user_id']);
 		   	$arr_user_role_info['first_name'] = $user->first_name;
 		   	$arr_user_role_info['last_name'] = $user->last_name;
 		   	$role = Role::find($arr_user_role_info['role_id']);
 		   	$arr_user_role_info['role'] = $role->name;
    
 		   	$data = array(
    			'arr_user_role_info' => $arr_user_role_info,
    			'arr_logged_in_user' => $this->arr_logged_in_user
 		   	);
    	 
 		   	return view('admin/delete_role_results_admin')->with('data', $data);    	
		} 
	}  
}
