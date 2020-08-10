<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FileService;
use App\Http\Services\Interfaces\PictureService;

class PictureController extends Controller
{
    private PictureService $service;
    private FileService $fileService;
    private RestRequest $request;

    public function __construct(
        PictureService $service,
        FileService $fileService,
        RestRequest $request)
    {
        $this->service = $service;
        $this->fileService = $fileService;
        $this->request = $request;
    }

    public function get()
    {
        $data = $this->service->get($this->request->id);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getWithUser()
    {
        $data = $this->service->getWithUser($this->request->wheres);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post(
            $this->request->owner_id,
            $this->request->location,
            $this->request->path,
            $this->request->req_file,
        );
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch()
    {
        $this->service->patch(
            $this->request->id,
            $this->request->owner_id,
            $this->request->location,
            $this->request->path,
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
}
