<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private FileService $service;

    /**
     * Class constructor.
     * @param FileService $service
     */
    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request)
    {
        return $this->service->get($request->route()->catchall);
    }

    public function post(RestRequest $request){
        return $this->service->post($request->path, $request->req_file);
    }

    public function delete(Request $request){
        return $this->service->delete($request->route()->catchall);
    }
}
