<?php


namespace app\http\services\interfaces;


use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

interface HiworksService
{
    public function getToken(Request $request) : Response;
    public function getHiworksUser($access_token, $uri);
}
