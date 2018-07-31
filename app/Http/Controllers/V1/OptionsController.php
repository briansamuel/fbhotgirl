<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\OptionsService;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $validator;
    protected $optionsService;

    public function __construct(Request $request, ValidationService $validator, OptionsService $optionsService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->optionsService = $optionsService;
    }

    public function add()
    {
        $params = $this->request->only(['id_option', 'meta_key', 'meta_value']);
        $validator = $this->validator->make($params, 'insert_options_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $add = $this->optionsService->insert($params);
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
        $params = $this->request->only(['id_option', 'meta_key', 'meta_value']);
        $validator = $this->validator->make($params, 'edit_options_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        try {
            $update = $this->optionsService->update($id, $params);
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
            $this->optionsService->delete($id);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }
}
