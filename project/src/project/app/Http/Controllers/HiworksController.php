<?php


namespace App\Http\Controllers;


use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Requests\RestRequests\UserRestRequest;
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

        $access_token = $token["access_token"];
        $refresh_token = $token["refresh_token"];
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/user/v2/me';
        $hiworks_user = $this->service->getHiworksUser($access_token, $uri)->json();

        $user_request = new UserRestRequest;
        $user_request->email = $hiworks_user["user_id"] . "@gabia.com";
        $user = $this->userService->get($user_request);

        if (is_null($user)) {
            $user_request = new UserRestRequest;
            $user_request->email = $hiworks_user["user_id"] . "@gabia.com";
            $user_request->name = $hiworks_user["name"];
            $user_request->is_hiworks = true;
            $user_request->password = 0;
            $owner_id = $this->userService->post($user_request);

            $hiworks_auth_request = new HiworksAuthRestRequest;
            $hiworks_auth_request->user_no = $hiworks_user["no"];
            $hiworks_auth_request->owner_id = $owner_id;
            $hiworks_auth_request->office_no = $token["office_no"];
            $hiworks_auth_request->user_id = $hiworks_user["user_id"];
            $hiworks_auth_request->user_name = $hiworks_user["name"];
            $hiworks_auth_request->access_token = $access_token;
            $hiworks_auth_request->refresh_token = $refresh_token;
            $this->hiworksAuthService->post($hiworks_auth_request);
        } else {
            $hiworks_auth_request = new HiworksAuthRestRequest;
            $hiworks_auth_request->access_token = $access_token;
            $hiworks_auth_request->refresh_token = $refresh_token;
            $this->hiworksAuthService->patch($hiworks_auth_request);
        }
        //TODO : 수정 해야함, 에러를 던지도록 해야함
        //TODO : 비밀번호랑 아이디 검증 하는거 수정해봐야함
        if (!$token = Auth::guard('api')->attempt(['email' => $hiworks_user["user_id"] . "@gabia.com" , 'password' => null])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return view('hiworks', ["data" => json_encode(["type" => "hiworks_auth", "data" => $this->respondWithToken($token)])]);
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
