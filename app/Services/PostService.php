<?php
namespace App\Services;

use App\Models\PostModel;
use App\Transformers\AgencyTransformer;

class PostService
{

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

}
