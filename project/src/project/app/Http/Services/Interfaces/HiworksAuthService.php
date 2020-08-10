<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface HiworksAuthService
{
    public function get(int $user_no);

    public function post(
        int $user_no,
        int $owner_id,
        int $office_no,
        string $user_id,
        string $user_name,
        string $access_token,
        string $refresh_token
    );

    public function patch(
        int $user_no,
        string $access_token,
        string $refresh_token
    );
}
