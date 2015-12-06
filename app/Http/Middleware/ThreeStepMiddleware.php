<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ThreeStep;
use Session;

class ThreeStepMiddleware

{
	var $three_step;

	public function __construct(
			ThreeStep $three_step)
	{
		$this->three_step = $three_step;
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
 //   		$this->three_step->setRole($role);
    		Session::put('three_step_role', $role);
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



