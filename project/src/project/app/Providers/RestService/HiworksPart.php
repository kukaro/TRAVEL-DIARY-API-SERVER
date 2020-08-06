<?php

namespace App\Providers\RestService;

use App\Http\Controllers\HiworksAuthController;
use App\Http\Controllers\HiworksController;
use App\Http\Repositories\Classes\HiworksAuthRepositoryImpl;
use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Classes\HiworksAuthServiceImpl;
use App\Http\Services\Classes\HiworksServiceImpl;
use App\Http\Services\Interfaces\HiworksAuthService;
use app\http\services\interfaces\HiworksService;
use App\Model\HiworksAuth;

class HiworksPart
{
    static function run()
    {
        HiworksAuthPart::run();
        UserPart::run();
        app()->singleton(HiworksService::class, function () {
            return new HiworksServiceImpl();
        });
    }

    static function mainRun()
    {

    }
}
