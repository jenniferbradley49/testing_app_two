<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ThreeStep;
use App\Models\ThreeStepLog;
use App\Role;
use Session;
use Validator;
use Storage;

class ThreeStepMiddleware

{
	var $three_step;
	var $role;

	public function __construct(
			ThreeStep $three_step,
			Role $role,
			ThreeStepLog $three_step_log)
	{
		$this->three_step = $three_step;
		$this->three_step_log = $three_step_log;
		$this->role = $role;
	}
	
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	// must change role var name - too close to this->role
    public function handle($request, Closure $next, $specified_role)
    {
    	$this->three_step_log->ip_address = $request->getClientIp();
    	$this->three_step_log->step = 'three step middleware entry';
    	$this->three_step_log->save();
    	$bool_three_step_approved = $request->session()->get('bool_three_step_approved');
    	if (!(isset($bool_three_step_approved)))
    	{
    		$obj_role = $this->role->where('name', $specified_role)->first();
    		Session::put('role_id', $obj_role->id);
    		Session::put('cloaked_role_id', $obj_role->cloaked_id);
    	    $session_id = $request->session()->getId();
// if no prior three step attempt
			if (Session::get('cloaked_role_id_from_step_two') == null)
			{
				return redirect ('three_step/step_one');
			}
			else 
			{
  //  	\DB::listen(function($sql, $bindings, $time) {
   // 		Storage::put('middleware_three.txt', $sql);
  //  		Storage::put('middleware_four.txt', $bindings);
  //  		Storage::put('middleware_five.txt', $time);
//    		var_dump($bindings);
 //   		var_dump($time);
//    	});
				$obj_three_step = $this->three_step
    				->where('three_step_id', Session::get('three_step_id_from_step_two'))
    				->where('cloaked_role_id', Session::get('cloaked_role_id_from_step_two'))
    				->where('session_id', $session_id)
    				->first();
				Session::forget('cloaked_role_id_from_step_two');
				Session::forget('three_step_id_from_step_two');
				if ($obj_three_step == null)
    			{
    				return redirect ('three_step/step_one');    			 
    			}
    			else 
    			{
    				Session::put('bool_three_step_approved', $obj_three_step->id);
    				return $next($request);
    			}
			} // end else - if prior three step attempt
    	}
    	else 
    	{
    		return $next($request);
    	}
 //   	} // if validation passes
    }
}



