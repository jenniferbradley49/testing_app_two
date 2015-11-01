<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function __construct()
	{
		$this->middleware('auth');
//		header('Access-Control-Allow-Origin: *');
//		header('Content-type: application/json; charset=utf-8');
		
	}
	
	
    public function index()
    {
    	return view('admin/dashboard');
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
    	 
    	return view('admin/add_user_results_admin')->with('data', $data); 	 
    }
    

    public function get_edit_user_admin()
    {
		$user = new User;
    	$arr_users_raw = $user->get_all_users_admin(1);  // 1 specifies order by last name
    	$arr_users_processed = $user->process_users($arr_users_raw);
    	$data = array('arr_users' => $arr_users_processed);
    	return view('admin/edit_user_admin')->with('data', $data);
    }


    public function post_edit_user_admin(Request $request, User $user)
    {
    	if ((isset($request->include_password) && ($request->include_password == 'on')))
    	{
    		$bool_include_password = 1;
    	}
    	else
        {
    		$bool_include_password = 0;
    	}

        if ((isset($request->include_email) && ($request->include_email == 'on')))
    	{
    		$bool_include_email = 1;
    	}
    	else
        {
    		$bool_include_email = 0;
    	}
    	//    	echo "test 2<br>";
//    	print_r($request->all());
    	 
    
    	$this->validate($request, [
    			'user_id' => 'required|integer|min:0',
    			'first_name' => 'required|max:50',
    			'last_name' => 'required|max:50',
//    			'email' => 'required|email|max:50|unique:users',
//    			'include_password' => 'required|integer|min:0|max:1',
    			//    			'password' => 'required|confirmed|max:50|min:6'
    			]);

		if ($bool_include_email)
		{
    		$this->validate($request, [
       			'email' => 'required|email|max:50|unique:users',
    			]);
		}

		if ($bool_include_password)
		{
			$this->validate($request, [
//	   			'include_password' => 'required|integer|min:0|max:1',
    			'password' => 'required|confirmed|max:50|min:6'
			]);
		}
		
		
    	$arr_user_info = array(
 //   			'id'     => $request->user_id,
    			'first_name'     => $request->first_name,
    			'last_name' => $request->last_name,
//    			'email'    => $request->email,
//    			'password' => \Hash::make($request->password)
    	);
    
//    	$user = new User;
 //   	foreach ($arr_user_info as $key =>$val)
//    	{
 //   		$user->$key = $val;
 //   	}
 
    	$user = User::find($request->user_id);
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	if ($bool_include_email)
    	{
    		$user->email = $request->email;
    	}
    	if ($bool_include_password)
    	{
    		$user->password = $request->password;
    	}
    	 
    	$user->save();
    	$user_id = $user->id;
    	// return to raw password for view
//    	$arr_user_info['password'] = $request->password;
    
    	$data = array('arr_user_info' => $arr_user_info,
    			'user_id' => $request->user_id
    	);
    
    	return view('admin/edit_user_results_admin')->with('data', $data);
    }
    
    
    public function get_add_role_admin()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
