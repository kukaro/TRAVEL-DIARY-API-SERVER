<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

interface HiworksService
{
    public function getToken(Request $request): Response;

    public function getHiworksUser($access_token, $uri): Response;

    public function callback(
        array $token,
        array $hiworks_user,
        $user
    ): ?string;
}
