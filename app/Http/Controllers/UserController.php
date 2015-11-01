<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UserController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function get_add_user_admin()
    {
    	return view('admin/add_user_admin');
    }
	
    public function post_add_user_admin(Request $request)
    {
    	
    	$this->validate($request, [
    		'first_name' => 'required|max:50',
    		'last_name' => 'required|max:50',
    		'email' => 'required|email|max:50|unique:users',
    		'password' => 'required|confirmed|max:50|min:6'
    	   ]);
    	
    	$arr_user_info = array(
    	'first_name'     => $request->first_name,
    	'last_name' => $request->last_name,
    	'email'    => $request->email,
    	'password' => Hash::make($request->password)
    			);
    	
    	$user = new User;
    	foreach ($arr_user_info as $key =>$val)
    	{
    		$user->$key = $val;
    	}
    	
    	$user->save();
    	$user_id = $user->id;
    	// return to raw password for view
    	$arr_user_info['password'] = $request->password;
    	
    	$data = array('arr_user_info' => $arr_user_info, 
    					'user_id' => $user_id
    	);
    	
    	return view('admin/add_user_admin_results')->with('data', $data);
    	
    	
    }
}
