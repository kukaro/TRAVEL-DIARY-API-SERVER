<?php

namespace App\Http\Services\Classes;

use App\Http\Dto\UserDto;
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

    public function get(string $email): UserDto
    {
        $data = $this->repository->read($email);
        return $data;
    }

    public function getByEmailOrName(
        string $email,
        string $name
    )
    {
        $data = $this->repository->readByEmailOrName(
            $email,
            $name
        );
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

    public function patch(
        ?string $email,
        ?string $name,
        ?int $age,
        ?string $birth_date,
        ?string $password
    )
    {
        $data = $this->repository->update(
            $email,
            $name,
            $age,
            $birth_date,
            $password
        );
        return $data;
    }

    public function delete(string $email)
    {
        $data = $this->repository->delete($email);
        return $data;
    }

    public function getLinkedFriend(array $wheres)
    {
        $data = $this->repository->readLinkedFriend($wheres);
        return $data;
    }

    public function getByPostComment(int $id)
    {
        $data = $this->repository->readByPostComment($id);
        return $data;
    }
}
