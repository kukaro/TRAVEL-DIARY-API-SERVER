<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostPictureService;

class PostPictureController extends Controller
{

    private PostPictureService $service;
    private RestRequest $request;

    public function __construct(PostPictureService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->picture_id,
            $this->request->post_id
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
