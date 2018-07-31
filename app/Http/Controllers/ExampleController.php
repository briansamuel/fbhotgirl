<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $validator;

    public function __construct(Request $request, ValidationService $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }

    public function add()
    {
        $params = $this->request->only(['name', 'phone_number', 'email', 'address', 'cmnd', 'lat', 'long', 'bank_name', 'bank_code', 'bank_branch', 'bank_account_number', 'bank_holder_name', 'store_name']);
    }
}
