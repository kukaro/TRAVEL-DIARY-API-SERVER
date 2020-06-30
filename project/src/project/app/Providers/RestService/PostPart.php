<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Repositories\PostRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\PostRestRequest;
use App\Http\Services\Classes\PostServiceImpl;
use App\Http\Services\Interfaces\PostService;
use Illuminate\Support\ServiceProvider;

class PostPart{
    static function run()
    {
        app()->bind(PostRestRequest::class, function () {
            return new PostRestRequest();
        });
    
        app()->bind(PostService::class, function () {
            return new PostServiceImpl(new PostRepository());
        });
    
        app()->bind(PostController::class, function () {
            return new PostController(app()->make(PostService::class), app()->make(PostRestRequest::class));
        });
    
    }
}
