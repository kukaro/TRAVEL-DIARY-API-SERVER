<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FriendService;
use App\Util\DB\ErrorType;


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
        $data = $this->service->get($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post($this->request);
        if($data instanceof ErrorType){
            return response()->json(['data' => $data], $data->getStatus(), [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
