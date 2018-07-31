<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $validator;
    protected $postService;

    public function __construct(Request $request, ValidationService $validator, PostService $postService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->postService = $postService;
    }

    public function add()
    {
        $params = $this->request->only(['post_title', 'post_description', 'post_content', 'post_keyword', 'post_thumbnail', 'post_author', 'post_status', 'post_type']);
        $validator = $this->validator->make($params, 'insert_post_fields');
        if($validator->fails()){
            $result['status'] = false;
            $result['msg'] = $validator->errors()->all();
            return response()->json($result, 400);
        }

        $add = $this->postService->insert($params);
        try {
            $add = $this->postService->insert($params);
            $result['success'] = true;
        } catch(InternalErrorException $e) {
            return response()->json(Message::get(500), 500);
        }
        
        return response()->json($result, 200);
    }
}
