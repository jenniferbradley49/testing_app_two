<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	
    public function getValidationRules()
    {
    	return array(
    		'name' => 'required|max:50',
    	);	 
    }

    public function getRequestArray($request)
    {
    	return array(
    			'name' => $request->name,
    	);
    }
    

    public function getDataArray($arr_request, $client_id, $log_event_id, $arr_logged_in_user)
    {
    	return array(
    			'arr_request' => $arr_request,
    			'client_id' => $client_id,
    			'log_event_id' => $log_event_id,
    			'arr_logged_in_user' => $arr_logged_in_user
    	);  	
    }

    public function getDataArrayGetEdit($arr_request, $arr_log_event_id, $arr_logged_in_user)
    {
    	return array(
    			'arr_request' => $arr_request,
    			'arr_log_events' => $arr_log_events,
    			'arr_logged_in_user' => $arr_logged_in_user
    	);
    	 
    }
    
    
    
    
    public function get_all_events($client_id)
    {
    	$obj_log_events =  $this
    		->where('client_id', $client_id)
    		->orderBy('name');
    	
    	$arr_log_events = array();
    	foreach ($obj_log_events as $key =>$row)
    	{
    		$arr_log_events[$key]['id'] = $row->id;
    		$arr_log_events[$key]['name'] = $row->name;
    	}
    	return $arr_log_events;
    }
    
    
}



