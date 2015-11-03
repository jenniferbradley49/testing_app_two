<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;

class Role_user extends Model
{
	
	protected $table = 'role_user';
	
	
	protected $fillable = ['role_id', 'user_id'];
	
    public function add_role($user_id, $role_id, User $user)
    {
//    	$user = new User;
    	$user = User::find($user_id);
    	$user->roles()->attach($role_id);
    }
    
    public function remove_role($user_id, $role_id, User $user)
    {
//    	$user = new User;
    	$user = User::find($user_id);
    	$user->roles()->detach($role_id);
    }
    
    public function get_roles_possessed($user_id, User $user)
    {
    	$user = User::find($user_id);
    	return $user->roles()->toArray();
 //   	return $this->where('user_id', $user_id)->get();
    }

    public function get_roles_available($user_id, Role $role)
    {
    	$arr_all_roles = $role->all()-toArray();
    	$arr_roles_possessed = $this->get_roles_possessed();
		// array_diff_key finds the roles not already possessed
    	return array_diff_key($arr_all_roles, $arr_roles_possessed);  	
    }
    
}
