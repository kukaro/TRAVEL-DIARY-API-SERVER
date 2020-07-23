<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\PictureController;
use App\Http\Repositories\PictureRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\PictureRestRequest;
use App\Http\Services\Classes\PictureServiceImpl;
use App\Http\Services\Interfaces\PictureService;
use Illuminate\Support\ServiceProvider;

class PicturePart{
    static function run()
    {
        app()->singleton(PictureRestRequest::class, function () {
            return new PictureRestRequest();
        });

        app()->singleton(PictureService::class, function () {
            return new PictureServiceImpl(new PictureRepository());
        });

        app()->singleton(PictureController::class, function () {
            return new PictureController(app()->make(PictureService::class), app()->make(PictureRestRequest::class));
        });

    }
}
