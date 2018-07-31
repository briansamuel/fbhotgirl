<?php
namespace App\Services;

use App\Models\OptionsModel;
use App\Transformers\AgencyTransformer;

class OptionsService
{

	public function insert($params)
	{
		$insert['id_option'] = $params['id_option']; 
		$insert['meta_key'] = $params['meta_key']; 
		$insert['meta_value'] = $params['meta_value']; 

		return OptionsModel::insert($insert);		
	}

	public function update($id, $params)
	{
		$update['id_option'] = $params['id_option']; 
		$update['meta_key'] = $params['meta_key']; 
		$update['meta_value'] = $params['meta_value']; 

		return OptionsModel::update($id, $update);		
	}

	public function delete($id)
	{
		return OptionsModel::delete($id);		
	}

}
