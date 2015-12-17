<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role_user;
use App\classes\RoleHelper;
use Auth;
use App\Models\Log;
use App\Models\LogEvent;

class LogController extends Controller
{
	var $obj_logged_in_user;
	var $arr_logged_in_user;
	var $bool_has_role;
	var $roleHelper;
	
	public function __construct(
			Role_user $role_user, RoleHelper $roleHelper)
	{
	
		$this->middleware('three_step:admin');
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
		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
		return view('log/dashboard')->with('data', $data);
	}
	
	
	
	public function get_add_log_event()
	{
		$data = array('arr_logged_in_user' => $this->arr_logged_in_user);
		return view('log/add_log_event')->with('data', $data);
	}
	
	
	public function post_add_log_event(
			Request $request, Log $log,
			LogEvent $log_event)
	{
		$validation_rules = $log->getValidationRules();
		$this->validate($request, $validation_rules);
	
		$arr_request = $log->getRequestArray($request);
		$log_event->name = $arr_request['name'];
		$log_event->client_id = Auth::id();
		$log_event->save();
		$log_event_id = $log_event->id;
		// return to raw password for view
	
		$data = $log->getDataArray(
				$arr_request, Auth::id(), $log_event_id, 
				$this->arr_logged_in_user);
		return view('log/add_log_event_results')->with('data', $data);
	}
	
	
	public function get_edit_log_event(LogEvent $log_event, 
			Log $log)
	{
		$arr_log_events = $log_event->get_all_events(Auth::id());  
//		$arr_events_processed = $log->process_log_events($arr_log_events_raw);
		$data = $admin->getDataArrayGetEdit(
				$arr_log_events,
				$this->arr_logged_in_user);
	
		return view('log/edit_log_event')->with('data', $data);
	}
	
	
	public function post_edit_log_event(Request $request,
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
	
}




