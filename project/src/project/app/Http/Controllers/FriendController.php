<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FriendService;


class FriendController extends Controller
{
    private FriendService $service;
    private RestRequest $request;

    public function __construct(FriendService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->wheres);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->owner_id,
            $this->request->friend_id
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
