<?php


namespace App\Http\Controllers;


use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Interfaces\HiworksAuthService;
use App\Http\Services\Interfaces\UserService;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HiworksController extends Controller
{
    public HiworksAuthService $hiworksAuthService;
    public UserService $userService;

    public function __construct(
        HiworksAuthService $hiworksAuthService,
        UserService $userService)
    {
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
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/open/auth/accesstoken';
        $client_id = Config::get('hiworks.client_id');
        $client_secret = Config::get('hiworks.client_secret');
        $auth_code = $request->query('auth_code');
        $data = Http::asForm()->post("$uri", [
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "grant_type" => "authorization_code",
            "auth_code" => $auth_code,
            "access_type" => "offline"
        ]);
        $request = new HiworksAuthRestRequest;
        $data = $data->json()["data"];
        $access_token = $data["access_token"];
        $request->office_no = $data["office_no"];
        $request->user_no = $data["user_no"];
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/user/v2/me';
        $data = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token,
            "Content-Type" => "application/json",
        ])->get("$uri");
        $request->owner_email = $data["user_id"] . "@gabia.com";
        $request->user_id = $data["user_id"];
        $request->user_name = $data["name"];

        $data = $this->hiworksAuthService->get($request);
        if (is_null($data)) {
            $user_request = new UserRestRequest;
            $user_request->email = $request->owner_email;
            $user_request->name = $request->user_name;
            $user_request->is_hiworks = true;
            $user_request->password = 0;
            $this->userService->post($user_request);
            $data = $this->hiworksAuthService->post($request);
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
