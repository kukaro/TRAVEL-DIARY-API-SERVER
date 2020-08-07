<?php

namespace App\Http\Requests\RestRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

abstract class RestRequest extends FormRequest
{
    public string $req_url;
    public string $req_path;
    public array $req_query;
    public array $req_param;
    public string $req_method;
    public array $req_body;
    public ?UploadedFile $req_file;
    public array $wheres;


    public function __construct()
    {

    }
}
