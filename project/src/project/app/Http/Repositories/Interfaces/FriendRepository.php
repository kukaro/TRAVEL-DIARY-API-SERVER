<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface FriendRepository
{
    public function read(array $wheres);

    public function create(
        int $owner_id,
        int $friend_id
    );
}
