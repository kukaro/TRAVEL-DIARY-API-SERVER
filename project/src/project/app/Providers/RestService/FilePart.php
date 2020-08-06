<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\FileController;
use App\Http\Repositories\Classes\FileRepositoryImpl;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\FileRestRequest;
use App\Http\Services\Classes\FileServiceImpl;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Support\ServiceProvider;

class FilePart
{
    static function run()
    {

        app()->singleton(FileService::class, function () {
            return new FileServiceImpl();
        });

        app()->singleton(FileController::class, function () {
            return new FileController(app()->make(FileService::class));
        });
    }

    static function mainRun()
    {
    }
}
