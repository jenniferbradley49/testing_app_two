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

    public function getDataArrayGetEdit($arr_log_events, $arr_logged_in_user)
    {
    	return array(
 //   			'arr_request' => $arr_request,
    			'arr_log_events' => $arr_log_events,
    			'arr_logged_in_user' => $arr_logged_in_user
    	);
    	 
    }
    
    
    
   
}



