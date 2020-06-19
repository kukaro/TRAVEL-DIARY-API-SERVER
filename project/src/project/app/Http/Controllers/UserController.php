<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App;
use App\Http\Requests\RestRequests\UserRestRequest;

class UserController extends BaseController
{
    // public function get(Request $request)
    // {
    //     dump($request->query());
    //     $email = $request->query('email');
    //     $user = User::where('email', $email)->get();
    //     $data = count($user) != 0 ? $user[0] : null;
    //     return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    // }

    public function get(UserRestRequest $request)
    {
        dump($request);
        // $val = App()->make("dodo");
        // dump($val);
        // dump($request->query());
        // $email = $request->query('email');
        // $user = User::where('email', $email)->get();
        // $data = count($user) != 0 ? $user[0] : null;
        // return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
        return response()->json(['data'=>$request->url]);
    }
}
