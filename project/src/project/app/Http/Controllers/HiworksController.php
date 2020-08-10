<?php


namespace App\Http\Controllers;


use App\Exceptions\HiworksAuthenticateFailException;
use App\Exceptions\LoginFailException;
use App\Exceptions\TokenRequestIsInvalidRequest;
use App\Http\Services\Interfaces\HiworksAuthService;
use app\http\services\interfaces\HiworksService;
use App\Http\Services\Interfaces\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class HiworksController extends Controller
{
    public HiworksService $service;
    public HiworksAuthService $hiworksAuthService;
    public UserService $userService;

    /**
     * HiworksController constructor.
     * @param HiworksService $service
     * @param HiworksAuthService $hiworksAuthService
     * @param UserService $userService
     */
    public function __construct(
        HiworksService $service,
        HiworksAuthService $hiworksAuthService,
        UserService $userService)
    {
        $this->service = $service;
        $this->hiworksAuthService = $hiworksAuthService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request)
    {
        $uri = Config::get('hiworks.hiworks_auth_uri') . '/open/auth/authform';
        $client_id = Config::get('hiworks.client_id');
        return Http::get("$uri?client_id=$client_id&access_type=offline");
    }

    /**
     * hiworks 인증의 토큰을 제작합니다.
     * @param Request $request
     * @return Application|Factory|View
     * @throws LoginFailException|TokenRequestIsInvalidRequest
     */
    public function callback(Request $request)
    {
        $token_request = $this->service->getToken($request->query('auth_code'));
        if(!$token_request->json()){
            throw new TokenRequestIsInvalidRequest();
        }
        $token = $token_request->json()["data"];

        $hiworks_user = $this->service->getHiworksUser(
            $token["access_token"],
            Config::get('hiworks.hiworks_auth_uri') . '/user/v2/me'
        )->json();
        if($hiworks_user["code"]=="ERR"){
            throw new HiworksAuthenticateFailException();
        }

        $user = $this->userService->get($hiworks_user["user_id"] . "@gabia.com");

        $token = $this->service->callback(
            $token,
            $hiworks_user,
            $user
        );
        if ($token) {
            return view('hiworks', ["data" => json_encode(["type" => "hiworks_auth", "data" => $this->respondWithToken($token)])]);
        } else {
            throw new LoginFailException($hiworks_user["user_id"] . "@gabia.com");
        }
    }

    /**
     * 최종적으로 front에 전송될 토큰을 제작합니다.
     * @param $token
     * @return array
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ];
    }
}
