<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEvent extends Model
{
	protected $table = 'log_events';
    public function get_events($client_id)
    {
    	$obj_log_events =  $this
    		->where('client_id', $client_id)
    		->orderBy('name')
    		->get();
    	$arr_log_events = array();
    	foreach ($obj_log_events as $key =>$row)
    	{
    		$arr_log_events[$key]['id'] = $row->id;
    		$arr_log_events[$key]['name'] = $row->name;
    	}
    	return $arr_log_events;
    }
    
 }
 
 
 
 
