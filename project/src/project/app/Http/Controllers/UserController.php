<?php

namespace App\Http\Controllers;

use App\Model\Picture;
use App\Model\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function get(Request $request)
    {
        $email = $request->query('email');
        return response()->json(['email'=>$email]);
    }
}
