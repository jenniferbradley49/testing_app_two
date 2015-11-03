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
	}
	
	
    public function get_user_info_admin(Request $request)
    {

    	$validation_rules = [
    	'user_id' => 'required|integer|min:1'
    	];
    	
    	$this->validate($request, $validation_rules);
    	 
    	$arr_user_info = User::where('id', $request->user_id)
    		->first();
        return response()->json($arr_user_info);
    }


    public function resort_users_admin(Request $request, User $user)
    {

    	$validation_rules = [
    	'bool_order_by_lname' => 'required|integer|min:0|max:1'
    	];
    	
    	$this->validate($request, $validation_rules);
    	 
    	$arr_users_processed = array(0 => array('id' => 0, 'content' => "please choose an option"));	
//		$user = new User;
    	$arr_users_raw = $user->get_all_users_admin($request->bool_order_by_lname);  // 1 specifies order by last name

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
    
    
	
    public function get_role_info_admin(Request $request, Role $role)
    {
    	$validation_rules = [
    	'user_id' => 'required|integer|min:1'
    	];
    	
    	$this->validate($request, $validation_rules);
    	 
    	$arr_all_roles = $role->all();
    	$arr_roles_possessed = $role_user->get_roles_possessed($request->user_id);
		$arr_roles_available = $role_user->get_roles_available($request->user_id);
		$data = array('arr_roles_possessed' => $arr_roles_possessed,
				'arr_roles_available' => $arr_roles_available	
			);
		return response()->json($data);
    }

    }
