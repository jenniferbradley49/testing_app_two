<?php

namespace App\Http\Controllers\ThreeStepAuth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role_user;
use App\classes\RoleHelper;
use Auth;
use App\Models\ThreeStepLog;
use App\Models\ThreeStepAdmin;

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

    public function get_view_log()
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    	return view('three_step_admin/view_log')->with('data', $data);
    }
    
    
    
    public function get_add_user(ThreeStepLog $three_step_log)
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
       	return view('three_step_admin/add_user')->with('data', $data);
    }


    public function post_view_log(Request $request, 
    		ThreeStepLog $three_step_log, ThreeStepAdmin $three_step_admin)
    {
 //   	$validation_rules = $three_step_log->getValidationRulesViewLog();
 //   	$this->validate($request, $validation_rules);
    	
 //   	$arr_request = $three_step_log->getRequestArrayViewLog($request);
//    	$obj_three_step_log = $three_step_log->where();
    	$obj_three_step_log = $three_step_log->all();
//    echo "<pre>";
//    print_r($obj_three_step_log);
//    echo "</pre>";
//    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    	$data = $three_step_admin->getDataArrayViewLog(
    		$obj_three_step_log, 
    		$this->arr_logged_in_user);   	 
    	return view('three_step_admin/view_log_results')->with('data', $data);
    }
    
    
}



