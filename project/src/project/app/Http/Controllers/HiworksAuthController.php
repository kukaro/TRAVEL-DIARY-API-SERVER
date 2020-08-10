<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\HiworksAuthService;

class HiworksAuthController extends Controller
{
    private HiworksAuthService $service;
    private RestRequest $request;

    public function __construct(HiworksAuthService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->user_no);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->user_no,
            $this->request->owner_id,
            $this->request->office_no,
            $this->request->user_id,
            $this->request->user_name,
            $this->request->access_token,
            $this->request->refresh_token
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch()
    {
        $this->service->patch(
            $this->request->user_no,
            $this->request->access_token,
            $this->request->refresh_token
        );
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
