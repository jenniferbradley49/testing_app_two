<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThreeStep;
use Hash;

class ThreeStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStepOne()
    {
        $obj_three_step = $threeStep->first();
        $data = $threeStep->getDataArrayGetStepOne($obj_three_step->hint, 'admin');
        return view('three_step/step_one')->with('data', $data);       
    }

    public function postStepOne(   		
    		Request $request, 
    		ThreeStep $threeStep, ThreeStepUser $tSUser)
 
    {
    	$validation_rules = $threeStep->getValidationRules();
    	$this->validate($request, $validation_rules);
    	$arr_request = $threeStep->getRequestArray($request);
    	$obj_ts_user = $tSUser->where('user', 'admin');
		if (!($obj_ts_user == null))
		{
			if (!(Hash::check($arr_request['password'], $obj_ts_user->password)))
			{
        		$obj_three_step = $threeStep->first();
        		$errors = array('message'=> 'Your credential for this page could not be validated');
        		$data = $threeStep->getDataArrayGetStepOne($obj_three_step->hint);
        		return view('three_step/step_one')
        			->with('data', $data)
        			->withErrors($errors);
			}
			else // if password validated
			{
				$obj_three_step->three_step_id = Hash::make((string)time());
    			$obj_three_step->session_id = $request->session()->getId();
    			$obj_three_step->save();
    			
 //   			$password_reset_id = $password_reset->id;
    			$three_step_url = $threeStep->prepareURL($obj_three_step->three_step_id);
				$recipient = $threeStep->getRecipient('admin');
    			$mail_content = view('emails/password')->with('three_step_url', $three_step_url);
    			// this is the laravel mail
    			// commented out as no credentials for mail server are available
    			// see function in user.php moldel for more info
    			/*
    			 $user->sendMailResetPassword(
    			 		$password_reset_url,
    			 		$obj_user
    			 );
    			*/
    			 
    			$user->sendMailThreeStep(
    					$mail_content,
    					$recipient
    			);
    			
			}
//    	$data = $threeStep->getDataArray(
 //   			$arr_request['password']);
		}
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
