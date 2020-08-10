<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface FriendService
{
    public function get(array $wheres);

    public function post(
        int $owner_id,
        int $friend_id
    );
}
