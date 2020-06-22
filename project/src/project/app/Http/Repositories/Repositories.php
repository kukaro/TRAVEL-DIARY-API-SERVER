<?php

namespace App\Http\Repositories;

use App\Http\Requests\RestRequests\RestRequest;

interface Repositories
{
    public function read(RestRequest $request);
    public function create(RestRequest $request);
    public function update(RestRequest $request);
}
