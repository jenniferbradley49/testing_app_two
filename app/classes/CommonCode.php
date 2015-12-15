<?php
namespace App\classes;

class CommonCode
{
	

    /**
     * @param array $arr_info
     * @param Mixed(a model) $obj_model
     * @return Mixed $obj_model
     */
	public function getObject($arr_info, $obj_model)
	{
		foreach ($arr_info as $key =>$val)
		{
			$obj_model->$key = $val;
		}
		return $obj_model;
	}
	

	public function setCheckboxVar($checkbox)
	{
		// accepts checkbox on or off, returns 1 or 0
	    if ((isset($checkbox) && ($checkbox == 'on')))
    	{
    		return 1;
    	}
    	else
        {
    		return 0;
    	}
	}
	
}