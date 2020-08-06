<?php

namespace App\Providers\RestService;

<<<<<<< HEAD
use App\Http\Controllers\FileController;
use App\Http\Services\Classes\FileServiceImpl;
use App\Http\Services\Interfaces\FileService;
=======
use Illuminate\Foundation\Application;
use App\Http\Controllers\FileController;
use App\Http\Repositories\Classes\FileRepositoryImpl;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\FileRestRequest;
use App\Http\Services\Classes\FileServiceImpl;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Support\ServiceProvider;
>>>>>>> aecac00919e0d5b2d265a1eb17398c0f5ad3d0a2

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
