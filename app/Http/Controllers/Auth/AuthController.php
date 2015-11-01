<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    //protected $redirectPath = '/dashboard';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
 //       echo "auth controller construct function reached";
 //       $this->show_info();
        
    }
    
//    public function managePostLogin(Request $request)
 //   {
    	
//    	$this->validate($request, [
 //   	    	'first_name' => 'required|max:50',
 //   	   		'last_name' => 'required|max:50',
//    			'email' => 'required|email|max:50',
//    			'password' => 'required|max:50|min:6'
//    			]);
//    	return 'login validation passed';
    	
//    	 echo "auth controller, line 51 reached <br>";
//    	$this->postLogin($request);
    	 
//    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
 //   protected function validator(array $data)
  //  {
  //      return Validator::make($data, [
  //          'first_name' => 'required|max:255',
  //          'last_name' => 'required|max:255',
  //      	'email' => 'required|email|max:255|unique:users',
  //          'password' => 'required|confirmed|min:6',
  //      ]);
  //  }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
 //   protected function create(array $data)
 //   {
 //       return User::create([
 //           'first_name' => $data['first_name'],
 //       	'last_name' => $data['last_name'],
 //           'email' => $data['email'],
  //          'password' => bcrypt($data['password']),
 //       ]);
 //   }
    /*
    public function getLogin()
    {
    	return view('auth/login');
    }
    
    public function postLogin(Request $request)
    {
    	//$validator = $this->validator($request);
    	
    	$this->validate($request, [
//    			'first_name' => 'required|max:50',
//    			'last_name' => 'required|max:50',
    			'email' => 'required|email|max:50',
    			'password' => 'required|max:50|min:6'
    			]);
    	return 'login validation passed';
    }
    */
}
