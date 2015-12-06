<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThreeStep;
use App\Models\ThreeStepUser;
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
    		ThreeStep $threeStep,
    		ThreeStepUser $threeStepUser)
    {
    	$role = Session::get('three_step_role');
//    	echo "role = ".$role."<br>";
        $obj_three_step_user = $threeStepUser
        	->where('user', $role)
        	->first();
//echo "<pre>";
//print_r($obj_three_step_user);
//echo "</pre>";
		$data = $threeStep->getDataArrayGetStepOne($obj_three_step_user->hint, 'admin');
        return view('three_step/step_one')->with('data', $data);       
    }

    public function postStepOne(   		
    		Request $request, 
    		ThreeStep $threeStep, ThreeStepUser $tSUser)
 
    {
    	$validation_rules = $threeStep->getValidationRules();
    	$this->validate($request, $validation_rules);
    	$arr_request = $threeStep->getRequestArray($request);
    	$role = Session::get('three_step_role');
    	$obj_ts_user = $tSUser
    		->where('user', $role)
    		->first();
 //   	echo "<pre>";
//   	print_r($obj_ts_user);
 //   	echo "</pre>";
    	   
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
				$threeStep->three_step_id = Hash::make((string)time());
    			$threeStep->session_id = $request->session()->getId();
				$threeStep->role = $role;
    			$threeStep->save();
    			
 //   			$password_reset_id = $password_reset->id;
    			$three_step_url = $threeStep->prepareURL($threeStep->three_step_id);
    			$role = Session::get('three_step_role');
 //   			$recipient = $threeStepUser->getRecipient($role);
     			$recipient = $obj_ts_user->email;
     			$data = $threeStep->getDataArrayEmail($arr_request['confidence_msg'], $three_step_url);
echo "<pre>";
print_r($data);
echo "</pre>";
     			$mail_content = view('emails/three_step')->with('data', $data);
    			// this is the laravel mail
    			// commented out as no credentials for mail server are available
    			// see function in user.php moldel for more info
    			/*
    			 $user->sendMailResetPassword(
    			 		$password_reset_url,
    			 		$obj_user
    			 );
    			*/
    			 
    			$threeStep->sendMailThreeStep(
    					$mail_content,
    					$recipient
    			);
    			
			}
//    	$data = $threeStep->getDataArray(
 //   			$arr_request['password']);
		}

    }

    public function getStepTwo(Request $request, ThreeStep $threeStep)
    {
/*    	$validation_rules = $threeStep->getValidationRulesStepTwo();
    	$this->validate($request, $validation_rules);
    	$arr_request = $threeStep->getRequestArrayStepTwo($request);
    	$role = Session::get('three_step_role');
    	$obj_three_step = $threeStep
    	->where('user', $role)
    	->first();
 */   	 
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
