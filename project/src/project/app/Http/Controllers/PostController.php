<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostService;

class PostController extends Controller
{
    private PostService $service;
    private RestRequest $request;

    public function __construct(PostService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getWithPicture()
    {
        $data = $this->service->getWithPicture($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->owner_id,
            $this->request->title,
            $this->request->contents,
            $this->request->parents_post_id,
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch()
    {
        $this->service->patch(
            $this->request->id,
            $this->request->owner_id,
            $this->request->title,
            $this->request->contents,
            $this->request->parents_post_id,
            $this->request->created_date,
            $this->request->updated_date
        );
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        $this->service->delete($this->request->id);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getWithUser()
    {
        $data = $this->service->getWithUser($this->request->wheres);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
