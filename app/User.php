<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    // builds Eloquent relationship to associate roles with users
    public function roles()
    {
   		return $this->belongsToMany('App\Role');
    }
    
    public function get_all_users_admin($bool_order_by_lname)
    {
 //   	echo "<br>in model, bool_order_by_lname = ".$bool_order_by_lname;
    	if ($bool_order_by_lname)
    	{
  //  		echo "<br>in model, returned by last name<br>";
    		return $this->orderBy('last_name')->get();
    	}
    	else 
    	{
 //   		echo "<br>in model, returned by email<br>";
    		return $this->orderBy('email')->get();
    	}		
    } // end function get_all_users_admin
    
    
    public function process_users($arr_users_raw)
    {
    	$arr_users_processed = array(0 => "please choose an option");
    	 
    	foreach ($arr_users_raw as $user)
    	{
    		$str_info = $user['last_name']. ', ';
    		$str_info .= $user['first_name']. ' ';
    		$str_info .= $user['email'];
    		$arr_users_processed[$user['id']] = $str_info;
    	}
    	
    	return $arr_users_processed;
    	 
    }  // end function process_users
}
