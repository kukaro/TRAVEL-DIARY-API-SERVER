<?php

namespace App\Http\Repositories;

use App\Http\Requests\RestRequests\RestRequest;

interface Repositories
{
    public function get(RestRequest $request);
}
