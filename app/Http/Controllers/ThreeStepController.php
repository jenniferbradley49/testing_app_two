<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThreeStep;
use App\Models\ThreeStepUser;
use App\Models\ThreeStepLog;
use App\Role;
use Hash;
use Session;

class ThreeStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStepOne(
    		Request $request,
    		ThreeStep $threeStep,
	   		ThreeStepLog $three_step_log,
    		ThreeStepUser $threeStepUser)
    {
    	$three_step_log->ip_address = $request->getClientIp();
   		$three_step_log->step = 'three step step one get';
    	$three_step_log->save();

    	$role_id = Session::get('role_id');
        $obj_three_step_user = $threeStepUser
        	->where('role_id', $role_id)
        	->first();
        
		$data = $threeStep->getDataArrayGetStepOne($obj_three_step_user->hint, 'admin');
        return view('three_step/step_one')->with('data', $data);       
    }

    public function postStepOne(   		
    		Request $request, 
    		ThreeStep $threeStep, 
	   		ThreeStepLog $three_step_log,
    		ThreeStepUser $tSUser)
 
    {
    	$three_step_log->ip_address = $request->getClientIp();
    	$three_step_log->step = 'three step step one post entry';
    	$three_step_log->save();
    	//    	$bool_mail_sent = 0;
   // 	mail('dbirch9924@gmail.com', 'test subject', 'test msg') or die('no mail()');
 //   	echo 'mail sent.';
//    echo "post step one reached, line 41<br>";	
    	$validation_rules = $threeStep->getValidationRules();
    	$this->validate($request, $validation_rules);
    	$arr_request = $threeStep->getRequestArray($request);
    	$role_id = Session::get('role_id');
    	$obj_ts_user = $tSUser
    		->where('role_id', $role_id)
    		->first();
//    	echo "<pre>";
//   	print_r($obj_ts_user);
//    	echo "</pre>";
    	   
		if (!($obj_ts_user == null))
		{
			if (!(Hash::check($arr_request['password'], $obj_ts_user->password)))
			{
 //       		$obj_three_step = $threeStep->first();
        		$errors = array('message'=> 'Your credentials for this page could not be validated');
        		$data = $threeStep
        		->getDataArrayGetStepOne(
        				$obj_ts_user->hint,
        				$arr_request['confidence_msg']);
        		return view('three_step/step_one')
        			->with('data', $data)
        			->withErrors($errors);
			}
			else // if password validated
			{
				// delete all old records with same role id
//		 nah, bad idea		$threeStep->where('role_id', $role_id)->delete();
				
				$threeStep->three_step_id = Hash::make((string)time());
    			$threeStep->session_id = $request->session()->getId();
    			$threeStep->cloaked_role_id = Session::get('cloaked_role_id');
    			$threeStep->role_id = $role_id;
    			$threeStep->save();
    			
 //   			$password_reset_id = $password_reset->id;
 //   			$cloaked_role_id = Session::get('cloaked_role_id');
    			$three_step_url = $threeStep->prepareURL(
    				$threeStep->three_step_id,
    				$threeStep->cloaked_role_id);
//    			$role_id = Session::get('role_id');
 //   			$recipient = $threeStepUser->getRecipient($role);
     			$recipient = $obj_ts_user->email;
     			$data = $threeStep->getDataArrayEmail(
     				$arr_request['confidence_msg'], 
     				$three_step_url);
     			$mail_content = view('emails/three_step')
     			->with('data', $data)
     			->render();

     			$three_step_log->ip_address = $request->getClientIp();
     			$three_step_log->step = 'three step step one post mail sent';
     			$three_step_log->save();
     			
     			return view('emails/three_step')
     			->with('data', $data);
    			// this is the laravel mail
    			// commented out as no credentials for mail server are available
    			// see function in user.php moldel for more info
    			/*
    			 $user->sendMailResetPassword(
    			 		$password_reset_url,
    			 		$obj_user
    			 );
    			*/
// echo "line 103 reached<br>";   			 
/*
    			if ($threeStep->sendMailThreeStep(
    					$mail_content,
    					$recipient
    				))
    			{
    				return view('three_step/step_one_success');
    			}
*/			
			}
//    	$data = $threeStep->getDataArray(
 //   			$arr_request['password']);
		}
//    	return view('three_step/step_one_fail');

	}

    /**
     * @param Request $request
     * @param ThreeStep $threeStep
     * @param ThreeStepLog $three_step_log
     * @param Role $role
     * @return Ambigous <\Illuminate\Http\$this, boolean, \Illuminate\Http\RedirectResponse>|Ambigous <\Illuminate\View\View, mixed, \Illuminate\Foundation\Application, \Illuminate\Container\static>
     */
    public function getStepTwo(Request $request, 
    		ThreeStep $threeStep,
	   		ThreeStepLog $three_step_log,
    		Role $role)
    {
    	$validation_rules = $threeStep->getValidationRulesStepTwo();
    	$this->validate($request, $validation_rules);
    	$arr_request = $threeStep->getRequestArrayStepTwo($request);
    	$role_id = Session::get('role_id');
//    	\DB::listen(function($sql, $bindings, $time) {
 //   		var_dump($sql);
 //   		var_dump($bindings);
 //   		var_dump($time);
 //   	});
    	$obj_role = $role
    	->where('id', $role_id)
    	->where('cloaked_id', $arr_request['cloaked_role_id'])
    	->first();
    //	dd($obj_role);
//    echo "<pre>";
 //   var_dump($obj_role);
 //   echo "</pre><br>";
//    echo "obj_role name = ".$obj_role->name."<br>";
    	if (!($obj_role == null))
    	{
    		$three_step_log->ip_address = $request->getClientIp();
    		$three_step_log->step = 'three step step two success';
    		$three_step_log->save();
    		
    		if ($obj_role->name == 'admin')
    		{
  //  			echo "obj_role name = ".$obj_role->name."<br>";
    			Session::put('cloaked_role_id_from_step_two', $arr_request['cloaked_role_id']);
    			Session::put('three_step_id_from_step_two', $arr_request['three_step_id']);
    			 
    			return redirect ('admin/home')
    				->withInput();
    		}
    	}
    	else 
    	{
    		$three_step_log->ip_address = $request->getClientIp();
    		$three_step_log->step = 'three step step two failure - bad input';
    		$three_step_log->save();
    		// role not found in role table 
    		return view('three_step/step_two_fail');
    	}
    }

    public function getLogout(Request $request)
    {
    	Session::forget('cloaked_role_id_from_step_two');
    	Session::forget('bool_three_step_approved');
    	return view('three_step/logout');
    }

}
