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
use App\Models\Admin;

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
		$arr_log_events = $log_event->get_events(Auth::id());  
//		$arr_events_processed = $log->process_log_events($arr_log_events_raw);
		$data = $log->getDataArrayGetEdit(
				$arr_log_events,
				$this->arr_logged_in_user);
	
		return view('log/edit_log_event')->with('data', $data);
	}
	
	
	public function post_edit_log_event(Request $request,
			Log $log, LogEvent $log_event, Admin $admin)
	{	
		$validation_rules = $log->getValidationRules();
		$validation_messages = $admin->getValidationMessagesEditUser();
		$this->validate($request, $validation_rules, $validation_messages);
	
		$log_event = $log_event->find($request->log_event_id);
		$log_event->name = $request->name;
		$arr_request = array();
		$arr_request['name'] = $request->name;
	
		$log_event->save();
		$log_event_id = $log_event->id;
	
		$data = $log->getDataArray(
				$arr_request, Auth::id(), $log_event_id, 
				$this->arr_logged_in_user);
	
		return view('log/edit_log_event_results')->with('data', $data);
	}
	
}




