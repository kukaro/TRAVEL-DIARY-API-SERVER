<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostPictureService extends TravleDiaryService
{
    public function get(RestRequest $request);
    public function post(RestRequest $request);
    public function delete(RestRequest $request);
    public function put(RestRequest $request);
    public function patch(RestRequest $request);
}
