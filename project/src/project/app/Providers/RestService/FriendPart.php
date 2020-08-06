<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\FriendController;
use App\Http\Repositories\Classes\FriendRepositoryImpl;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\FriendRestRequest;
use App\Http\Services\Classes\FriendServiceImpl;
use App\Http\Services\Interfaces\FriendService;
use Illuminate\Support\ServiceProvider;

class FriendPart{
    static function run()
    {
        app()->singleton(FriendRestRequest::class, function () {
            return new FriendRestRequest();
        });

        app()->singleton(FriendService::class, function () {
            return new FriendServiceImpl(new FriendRepositoryImpl());
        });

        app()->singleton(FriendController::class, function () {
            return new FriendController(app()->make(FriendService::class), app()->make(FriendRestRequest::class));
        });

    }

    static function mainRun(){
        app()->singleton(RestRequest::class, function () {
            return app()->make(FriendRestRequest::class);
        });
    }
}
