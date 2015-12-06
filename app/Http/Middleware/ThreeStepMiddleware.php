<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ThreeStep;
use Session;

class ThreeStepMiddleware

{
	var $three_step;
	var $role;

	public function __construct(
			ThreeStep $three_step,
			Role $role)
	{
		$this->three_step = $three_step;
		$this->role = $role;
		//		$this->role_user = $role_user;
//		$this->roleHelper = $roleHelper;
	}
	
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
    	$three_step_id = $request->session()->get('three_step_id');
		$data = $this->three_step->getDataArrayMiddleware($role);
    	if (!(isset($three_step_id)))
    	{
    		echo "in three step middleware, role = $role<br>";
    		$obj_role = $this->role->where('name', $role)->first();
    		Session::put('role_id', $obj_role->id);
    		Session::put('cloaked_role_id', $obj_role->cloaked_id);
    		return redirect ('three_step/step_one');
    	}
    	else 
    	{
    		$session_id = $request->session()->getId();
    		$obj_three_step = $three_step
    							->where('three_step_id', $three_step_id)
    							->where('session_id', $session_id)
    							->first();
    		if ($obj_three_step == null)
    		{
    			return redirect ('three_step/step_one');    			 
    		}
    		else 
    		{
    			return $next($request);
    		}
    	}  // end else, if three_step_id is set
    }
}



