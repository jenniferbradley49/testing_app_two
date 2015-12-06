<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreeStepUser extends Model
{
	
	public function getRecipient($user)
	{
		$obj_user = $this->where('user', $user)->first();
		return $obj_user->email;
	}
	
}
