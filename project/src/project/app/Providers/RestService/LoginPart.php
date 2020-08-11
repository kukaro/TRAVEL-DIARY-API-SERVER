<?php

namespace App\Providers\RestService;

use App\Http\Controllers\JWTAuthController;
use App\Http\Repositories\Classes\UserRepositoryImpl;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\HiworksAuthRestRequest;
use App\Http\Services\Classes\UserServiceImpl;
use App\Http\Services\Interfaces\UserService;

class LoginPart{
    static function run()
    {
        app()->singleton(UserRestRequest::class, function () {
            return new UserRestRequest();
        });

        app()->singleton(UserService::class, function () {
            return new UserServiceImpl(new UserRepositoryImpl());
        });

        app()->singleton(JWTAuthController::class, function () {
            return new JWTAuthController(
                app()->make(UserService::class),
                app()->make(UserRestRequest::class),
            );
        });
    }

    static function mainRun(){
    }
}
