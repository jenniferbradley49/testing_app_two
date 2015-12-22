<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Html;
use Storage;

class ThreeStep extends Model
{
	protected $table = 'three_step_security';
	protected static $role = 'user';
	protected $fillable = ['three_step_id', 'role_id', 'cloaked_role_id', 'session_id'];

	
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
	

	public function getValidationRulesStepTwo()
	{
		return array(
				'three_step_id' => 'required|max:100',
				'cloaked_role_id' => 'required|max:100',
		);
	}
	
	
	public function getRequestArray($request)
	{
		return array(
			'confidence_msg' => $request->confidence_msg,
			'password' => $request->password
		);
	}
	

	public function getRequestArrayStepTwo($request)
	{
		return array(
				'three_step_id' => $request->three_step_id,
				'cloaked_role_id' => $request->cloaked_role_id,
		);
	}
	
	
	public function getDataArrayGetStepOne($hint, $ts_user, $ts_bypass, $bypass_warning)
	{
		return array(
			'hint' => $hint,
			'ts_user' => $ts_user,
			'ts_bypass' => $ts_bypass,
			'bypass_warning' => $bypass_warning
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
				'three_step_link' => Html::link($three_step_url, 'Click here'),
		);
	}

	public function setBypassWarning($ts_bypass)
	{
		if ($ts_bypass)
		{
			$bypass_warning = "Three step security is currently in bypass mode.
        			This means that clicking on submit, below,
        			will successfully complete three step security
        			without sending any email.  You can configure the three step 
					bypass option on the admin dashboard";
		}
		else
		{
			$bypass_warning = null;
		}
		return $bypass_warning;
	}
	
	
	public function prepareURL($three_step_id, $cloaked_role_id)
	{
		$product_url = url('three_step/step_two');
		$product_url .= '?three_step_id=';
		$product_url .= $three_step_id;
		$product_url .= '&cloaked_role_id=';
		$product_url .= $cloaked_role_id;
		return $product_url;
	}
	
/*	
	public function sendMailThreeStep(
			$mail_content,
			$recipient )
	{
echo "in three step model, line 101 reached<br>";	
		$to      = $recipient;
		$subject = 'three step security check';
		$message = $mail_content;
		//		$headers = 'From: hello@cognitoys.com' . "\r\n" .
		//				'Reply-To: hello@cognitoys.com' . "\r\n" .
		//				'X-Mailer: PHP/' . phpversion(). "\r\n" .
		//				'MIME-Version: 1.0' . "\r\n" .
		//				'Content-type:text/html;charset=UTF-8';
		//		$headers  = 'MIME-Version: 1.0' . "\r\n";
		//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = 'From: hello@pad.com' . "\r\n";
		$headers .= 'Reply-To: hello@pad.com'. "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion(). "\r\n";
		echo "in three step model, line 115 reached<br>";
		echo "to = $to<br>";
		echo "subject = $subject<br>";
		echo "message = $message<br><br>";
		echo "headers = $headers<br><br>";
		return mail($to, $subject, $message, $headers);
	}
*/

	public function sendMailThreeStep(
			$mail_content,
			$recipient )
	{
		Storage::put('three_step_email.txt', $mail_content);
		return true;
	}
	
	
}





