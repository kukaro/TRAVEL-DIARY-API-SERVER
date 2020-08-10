<?php

namespace App\Http\Controllers;

use App;
use App\Http\Dto\PostDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostCommentService;

class PostCommentController extends Controller
{
    private PostCommentService $service;
    private RestRequest $request;

    public function __construct(PostCommentService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getWithPost()
    {
        $data = $this->service->getWithPost(
            $this->request->id,
            $this->request->wheres
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->owner_id,
            $this->request->post_id,
            $this->request->contents,
            $this->request->parents_comment_id,
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
