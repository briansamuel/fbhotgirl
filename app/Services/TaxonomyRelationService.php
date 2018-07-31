<?php
namespace App\Services;

use App\Models\TaxonomyRelationModel;
use App\Transformers\AgencyTransformer;

class TaxonomyRelationService
{

	public function insert($params)
	{
		$insert['term_id'] = $params['term_id']; 
		$insert['post_id'] = $params['post_id']; 
		$insert['created_at'] = date("Y-m-d H:i:s"); 
		$insert['updated_at'] = date("Y-m-d H:i:s"); 

		return TaxonomyRelationModel::insert($insert);		
	}

	public function update($id, $params)
	{
		$update['term_id'] = $params['term_id']; 
		$update['post_id'] = $params['post_id']; 
		$update['updated_at'] = date("Y-m-d H:i:s"); 

		return TaxonomyRelationModel::update($id, $update);		
	}

	public function delete($id)
	{
		return TaxonomyRelationModel::delete($id);		
	}

}
