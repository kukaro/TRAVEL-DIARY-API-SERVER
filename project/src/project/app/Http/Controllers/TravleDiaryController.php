<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Interfaces\TravleDiaryService;
use Illuminate\Routing\Controller as BaseController;

abstract class TravleDiaryController extends BaseController{
    protected $service;
    protected $request;

    public function __construct(TravleDiaryService $service, RestRequest $request)
    {
        $this->service = $service;
        $this->request = $request;
    }
}