<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Classes\UserServiceImpl;
use App\Http\Services\Interfaces\UserService;
use Illuminate\Support\ServiceProvider;

class UserPart{
    static function run()
    {
        app()->bind(UserRestRequest::class, function () {
            return new UserRestRequest();
        });
    
        app()->bind(UserService::class, function () {
            return new UserServiceImpl(new UserRepository());
        });
    
        app()->bind(UserController::class, function () {
            return new UserController(app()->make(UserService::class), app()->make(UserRestRequest::class));
        });
    
    }
}
