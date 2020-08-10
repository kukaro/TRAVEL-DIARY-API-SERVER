<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface UserService
{
    public function get(RestRequest $request);

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

    public function patch(RestRequest $request);

    public function delete(RestRequest $request);

    public function getLinkedFriend(RestRequest $request);

    public function getByEmailOrName(RestRequest $request);

    public function getByPostComment(RestRequest $request);
}
