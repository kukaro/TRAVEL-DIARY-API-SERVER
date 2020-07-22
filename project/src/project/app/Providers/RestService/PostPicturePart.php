<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\PostPictureController;
use App\Http\Repositories\PostPictureRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\PostPictureRestRequest;
use App\Http\Services\Classes\PostPictureServiceImpl;
use App\Http\Services\Interfaces\PostPictureService;
use Illuminate\Support\ServiceProvider;

class PostPicturePart{
    static function run()
    {
        app()->singleton(PostPictureRestRequest::class, function () {
            return new PostPictureRestRequest();
        });

        app()->singleton(RestRequest::class, function () {
            return app()->make(PostPictureRestRequest::class);
        });

        app()->singleton(PostPictureService::class, function () {
            return new PostPictureServiceImpl(new PostPictureRepository());
        });

        app()->singleton(PostPictureController::class, function () {
            return new PostPictureController(app()->make(PostPictureService::class), app()->make(PostPictureRestRequest::class));
        });

    }
}
