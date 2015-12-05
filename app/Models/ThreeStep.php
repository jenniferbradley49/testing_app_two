<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreeStep extends Model
{
	protected $table = 'three_step_security';
	
	public function getValidationRules()
	{
		return array(
				'password' => 'required|max:50',
				'confidence_msg' => 'max:150'
		);
	}
	

	public function getRequestArray($request)
	{
		return array(
			'confidence_msg' => $request->confidence_msg,
			'password' => \Hash::make($request->password)
		);
	}
	

	public function getDataArrayGetStepOne($hint)
	{
		return array(
			'hint' => $hint
		);
	}
	
	public function prepareURL($token)
	{
		$password_reset_url = url('three_step/step_two');
		$password_reset_url .= '?token=';
		$password_reset_url .= $token;
		return $password_reset_url;
	}
	
	
	public function getRecipient($user)
	{
		$obj_user = $this->where('user', $user)->first();
		return $obj_user->email;
	}
	
	
	public function sendMailThreeStep(
			$mail_content,
			$obj_user )
	{
	
		$to      = $obj_user->email;
		$subject = 'password reset - cognitoys';
		$message = $mail_content;
		//		$headers = 'From: hello@cognitoys.com' . "\r\n" .
		//				'Reply-To: hello@cognitoys.com' . "\r\n" .
		//				'X-Mailer: PHP/' . phpversion(). "\r\n" .
		//				'MIME-Version: 1.0' . "\r\n" .
		//				'Content-type:text/html;charset=UTF-8';
		//		$headers  = 'MIME-Version: 1.0' . "\r\n";
		//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = 'From: hello@cognitoys.com' . "\r\n";
		$headers .= 'Reply-To: hello@cognitoys.com'. "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
	
		mail($to, $subject, $message, $headers);
	}
	
	
}





