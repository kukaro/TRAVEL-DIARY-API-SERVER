<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\HiworksAuthService;
use App\Http\Repositories\Interfaces\HiworksAuthRepository;

class HiworksAuthServiceImpl implements HiworksAuthService
{

    private HiworksAuthRepository $repository;

    /**
     * Class constructor.
     * @param HiworksAuthRepository $repository
     */
    public function __construct(HiworksAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $user_no)
    {
        $data = $this->repository->read($user_no);
        return $data;
    }

    public function post(
        int $user_no,
        int $owner_id,
        int $office_no,
        string $user_id,
        string $user_name,
        string $access_token,
        string $refresh_token
    )
    {
        $data = $this->repository->create(
            $user_no,
            $owner_id,
            $office_no,
            $user_id,
            $user_name,
            $access_token,
            $refresh_token
        );
        return $data;
    }

    public function patch(
        int $user_no,
        string $access_token,
        string $refresh_token
    )
    {
        $data = $this->repository->update(
            $user_no,
            $access_token,
            $refresh_token
        );
        return $data;
    }

}
