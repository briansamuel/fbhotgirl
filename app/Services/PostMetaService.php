<?php
namespace App\Services;

use App\Models\PostMetaModel;
use App\Transformers\AgencyTransformer;

class PostMetaService
{

	public function insert($params)
	{
		$insert['post_id'] = $params['post_id']; 
		$insert['meta_key'] = $params['meta_key']; 
		$insert['meta_value'] = $params['meta_value']; 

		return PostMetaModel::insert($insert);		
	}

	public function update($id, $params)
	{
		$update['post_id'] = $params['post_id']; 
		$update['meta_key'] = $params['meta_key']; 
		$update['meta_value'] = $params['meta_value']; 

		return PostMetaModel::update($id, $update);		
	}

	public function delete($id)
	{
		return PostMetaModel::delete($id);		
	}

}
