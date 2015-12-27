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


    public function getConfigure(ThreeStepAdmin $threeStepAdmin)
    {
    	// turn of / off three step security
    	// number of minutes allowed without activity
    	// disable bypass of three step system - created to enable set up
    	// set/edit encryption seed
    	$arrConfigInfo = $threeStepAdmin->getConfigInfo('admin');
    	$data = $threeStepAdmin->getDataArrayConfig(
					$arrConfigInfo,
    				$threeStepAdmin->getConfigDropDownOptions(),
					$this->arr_logged_in_user);
    	return view('three_step_admin/configure')->with('data', $data);
    }
    
    
    public function get_change_password_hint(
    		ThreeStepUser $three_step_user,
    		ThreeStepAdmin $three_step_admin)
    {
        $three_step_user = $three_step_user
        	->where('role_id', 1)
        	->first();
        $data = $three_step_admin->getDataArrayChangePasswordHint(
					$three_step_user->hint,
					$this->arr_logged_in_user);
        return view('three_step_admin/change_password_hint')->with('data', $data);
    }
    
    
    public function getEditEmail(
    		ThreeStepUser $three_step_user,
    		ThreeStepAdmin $three_step_admin)
    {
        $three_step_user = $three_step_user
        	->where('role_id', 1)
        	->first();
        $data = $three_step_admin->getDataArrayEditEmail(
					$three_step_user->email,
					$this->arr_logged_in_user);
        return view('three_step_admin/edit_email')->with('data', $data);
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

    	$validation_rules = $three_step_admin->getValidationRulesChangePassword();
    	$this->validate($request, $validation_rules);
    	 
    	$arr_request = $three_step_admin->getRequestArrayChangePassword($request);
    	$three_step_user = $three_step_user
//    		->where('user_id', Auth::id())
    	->where('role_id', 1)
    		->first();
    	if (! $three_step_user == null)
    	{
	    	if (! Hash::check($arr_request['curr_password'], $three_step_user->password))
	    	{
	    		$data = $three_step_admin->getDataArrayChangePassword(
 		   			'The current password does not match our records',
    				$this->arr_logged_in_user);
    			return view('three_step_admin/change_password')
    				->with('data', $data);
    		}
    		else 
    		{
    			$three_step_user->password = Hash::make($arr_request['password']);
    			$three_step_user->save();
    			$data = $three_step_admin->getDataArrayChangePassword(
    				null,
    				$this->arr_logged_in_user);
    			return view('three_step_admin/change_password_results')->with('data', $data);
    		} // end else, if ! Hash::check
    	}
    	else // if no three step user
    	{
	    	$data = $three_step_admin->getDataArrayChangePassword(
 		   		'No three step user found.',
    			$this->arr_logged_in_user);
    		return view('three_step_admin/change_password')
    			->with('data', $data);
    	}
    }
    

    public function post_change_password_hint(Request $request,
    		ThreeStepUser $three_step_user, ThreeStepAdmin $three_step_admin)
    {
    
    	$validation_rules = $three_step_admin->getValidationRulesChangePasswordHint();
    	$this->validate($request, $validation_rules);
    
    	$arr_request = $three_step_admin->getRequestArrayChangePasswordHint($request);
    	$three_step_user = $three_step_user
  //  	->where('user_id', Auth::id())
    	->where('role_id', 1)
    	->first();
    	if (! $three_step_user == null)
    	{
    		$three_step_user->hint = $arr_request['new_hint'];
    		$three_step_user->save();
    		$data = $three_step_admin->getDataArrayChangePassword(
    			null,
    			$this->arr_logged_in_user);
    		return view('three_step_admin/change_password_hint_results')->with('data', $data);
    	}
    	else // if no three step user
    	{
    		$data = $three_step_admin->getDataArrayChangePassword(
    				'No three step user found.',
    				$this->arr_logged_in_user);
    		return view('three_step_admin/change_password_hint')
    		->with('data', $data);
    	}
    }
    

    public function postEditEmail(Request $request,
    		ThreeStepUser $three_step_user, ThreeStepAdmin $three_step_admin)
    {
    
    	$validation_rules = $three_step_admin->getValidationRulesEditEmail();
    	$this->validate($request, $validation_rules);
    
    	$arr_request = $three_step_admin->getRequestArrayEditEmail($request);
    	$three_step_user = $three_step_user
    	//  	->where('user_id', Auth::id())
    	->where('role_id', 1)
    	->first();
    	if (! $three_step_user == null)
    	{
    		$three_step_user->email = $arr_request['email'];
    		$three_step_user->save();
    		$data = $three_step_admin->getDataArrayEditEmail(
    				$arr_request['email'],
    				$this->arr_logged_in_user);
    		return view('three_step_admin/edit_email_results')->with('data', $data);
    	}
    	else // if no three step user
    	{
    		$data = $three_step_admin->getDataArrayNoTSUser(
    				$this->arr_logged_in_user);
    		return view('three_step_admin/no_ts_user')
    			->with('data', $data);
    	}
    }
    
    
    
    

    public function postConfigure(Request $request,
    		ThreeStepUser $three_step_user, ThreeStepAdmin $threeStepAdmin)
    {
//    	echo "<pre>";
 //   	print_r($request);
//    	echo "</pre>";
    	 
    	$validationRules = $threeStepAdmin->getValidationRulesConfigure();
    	$this->validate($request, $validationRules);
    
    	$arrRequest = $threeStepAdmin->getRequestArrayConfigure($request);
    	$threeStepAdmin = $threeStepAdmin
    		->where('ts_user', 'admin')
    		->first();
    	if (! $threeStepAdmin == null)
    	{
    		$threeStepAdmin->ts_implement = $arrRequest['ts_implement'];
    		$threeStepAdmin->ts_bypass = $arrRequest['ts_bypass'];
    		$threeStepAdmin->ts_test = $arrRequest['ts_test'];
    		$threeStepAdmin->permit_delay = $arrRequest['permit_delay'];
    		$threeStepAdmin->save();
    		$data = $threeStepAdmin->getDataArrayChangePassword(
    				null,
    				$this->arr_logged_in_user);
    		return view('three_step_admin/configure_results')->with('data', $data);
    	}
    	else // if no three step user
    	{
    		$data = $three_step_admin->getDataArrayChangePassword(
    				'No three step user found.',
    				$this->arr_logged_in_user);
    		return view('three_step_admin/change_password_hint')
    		->with('data', $data);
    	}
    }
    
    
}



