<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Interfaces\UserService;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    private $user_service;

    /**
     * Class constructor.
     */
    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function get(UserRestRequest $request)
    {
        $data = $this->user_service->get($request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
