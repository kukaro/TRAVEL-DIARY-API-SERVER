<?php

namespace App\Http\Requests\RestRequests;

use App\Http\Requests\TravleDiaryRequest;

class RestRequest implements TravleDiaryRequest
{
    protected $req_url;
    protected $req_path;
    protected $req_query;
    protected $req_param;
    protected $req_method;
    protected $req_body;
}
