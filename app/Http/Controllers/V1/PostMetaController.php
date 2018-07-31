<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\PostMetaService;
use Illuminate\Http\Request;

class PostMetaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $validator;
    protected $postMetaService;

    public function __construct(Request $request, ValidationService $validator, PostMetaService $postMetaService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->postMetaService = $postMetaService;
    }

    public function add()
    {
        $params = $this->request->only(['post_id', 'meta_key', 'meta_value']);
        $validator = $this->validator->make($params, 'insert_post_meta_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $add = $this->postMetaService->insert($params);
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
        $params = $this->request->only(['post_id', 'meta_key', 'meta_value']);
        $validator = $this->validator->make($params, 'edit_post_meta_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $update = $this->postMetaService->update($id, $params);
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
            $this->postMetaService->delete($id);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }
}