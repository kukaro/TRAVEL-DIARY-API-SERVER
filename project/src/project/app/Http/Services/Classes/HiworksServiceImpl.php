<?php


namespace App\Http\Services\Classes;


use App\Http\Repositories\Interfaces\HiworksAuthRepository;
use App\Http\Repositories\Interfaces\UserRepository;
use App\Http\Services\Interfaces\HiworksService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HiworksServiceImpl implements HiworksService
{
    private UserRepository $userRepository;
    private HiworksAuthRepository $hiworksAuthRepository;

    public function __construct(
        UserRepository $userRepository,
        HiworksAuthRepository $hiworksAuthRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->hiworksAuthRepository = $hiworksAuthRepository;
    }

    public function getToken(string $auth_code): Response
    {
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/open/auth/accesstoken';
        $client_id = Config::get('hiworks.client_id');
        $client_secret = Config::get('hiworks.client_secret');

        return Http::asForm()->post("$uri", [
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "grant_type" => "authorization_code",
            "auth_code" => $auth_code,
            "access_type" => "offline"
        ]);
    }

    public function getHiworksUser($access_token, $uri): Response
    {
        return Http::withHeaders([
            "Authorization" => "Bearer " . $access_token,
            "Content-Type" => "application/json",
        ])->get("$uri");
    }

    public function callback(
        array $token,
        array $hiworks_user,
        $user
    ): ?string
    {
        DB::beginTransaction();
        $access_token = $token["access_token"];
        $refresh_token = $token["refresh_token"];
        if (is_null($user)) {
            $owner_id = $this->userRepository->create(
                $hiworks_user["user_id"] . "@gabia.com",
                $hiworks_user["name"],
                null,
                null,
                0,
                true,
                null,
                null
            );
            $this->hiworksAuthRepository->create($hiworks_user["no"],
                $owner_id,
                $token["office_no"],
                $hiworks_user["user_id"],
                $hiworks_user["name"],
                $access_token,
                $refresh_token
            );
        } else {
            $this->hiworksAuthRepository->update(
                $hiworks_user["no"],
                $access_token,
                $refresh_token
            );
        }
        DB::commit();
        if (!$token = Auth::guard('api')->attempt(['email' => $hiworks_user["user_id"] . "@gabia.com", 'password' => null])) {
            return null;
        }
        return $token;
    }
}
