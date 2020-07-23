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
        $hiworks_oauth_uri = Config::get('hiworks.hiworks_oath_uri');
        $client_id = Config::get('hiworks.client_id');
        return Http::get("$hiworks_oauth_uri?client_id=$client_id&access_type=offline");
    }

    public function callback(Request $request)
    {
        dump($request);
        return response()->json(['message'=>'true']);
    }
}
