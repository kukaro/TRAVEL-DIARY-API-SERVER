<?php

namespace App\Providers\RestService;

use App\Http\Controllers\FileController;
use App\Http\Services\Classes\FileServiceImpl;
use App\Http\Services\Interfaces\FileService;

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
