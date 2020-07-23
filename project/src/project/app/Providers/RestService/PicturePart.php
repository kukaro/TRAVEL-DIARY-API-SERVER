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

<<<<<<< HEAD
=======
        app()->singleton(RestRequest::class, function () {
            return app()->make(PictureRestRequest::class);
        });

>>>>>>> e3c8c3abded93730156ac298312eddd5411b63da
        app()->singleton(PictureService::class, function () {
            return new PictureServiceImpl(new PictureRepository());
        });

        app()->singleton(PictureController::class, function () {
            return new PictureController(app()->make(PictureService::class), app()->make(PictureRestRequest::class));
        });

    }
}
