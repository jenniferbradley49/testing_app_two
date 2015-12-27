<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Storage;

class ThreeStepApprovedTime extends Model
{
    public function updateApprovedTime($request)
    {
    	$session_id = $request->session()->getId();
    	$objThreeStepApprovedTime = $this
    								->where('session_id', $session_id)
    								->first();
    	if ($objThreeStepApprovedTime == null)
    	{
    		$objThreeStepApprovedTime = new self;
	    	$objThreeStepApprovedTime->session_id = $request->session()->getId();
    	}
    	$objThreeStepApprovedTime->last_update_time = Carbon::now();
    	$objThreeStepApprovedTime->save();
    }
    

    /**
     * @param unknown $permit_delay
     * @param unknown $session_id
     * @return number|boolean
     */
    public function delayExceeded($permit_delay, $session_id)
    {
  Storage::put('inDelayExceeded_permit_delay', json_encode($permit_delay));  	
  Storage::put('inDelayExceeded_session_id', $session_id);  	
  		if ($permit_delay == 0)
    	{
    		return 0;
    	}
    	else  // if delay time set
    	{
    		$objThreeStepApprovedTime = $this->where('session_id', $session_id)->first();
    	Storage::put('three_step_approved_time.txt', json_encode($objThreeStepApprovedTime));
			if ($objThreeStepApprovedTime == null)
			{
				return 0;
			}
    		$permitted_time = Carbon::now()->subMinutes($permit_delay);
  Storage::put('inDelayExceeded_permitted_time', json_encode($permitted_time));  	
Storage::put('inDelayExceeded_last_update', $objThreeStepApprovedTime->last_update_time);
  Storage::put('inDelayExceeded_permitted_time_date_property', $permitted_time->date);
			$objCarbonLastUpdate = new Carbon($objThreeStepApprovedTime->last_update_time);
			$objCarbonPermittedTime = new Carbon($permitted_time->date);
			return $objCarbonLastUpdate->lte($objCarbonPermittedTime);
//    			->lte($permitted_time);
    	}
    }
    
    
}
