<?php

namespace App\Http\Requests\RestRequests;

use App\Http\Requests\TravleDiaryRequest;

class RestRequest implements TravleDiaryRequest
{
    public $req_url;
    public $req_path;
    public $req_query;
    public $req_param;
    public $req_method;
    public $req_body;
}
