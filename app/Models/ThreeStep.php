<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreeStep extends Model
{
	protected $table = 'three_step_security';
	protected static $role = 'user';

	
	public function setRole($role)
	{
		self::$role = $role;
	}

	
	public function getRole()
	{
		return self::$role;
	}
	
	
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
			'password' => $request->password
		);
	}
	

	public function getDataArrayGetStepOne($hint)
	{
		return array(
			'hint' => $hint
		);
	}

	public function getDataArrayMiddleware()
	{
		return array(
				'role' => $this->role
		);
	}
	

	public function getDataArrayEmail($confidence_msg, $three_step_url)
	{
		return array(
				'confidence_msg' => $confidence_msg,
				'three_step_url' => $three_step_url,
		);
	}
	
	
	public function prepareURL($token)
	{
		$product_url = url('three_step/step_two');
		$product_url .= '?token=';
		$product_url .= $token;
		return $product_url;
	}
	
	
	public function sendMailThreeStep(
			$mail_content,
			$recipient )
	{
	
		$to      = $recipient;
		$subject = 'password reset - cognitoys';
		$message = $mail_content;
		//		$headers = 'From: hello@cognitoys.com' . "\r\n" .
		//				'Reply-To: hello@cognitoys.com' . "\r\n" .
		//				'X-Mailer: PHP/' . phpversion(). "\r\n" .
		//				'MIME-Version: 1.0' . "\r\n" .
		//				'Content-type:text/html;charset=UTF-8';
		//		$headers  = 'MIME-Version: 1.0' . "\r\n";
		//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = 'From: hello@pad.com' . "\r\n";
		$headers .= 'Reply-To: hello@cognitoys.com'. "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
	
		mail($to, $subject, $message, $headers);
	}
	
	
}





