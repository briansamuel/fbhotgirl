<?php
namespace App\Services;

use App\Models\TaxonomyModel;
use App\Transformers\AgencyTransformer;

class TaxonomyService
{

	public function insert($params)
	{
		$insert['taxonomy_name'] = $params['taxonomy_name']; 
		$insert['taxonomy_parent'] = $params['taxonomy_parent']; 
		$insert['taxonomy_description'] = $params['taxonomy_description']; 
		$insert['taxonomy_type'] = $params['taxonomy_type']; 
		$insert['created_at'] = date("Y-m-d H:i:s"); 
		$insert['updated_at'] = date("Y-m-d H:i:s"); 

		return TaxonomyModel::insert($insert);		
	}

	public function update($id, $params)
	{
		$update['taxonomy_name'] = $params['taxonomy_name']; 
		$update['taxonomy_parent'] = $params['taxonomy_parent']; 
		$update['taxonomy_description'] = $params['taxonomy_description']; 
		$update['taxonomy_type'] = $params['taxonomy_type']; 
		$update['updated_at'] = date("Y-m-d H:i:s"); 

		return TaxonomyModel::update($id, $update);		
	}

	public function delete($id)
	{
		return TaxonomyModel::delete($id);		
	}

}
