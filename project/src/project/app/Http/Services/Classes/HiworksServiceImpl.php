<?php


namespace App\Http\Services\Classes;


use App\Http\Services\Interfaces\HiworksService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class HiworksServiceImpl implements HiworksService
{

    public function getToken(Request $request): Response
    {
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/open/auth/accesstoken';
        $client_id = Config::get('hiworks.client_id');
        $client_secret = Config::get('hiworks.client_secret');
        $auth_code = $request->query('auth_code');
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
            "Content-ErrorType" => "application/json",
        ])->get("$uri");
    }
}
