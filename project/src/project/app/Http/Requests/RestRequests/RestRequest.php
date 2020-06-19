<?php

namespace App\Http\Requests\RestRequests;

use App\Http\Requests\TravleDiaryRequest;

class RestRequest implements TravleDiaryRequest
{
    protected $url;
    protected $path;
    protected $query;
    protected $param;
    protected $method;
}
