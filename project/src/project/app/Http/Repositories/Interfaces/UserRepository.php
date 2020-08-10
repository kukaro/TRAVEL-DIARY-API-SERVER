<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserRepository
{
    public function read(RestRequest $request);

    public function readByEmailOrName(RestRequest $request);

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

    public function update(RestRequest $request);

    public function delete(RestRequest $request);

    public function readLinkedFriend(RestRequest $request);

    public function readByPostcomment(RestRequest $request);
}
