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
use Illuminate\Support\Facades\Validator;

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

        $token = $this->service->getToken($request)->json()["data"];

        $access_token = $token["access_token"];
        $refresh_token = $token["refresh_token"];
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/user/v2/me';
        $user = $this->service->getHiworksUser($access_token, $uri)->json();

        //TODO 여기서 부터 수정해야함
        //이거 하이웍스 인증이랑 테이블이 안맞음
        $user_request = new UserRestRequest;
        $user_request->email = $user["user_id"] . "@gabia.com";
        $user = $this->userService->get($user_request);

        $hiworks_request = new HiworksAuthRestRequest;
        $hiworks_request->user_no = $token["user_no"];

        $data = $this->hiworksAuthService->get($hiworks_request);
        dd($data);
        if (is_null($user)) {
            $user_request = new UserRestRequest;
            $user_request->email = $request->owner_email;
            $user_request->name = $request->user_name;
            $user_request->is_hiworks = true;
            $user_request->password = 0;
            $this->userService->post($user_request);
            $data = $this->hiworksAuthService->post($request);
        } else {
            $this->hiworksAuthService->patch($request);
        }
        if (!$token = Auth::guard('api')->attempt(['email' => $request->owner_email, 'password' => null])) {
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
