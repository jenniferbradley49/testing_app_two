<?php

namespace App\Http\Controllers\ThreeStepAuth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role_user;
use App\classes\RoleHelper;
use Auth;
use Hash;
use Session;
use App\Models\ThreeStepLog;
use App\Models\ThreeStepAdmin;
use App\Models\ThreeStepUser;

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
    
    
    
    public function get_change_password()
    {
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
       	return view('three_step_admin/change_password')->with('data', $data);
    }


    public function get_configure()
    {
    	// turn of / off three step security
    	// number of minutes allowed without activity
    	// disable dummy user - created to enable set up
    	$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
    	return view('three_step_admin/change_password')->with('data', $data);
    }
    
    
    public function get_change_password_hint(
    		ThreeStepUser $three_step_user,
    		ThreeStepAdmin $three_step_admin)
    {
    	$role_id = Session::get('role_id');
        $three_step_user = $three_step_user
        	->where('role_id', $role_id)
        	->first();
		$data = $three_step_admin->getDataArrayChangePasswordHint(
					$three_step_user->hint,
					$this->arr_logged_in_user);
        return view('three_step_admin/change_password_hint')->with('data', $data);
    }
    
    
    public function post_view_log(Request $request, 
    		ThreeStepLog $three_step_log, ThreeStepAdmin $three_step_admin)
    {
 //   	$validation_rules = $three_step_log->getValidationRulesViewLog();
 //   	$this->validate($request, $validation_rules);
    	
 //   	$arr_request = $three_step_log->getRequestArrayViewLog($request);
//    	$obj_three_step_log = $three_step_log->where();
    	$obj_three_step_log = $three_step_log->all();
    	$data = $three_step_admin->getDataArrayViewLog(
    		$obj_three_step_log, 
    		$this->arr_logged_in_user);   	 
    	return view('three_step_admin/view_log_results')->with('data', $data);
    }
    

    public function post_change_password(Request $request,
    		ThreeStepUser $three_step_user, ThreeStepAdmin $three_step_admin)
    {

    	echo "1"; 
    	$validation_rules = $three_step_admin->getValidationRulesChangePassword();
    	$this->validate($request, $validation_rules);
    	echo "2";
    	 
    	$arr_request = $three_step_admin->getRequestArrayChangePassword($request);
    	$three_step_user = $three_step_user->find(Auth::id());
    	if (! Hash::check($three_step_user->password, $arr_request['curr_password']))
    	{
    		echo "4";
    		$data = $three_step_admin->getDataArrayChangePassword(
    			'The current password does not match our records',
    			$this->arr_logged_in_user);
    		return view('three_step_admin/change_password')
    		->with('data', $data);
    	}
//    	$obj_three_step_log = $three_step_log->all();
    	echo "3"; 
    	$data = $three_step_admin->getDataArrayChangePassword(
    			null,
    			$this->arr_logged_in_user);
    	return view('three_step_admin/change_password_results')->with('data', $data);

    }
    
      
}



