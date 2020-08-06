<?php

namespace App\Http\Requests\RestRequests;

use Illuminate\Http\Request;

class RestRequest
{
    public $req_url;
    public $req_path;
    public $req_query;
    public $req_param;
    public $req_method;
    public $req_body;
    public $req_file;
    public $wheres;


    public function __construct()
    {

    }

}
