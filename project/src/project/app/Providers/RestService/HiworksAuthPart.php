<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\HiworksAuthController;
use App\Http\Repositories\HiworksAuthRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Services\Classes\HiworksAuthServiceImpl;
use App\Http\Services\Interfaces\HiworksAuthService;
use Illuminate\Support\ServiceProvider;

class HiworksAuthPart{
    static function run()
    {
        app()->singleton(HiworksAuthRestRequest::class, function () {
            return new HiworksAuthRestRequest();
        });

        app()->singleton(HiworksAuthService::class, function () {
            return new HiworksAuthServiceImpl(new HiworksAuthRepository());
        });

        app()->singleton(HiworksAuthController::class, function () {
            return new HiworksAuthController(app()->make(HiworksAuthService::class), app()->make(HiworksAuthRestRequest::class));
        });

    static function mainRun(){
        app()->singleton(RestRequest::class, function () {
            return app()->make(HiworksAuthRestRequest::class);
        });
    }
}
