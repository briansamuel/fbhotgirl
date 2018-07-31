<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\TaxonomyService;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $validator;
    protected $taxonomyService;

    public function __construct(Request $request, ValidationService $validator, TaxonomyService $taxonomyService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->taxonomyService = $taxonomyService;
    }

    public function add()
    {
        $params = $this->request->only(['taxonomy_name', 'taxonomy_parent', 'taxonomy_description', 'taxonomy_type']);
        $validator = $this->validator->make($params, 'insert_taxonomy_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $add = $this->taxonomyService->insert($params);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }

    public function edit($id)
    {
        if(!$id){
            $result['status'] = false;
            $result['msg'] = "Tham số truyền vào không hợp lệ";
            return response()->json($result, 400);
        }
        $params = $this->request->only(['taxonomy_name', 'taxonomy_parent', 'taxonomy_description', 'taxonomy_type']);
        $validator = $this->validator->make($params, 'edit_taxonomy_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $update = $this->taxonomyService->update($id, $params);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }

    public function delete($id)
    {
        if(!$id){
            $result['status'] = false;
            $result['msg'] = "Tham số truyền vào không hợp lệ";
            return response()->json($result, 400);
        }

        try {
            $this->taxonomyService->delete($id);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }
}
