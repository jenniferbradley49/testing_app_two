<?php

namespace App\Http\Middleware;

use Closure;

class ThreeStepMiddleware
{
	

	public function __construct(
			Three_step $three_step)
	{
		$this->role_user = $role_user;
		$this->roleHelper = $roleHelper;
	}
	
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$three_step_id = $request->session()->get('three_step_id');
    	if (!(isset($three_step_id)))
    	{
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



