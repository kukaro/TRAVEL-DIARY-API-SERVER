<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserRepository
{
    public function read(RestRequest $request);

    public function readByEmailOrName(RestRequest $request);

    public function create(RestRequest $request);

    public function update(RestRequest $request);

    public function delete(RestRequest $request);

    public function readLinkedFriend(RestRequest $request);

    public function readByPostcomment(RestRequest $request);
}
