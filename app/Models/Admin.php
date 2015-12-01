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
    
    public function getRequestArray($request)
    {
    	return array(
    		'first_name' => $request->first_name,
    		'last_name' => $request->last_name,
    		'email'    => $request->email,
    		'password' => Hash::make($request->password)
    	);
    }
    
    
}
