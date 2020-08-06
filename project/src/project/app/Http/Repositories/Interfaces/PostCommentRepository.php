<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostCommentRepository
{
    public function read(RestRequest $request);

    public function readWithPost(RestRequest $request);

    public function create(RestRequest $request);

    public function update(RestRequest $request);

    public function delete(RestRequest $request);
}
