<?php
namespace App\Services;

use App\Models\PostModel;
use App\Transformers\AgencyTransformer;

class PostService
{
	public function getMany($limit, $offset)
	{
		$result = PostModel::getMany($limit, $offset);
        return $result ? $result : [];
	}

	public function findByKey($key, $value)
	{
        $result = PostModel::findByKey($key, $value);
        return $result ? $result : [];
	}

	public function insert($params)
	{
		$insert['post_title'] = $params['post_title']; 
		$insert['post_slug'] = str_slug($params['post_title']); 
		$insert['post_description'] = $params['post_description']; 
		$insert['post_content'] = $params['post_content']; 
		$insert['post_keyword'] = $params['post_keyword']; 
		$insert['post_thumbnail'] = $params['post_thumbnail']; 
		$insert['post_author'] = $params['post_author']; 
		$insert['post_status'] = $params['post_status']; 
		$insert['post_type'] = $params['post_type']; 
		$insert['created_at'] = date("Y-m-d H:i:s"); 
		$insert['updated_at'] = date("Y-m-d H:i:s"); 

		return PostModel::insert($insert);		
	}

	public function update($id, $params)
	{
		$update['post_title'] = $params['post_title']; 
		$update['post_slug'] = str_slug($params['post_title']); 
		$update['post_description'] = $params['post_description']; 
		$update['post_content'] = $params['post_content']; 
		$update['post_keyword'] = $params['post_keyword']; 
		$update['post_thumbnail'] = $params['post_thumbnail']; 
		$update['post_author'] = $params['post_author']; 
		$update['post_status'] = $params['post_status']; 
		$update['post_type'] = $params['post_type']; 
		$update['updated_at'] = date("Y-m-d H:i:s"); 

		return PostModel::update($id, $update);		
	}

	public function delete($id)
	{
		return PostModel::delete($id);		
	}

}
