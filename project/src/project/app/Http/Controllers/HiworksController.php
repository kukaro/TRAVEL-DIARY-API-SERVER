<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HiworksController extends Controller
{
    public function get(Request $request)
    {
        $uri = Config::get('hiworks.hiworks_oath_uri') . '/authform';
        $client_id = Config::get('hiworks.client_id');
        return Http::get("$uri?client_id=$client_id&access_type=offline");
    }

    public function callback(Request $request)
    {
        $uri = Config::get('hiworks.hiworks_oath_uri') . '/accesstoken';
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
        $data = [
            "data"=>$data->json(),
            "type"=>'hiworks_auth',
        ];
        return view('hiworks', ["data" => json_encode($data)]);
    }
}
