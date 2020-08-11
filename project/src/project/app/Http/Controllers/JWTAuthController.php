<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginFailException;
use App\Exceptions\SignupFailException;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JWTAuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {
            new LoginFailException($request->email);
        }

        if (!$token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            new LoginFailException($request->email);
        }

        return $this->respondWithToken($token);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:user',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:1|max:255|confirmed',
            'password_confirmation' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {
            new SignupFailException($request->email);
        }

        $user = $request->all();
        $this->userService->post(
            $user["email"],
            $user["name"],
            null,
            null,
            $user["password"],
            0,
            null,
            null
        );

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function user()
    {
        return response()->json(['data' => Auth::guard('api')->user()]);
    }
}
