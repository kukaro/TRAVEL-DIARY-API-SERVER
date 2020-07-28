<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\HiworksAuthController;
use App\Http\Repositories\HiworksAuthRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Services\Classes\HiworksAuthServiceImpl;
use App\Http\Services\Interfaces\HiworksAuthService;
use Illuminate\Support\ServiceProvider;

class HiworksAuthPart{
    static function run()
    {
        app()->singleton(HiworksAuthRestRequest::class, function () {
            return new HiworksAuthRestRequest();
        });

        app()->singleton(RestRequest::class, function () {
            return app()->make(HiworksAuthRestRequest::class);
        });

        app()->singleton(HiworksAuthService::class, function () {
            return new HiworksAuthServiceImpl(new HiworksAuthRepository());
        });

        app()->singleton(HiworksAuthController::class, function () {
            return new HiworksAuthController(app()->make(HiworksAuthService::class), app()->make(HiworksAuthRestRequest::class));
        });

    }
}
