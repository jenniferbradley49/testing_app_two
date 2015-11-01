<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function __construct()
	{
//		header('Access-Control-Allow-Origin: *');
//		header('Content-type: application/json; charset=utf-8');
	}
	
	
    public function get_user_info_admin(Request $request)
    {
    	$arr_user_info = User::where('id', $request->user_id)
    		->first();
 //   	$arr_user_info = User::where('id', 6)
//    		->first();
//    	print_r($arr_user_info);
    	//    	$arr_user_info = User::all();
    	//return "test 123";
        return response()->json($arr_user_info);
    }


    public function resort_users_admin(Request $request, User $user)
    {
    	$arr_users_processed = array(0 => array('id' => 0, 'content' => "please choose an option"));	
//		$user = new User;
    	$arr_users_raw = $user->get_all_users_admin($request->bool_order_by_lname);  // 1 specifies order by last name
/*
    	if ($request->bool_order_by_lname)
    	{
    		$arr_users_raw = User::orderBy('last_name', 'asc')->orderBy('last_name', 'asc')->get();
    	}
    	else	
    	{
    		$arr_users_raw = User::orderBy('email', 'asc')->orderBy('last_name', 'asc')->get();
    	}
*/
    $counter = 1;				 
   	foreach ($arr_users_raw as $user)
    	{
    		if ($request->bool_order_by_lname)
    		{
    			$str_info = $user['last_name']. ', ';
    			$str_info .= $user['first_name']. ' ';
    			$str_info .= $user['email'];
    		}
    		else 
    	    {
    	    	$str_info = $user['email'].' ';
    	    	$str_info .= $user['last_name']. ', ';
    			$str_info .= $user['first_name'];
    		}
    			$arr_users_processed[$counter]['content'] = $str_info;
    			$arr_users_processed[$counter]['id'] = $user['id'];
    			$counter ++;
    			 
    	}
    	return response()->json($arr_users_processed);
    }
    
    
}
