<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface HiworksAuthRepository
{
    public function read(int $user_no);

    public function create(
        int $user_no,
        int $owner_id,
        int $office_no,
        string $user_id,
        string $user_name,
        string $access_token,
        string $refresh_token
    );

    public function update(
        int $user_no,
        string $access_token,
        string $refresh_token
    );
}
