<?php

namespace App\Providers\RestService;

use App\Http\Repositories\Classes\FileRepositoryImpl;
use App\Http\Services\Interfaces\FileService;
use App\Http\Controllers\PictureController;
use App\Http\Repositories\Classes\PictureRepositoryImpl;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\PictureRestRequest;
use App\Http\Services\Classes\PictureServiceImpl;
use App\Http\Services\Interfaces\PictureService;

class PicturePart
{
    static function run()
    {
        FilePart::run();

        app()->singleton(PictureRestRequest::class, function () {
            return new PictureRestRequest();
        });

        app()->singleton(PictureService::class, function () {
            return new PictureServiceImpl(
                new PictureRepositoryImpl(),
                new FileRepositoryImpl()
            );
        });

        app()->singleton(PictureController::class, function () {
            return new PictureController(
                app()->make(PictureService::class),
                app()->make(FileService::class),
                app()->make(PictureRestRequest::class)
            );
        });
    }

    static function mainRun()
    {
        app()->singleton(RestRequest::class, function () {
            return app()->make(PictureRestRequest::class);
        });
    }
}
