<?php
namespace App\Libraries;

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
	

    /**
     * @param array $arr_data
     * @return string|multitype:string
     */
	public function getSuccessMessage($arr_data)
	{
		$arr_return = array(
				'status' => 'success',
				'data' => $arr_data
		);
		return json_encode($arr_return);
	}

    /**
     * @param array $arr_data
     * @return string|multitype:string
     */
	public function getFailMessageOther($arr_data)
	{
		$arr_return = array(
				'status' => 'fail',
				'data' => $arr_data
		);
		return json_encode($arr_return);
	}
	
	
    /**
     * @return string|multitype:string
     */
	public function getDefaultMessage()
	{
		return json_encode(array('status' => 'fail'));
	}
	
}