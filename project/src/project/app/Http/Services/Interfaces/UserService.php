<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserService
{
    public function get(string $email);

    public function post(
        string $email,
        string $name,
        ?int $age,
        ?string $birth_date,
        string $password,
        bool $is_hiworks,
        ?string $created_date,
        ?string $updated_date
    );

    public function getByEmailOrName(
        string $email,
        string $name
    );

    public function patch(
        ?string $email,
        ?string $name,
        ?int $age,
        ?string $birth_date,
        ?string $password
    );

    public function delete(string $email);

    public function getLinkedFriend(array $wheres);

    public function getByPostComment(int $id);
}
