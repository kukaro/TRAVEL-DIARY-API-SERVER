<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FriendService;
use App\Http\Repositories\Interfaces\FriendRepository;

class FriendServiceImpl implements FriendService
{

    private FriendRepository $repository;

    /**
     * Class constructor.
     * @param FriendRepository $repository
     */
    public function __construct(FriendRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(array $wheres)
    {
        $data = $this->repository->read($wheres);
        return $data;
    }

    public function post(
        int $owner_id,
        int $friend_id
    )
    {
        $data = $this->repository->create(
            $owner_id,
            $friend_id
        );
        return $data;
    }
}
