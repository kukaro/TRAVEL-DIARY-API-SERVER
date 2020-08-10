<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserRepository
{
    public function read(string $email);

    public function readByEmailOrName(
        string $email,
        string $name
    );

    public function create(
        string $email,
        string $name,
        ?int $age,
        ?string $birth_date,
        string $password,
        bool $is_hiworks,
        ?string $created_date,
        ?string $updated_date
    );

    public function update(
        ?string $email,
        ?string $name,
        ?int $age,
        ?string $birth_date,
        ?string $password
    );

    public function delete(string $email);

    public function readLinkedFriend(array $wheres);

    public function readByPostcomment(int $id);
}
