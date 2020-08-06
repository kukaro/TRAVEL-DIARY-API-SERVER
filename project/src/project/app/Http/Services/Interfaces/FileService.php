<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;
use Illuminate\Http\Request;

interface FileService
{
    public function get(Request $request);

    public function post(RestRequest $request);

    public function delete(Request $request);
}
