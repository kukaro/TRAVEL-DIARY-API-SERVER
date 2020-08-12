<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostService $service;
    private RestRequest $request;

    /**
     * PostController constructor.
     * @param PostService $service
     * @param RestRequest $request
     */
    public function __construct(PostService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $data = $this->service->get($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return JsonResponse
     */
    public function getWithPicture(): JsonResponse
    {
        $data = $this->service->getWithPicture($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return JsonResponse
     */
    public function post(): JsonResponse
    {
        $data = $this->service->post(
            $this->request->owner_id,
            $this->request->title,
            $this->request->contents,
            $this->request->parents_post_id,
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return JsonResponse
     */
    public function patch(): JsonResponse
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

    /**
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $this->service->delete($this->request->id);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return JsonResponse
     */
    public function getWithUser(): JsonResponse
    {
        $data = $this->service->getWithUser($this->request->wheres);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
