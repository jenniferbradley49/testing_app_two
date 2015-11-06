<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use DB;
use Auth;

class Role_user extends Model
{
	
	protected $table = 'role_user';
	
	
	protected $fillable = ['role_id', 'user_id'];
	
    public function add_role($user_id, $role_id)
    {
//    	$user = new User;
    	$user = User::find($user_id);
    	$user->roles()->attach($role_id);
    }
    
    public function delete_role($user_id, $role_id)
    {
//    	$user = new User;
    	$user = User::find($user_id);
    	$user->roles()->detach($role_id);
    }
    
    public function hasRole($role_to_check)
    {
    	$user = Auth::user();
    	$arr_raw = $user->roles->toArray();
    	$arr_processed = array();
    	foreach ($arr_raw as $val )
    	{
    		$arr_processed[$val['id']] = $val['name'];
    	}
    	echo "in model role_user, arr_processed = ";
    	print_r ($arr_processed);
    	echo "<br>";
    	return in_array($role_to_check, $arr_processed);
	}
    
    
    public function get_roles_possessed($user_id)
    {
    	$user = User::find($user_id);     	 
    	$arr_roles_possessed = $user->roles->toArray();
    	   
    	return $arr_roles_possessed;
    }


    public function process_roles_possessed_output($arr_roles_possessed)
    {
    	if (empty($arr_roles_possessed))
    	{
    		$arr_roles_possessed[0]['id'] = 0;
    		$arr_roles_possessed[0]['name'] = "no roles currently possessed";
    	}
    
    	return $arr_roles_possessed;
    }

    public function process_roles_possessed_comparison($arr_roles_possessed)
    {
        $arr_roles_possessed_keys = array();
    	if (empty($arr_roles_possessed))
    	{
    		$arr_roles_possessed_keys[] = 0;
    	}
    	else 
    	{
    		foreach ($arr_roles_possessed as $key => $role_possessed)
    		{
    			$arr_roles_possessed_keys[] = $role_possessed['id'];
    		}
    	}
    	    
    	return $arr_roles_possessed_keys;
    }
    
    
    public function get_roles_available($user_id)
    {
    	$arr_roles_possessed = $this->get_roles_possessed($user_id);
    	$arr_roles_possessed_keys = $this->process_roles_possessed_comparison($arr_roles_possessed);
//       	$user = User::find($user_id);
     	 
//    	$arr_roles_possessed = $user->roles->toArray();
 /*   	 
    	$arr_roles_possessed_keys = array();
    	if (empty($arr_roles_possessed))
    	{
    		$arr_roles_possessed_keys[] = 0;
    	}
    	else 
    	{
    		foreach ($arr_roles_possessed as $key => $role_possessed)
    		{
    			$arr_roles_possessed_keys[] = $role_possessed['id'];
    		}
    	}
   */     	 
    	$arr_roles_available = DB::table('roles')
    			->whereNotIn('id', $arr_roles_possessed_keys)
    			->get();    	 
    	return $arr_roles_available;
    }    
}
