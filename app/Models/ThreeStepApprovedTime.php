<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Storage;

class ThreeStepApprovedTime extends Model
{
    public function updateApprovedTime($session_id)
    {
Storage::put('in_update_approved_time_sess_id', $session_id);
    	$objThreeStepApprovedTime = $this
    								->where('session_id', $session_id)
    								->first();
    	if ($objThreeStepApprovedTime == null)
    	{
    		$objThreeStepApprovedTime = new self;
//	    	$objThreeStepApprovedTime->session_id = $request->session()->getId();
    		$objThreeStepApprovedTime->session_id = $session_id;
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
Storage::put('in_delay_exceeded_ts_user_null', 'yes');
				return 1;
			}
    		$permitted_time = Carbon::now()->subMinutes($permit_delay);
  Storage::put('inDelayExceeded_permitted_time', json_encode($permitted_time));  	
Storage::put('inDelayExceeded_last_update', $objThreeStepApprovedTime->last_update_time);
  Storage::put('inDelayExceeded_permitted_time_date_property', $permitted_time->date);
			$objCarbonLastUpdate = new Carbon($objThreeStepApprovedTime->last_update_time);
			$objCarbonPermittedTime = new Carbon($permitted_time->date);
Storage::put('in_delay_exceeded_result', $objCarbonLastUpdate->lte($objCarbonPermittedTime));
			return $objCarbonLastUpdate->lte($objCarbonPermittedTime);
    	}
    }    
}




