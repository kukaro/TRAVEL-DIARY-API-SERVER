<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PictureRepository
{
    public function read(RestRequest $request);

    public function readWithPicture(RestRequest $request);

    public function readWithUser(RestRequest $request);

    public function create(RestRequest $request);

    public function update(RestRequest $request);

    public function delete(RestRequest $request);
}
