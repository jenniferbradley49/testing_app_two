<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	
    public function getValidationRules()
    {
    	return array(
    		'first_name' => 'required|max:50',
    		'last_name' => 'required|max:50',
    		'email' => 'required|email|max:50|unique:users',
    		'password' => 'required|confirmed|max:50|min:6'
    	);	 
    }

    public function getValidationRulesEditUser()
    {
    	return array(
    		'user_id' => 'required|integer|min:1',
    		'first_name' => 'required|max:50',
    		'last_name' => 'required|max:50'
    	);
    }
    

    public function getValidationRulesAddRole()
    {
    	return array(
		    'user_id' => 'required|integer|min:1',
		    'role_id' => 'required|integer|min:1',
       	);
    }
    
    
    public function getValidationMessagesEditUser()
    {
    	return array(
    		'user_id.min' => 'Please choose a user in the drop down box.  The current choice of &quot;Please choose a user&quot; is not acceptable.',
    	);
    }
    
    
    public function getRequestArray($request)
    {
    	return array(
    		'first_name' => $request->first_name,
    		'last_name' => $request->last_name,
    		'email'    => $request->email,
    		'password' => \Hash::make($request->password)
    	);
    }


    public function getRequestArrayAddRole($request)
    {
    	return array(
 		   	'user_id'	=> $request->user_id,
	    	'role_id' 	=> $request->role_id
       	);
    }
    
    
    public function getDataArray($arr_request, $user_id, $arr_logged_in_user)
    {
    	return array(
    		'arr_request' => $arr_request,
    		'user_id' => $user_id, 
    		'arr_logged_in_user' => $arr_logged_in_user
    	);
    } 
    
    
    public function getDataArrayGetEditUserAdmin($arr_request, $arr_users)
    {
    	return array(
    		'arr_users' => $arr_users_processed,
    		'arr_logged_in_user' => $this->arr_logged_in_user
       	);
    }
    
    
}
