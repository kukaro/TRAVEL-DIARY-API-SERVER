<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserService
{
    public function get(RestRequest $request);

    public function post(RestRequest $request);

    public function patch(RestRequest $request);

    public function delete(RestRequest $request);

    public function put(RestRequest $request);

    public function getLinkedFriend(RestRequest $request);

    public function getByEmailOrName(RestRequest $request);

    public function getByPostComment(RestRequest $request);
}
