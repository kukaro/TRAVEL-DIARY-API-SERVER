<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;
use App\Http\Repositories\Interfaces\UserRepository;

class UserServiceImpl implements UserService
{

    private UserRepository $repository;

    /**
     * Class constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(RestRequest $request)
    {
        $data = $this->repository->read($request);
        return $data;
    }

    public function post(
        string $email,
        string $name,
        ?int $age,
        ?string $birth_date,
        string $password,
        bool $is_hiworks,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $data = $this->repository->create(
            $email,
            $name,
            $age,
            $birth_date,
            $password,
            $is_hiworks,
            $created_date,
            $updated_date
        );
        return $data;
    }

    public function patch(RestRequest $request)
    {
        $data = $this->repository->update($request);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = $this->repository->delete($request);
        return $data;
    }

    public function getLinkedFriend(RestRequest $request)
    {
        $data = $this->repository->readLinkedFriend($request);
        return $data;
    }

    public function getByEmailOrName(RestRequest $request)
    {
        $data = $this->repository->readByEmailOrName($request);
        return $data;
    }


    public function getByPostComment(RestRequest $request)
    {
        $data = $this->repository->readByPostComment($request);
        return $data;
    }
}
