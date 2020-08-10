<?php


namespace App\Http\Controllers;


use App\Http\Services\Interfaces\HiworksAuthService;
use app\http\services\interfaces\HiworksService;
use App\Http\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class HiworksController extends Controller
{
    public HiworksService $service;
    public HiworksAuthService $hiworksAuthService;
    public UserService $userService;

    public function __construct(
        HiworksService $service,
        HiworksAuthService $hiworksAuthService,
        UserService $userService)
    {
        $this->service = $service;
        $this->hiworksAuthService = $hiworksAuthService;
        $this->userService = $userService;
    }

    public function get(Request $request)
    {
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/open/auth/authform';
        $client_id = Config::get('hiworks.client_id');
        return Http::get("$uri?client_id=$client_id&access_type=offline");
    }

    public function callback(Request $request)
    {
        $token_request = $this->service->getToken($request);
        $token = $token_request->json()["data"];

        $hiworks_user = $this->service->getHiworksUser(
            $token["access_token"],
            Config::get('hiworks.hiworks_auth_uri') . '/user/v2/me'
        )->json();

        $user = $this->userService->get($hiworks_user["user_id"] . "@gabia.com");

        $token = $this->service->callback(
            $token,
            $hiworks_user,
            $user
        );
        if ($token) {
            return view('hiworks', ["data" => json_encode(["type" => "hiworks_auth", "data" => $this->respondWithToken($token)])]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ];
    }
}
