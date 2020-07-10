<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\CommentController;
use App\Http\Repositories\CommentRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\CommentRestRequest;
use App\Http\Services\Classes\CommentServiceImpl;
use App\Http\Services\Interfaces\CommentService;
use Illuminate\Support\ServiceProvider;

class CommentPart{
    static function run()
    {
        app()->bind(CommentRestRequest::class, function () {
            return new CommentRestRequest();
        });
    
        app()->bind(CommentService::class, function () {
            return new CommentServiceImpl(new CommentRepository());
        });
    
        app()->bind(CommentController::class, function () {
            return new CommentController(app()->make(CommentService::class), app()->make(CommentRestRequest::class));
        });
    
    }
}
