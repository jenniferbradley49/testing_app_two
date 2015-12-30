<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ThreeStep;
use App\Models\ThreeStepLog;
use App\Models\ThreeStepAdmin;
use App\Models\ThreeStepApprovedTime;
use App\Role;
use Session;
use Validator;
use Storage;

class ThreeStepMiddleware

{
	var $three_step;
	var $three_step_log;
	var $threeStepAdmin;
	var $threeStepApprovedTime;

	public function __construct(
			ThreeStep $three_step,
			ThreeStepAdmin $threeStepAdmin,
			ThreeStepApprovedTime $threeStepApprovedTime,
			ThreeStepLog $three_step_log)
	{
		$this->three_step = $three_step;
		$this->three_step_log = $three_step_log;
		$this->threeStepAdmin = $threeStepAdmin;
		$this->threeStepApprovedTime = $threeStepApprovedTime;
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
    	$ts_implement = $this->threeStepAdmin->getTSImplement();
    	if ($ts_implement)
    	{
    		$this->three_step_log->ip_address = $request->getClientIp();
    		$this->three_step_log->step = 'three step middleware entry';
    		$this->three_step_log->save();
    		$bool_three_step_approved = $request->session()->get('bool_three_step_approved');

    		if (!(isset($bool_three_step_approved)))
    		{
    			$session_id = $request->session()->getId();
    			// next line maintains a stable session ID through 
				// a login, which changes sess id
    			$request->session()->put('ts_session_id', $session_id);
    			if (Session::get('three_step_id_from_step_two') == null)
				{
					return redirect ('three_step/step_one');
				}
				else 
				{
					$obj_three_step = $this->three_step
    					->where('three_step_id', $request->session()->get('three_step_id_from_step_two'))
    					->where('session_id', $session_id)
    					->first();
					$request->session()->forget('three_step_id_from_step_two');
					if ($obj_three_step == null)
    				{
    					return redirect ('three_step/step_one');    			 
    				}
    				else 
    				{
    					Session::put('bool_three_step_approved', 'yes');
						$bool_three_step_approved = $request->session()->get('bool_three_step_approved');
						$this->threeStepApprovedTime->updateApprovedTime($session_id);
    					return $next($request);
    				}
				} // end else - if prior three step attempt
    		}
    		else // if three step approved already set
    		{
    			// retrieves stable sess id after login - login changes session id
    			$session_id = $request->session()->get('ts_session_id');
    			$permit_delay = $this->threeStepAdmin->getPermitDelay();
    			if ($this->threeStepApprovedTime->delayExceeded($permit_delay, $session_id)) 
    			{
    				Session::forget('bool_three_step_approved');
    				$data = array('bool_ts_delay_exceeded', 1);
    				return redirect ('three_step/step_one')->with('data', $data);    				
    			}
    			else // if permissible delay not exceeded
    			{
					$this->threeStepApprovedTime->updateApprovedTime($session_id);
       				return $next($request);
    			}
    		}
    	} // end if ts_implement
    	else
    	{
    		return $next($request);
    	}
    }
}



