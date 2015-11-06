<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
//	public $timestamps = false;
	// builds Eloquent relationship to associate users with roles
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
