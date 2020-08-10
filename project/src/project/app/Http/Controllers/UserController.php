<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;

class UserController extends Controller
{
    private UserService $service;
    private RestRequest $request;

    public function __construct(UserService $service, RestRequest $request)
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
        $this->service->post(
            $this->request->email,
            $this->request->name,
            $this->request->age,
            $this->request->birth_date,
            $this->request->password,
            $this->request->is_hiworks,
            $this->request->created_date,
            $this->request->updated_date
        );
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch()
    {
        $this->service->patch($this->request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        $this->service->delete($this->request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getLinkedFriend()
    {
        $data = $this->service->getLinkedFriend($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getByEmailOrName()
    {
        $data = $this->service->getByEmailOrName($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getByPostComment()
    {
        $data = $this->service->getByPostComment($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
