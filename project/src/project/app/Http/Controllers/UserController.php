<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Interfaces\TravleDiaryService;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    private $service;

    /**
     * Class constructor.
     */
    public function __construct(TravleDiaryService $service)
    {
        $this->service = $service;
    }

    public function get(UserRestRequest $request)
    {
        $data = $this->service->get($request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post(UserRestRequest $request)
    {
        $this->service->post($request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch(UserRestRequest $request)
    {
        $this->service->patch($request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete(UserRestRequest $request)
    {
        $this->service->delete($request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
