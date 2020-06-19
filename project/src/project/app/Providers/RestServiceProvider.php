<?php

namespace App\Providers;

use App\Http\Controllers\UserController;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;
use App\Http\Services\Classes\UserServiceImpl;
use App\Http\Repositories\UserRepositories;
use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserService::class, function () {
            return new UserServiceImpl();
        });

        $this->app->bind(UserService::class, function () {
            return new UserServiceImpl(new UserRepositories());
        });

        // $this->app->bind(UserController::class, function () {
        //     return new UserController($this->app->make(UserService::class));
        // });

        // $this->app->bind(RestRequest::class, function ($app) {
        //     return new UserRestRequest();
        // });

        //BEGIN METHODS INJECTION
        // $ignore_methods = [
        //     "middleware" => true,
        //     "getMiddleware" => true,
        //     "callAction" => true,
        //     "__call" => true,
        // ];
        // $controller_methods = (new ReflectionClass(UserController::class))->getMethods();
        // foreach ($controller_methods as $method) {
        //     $method_name = $method->name;
        //     if (!array_key_exists($method_name, $ignore_methods)) {
        //         $this->app->call([$this->app->make(UserController::class), $method_name], [$this->app->make(\App\Http\Requests\RestRequests\RestRequest::class)]);
        //     }
        // }
        //END METHODS INJECTION

        $this->app->resolving(function ($obj, $app) {
            if ($obj instanceof RestRequest) {
                $obj->method = $app->request->method();
                $obj->query = $app->request->query();
                $obj->url = $app->request->url();
                $obj->path = $app->request->path();
                $obj->param = $app->request->route()->parameters();
                foreach ($obj->param as $key => $value) {
                    if (isset($key, $obj)) {
                        $obj->$key = $value;
                    }
                }
                foreach ($obj->query as $key => $value) {
                    if (isset($key, $obj)) {
                        $obj->$key = $value;
                    }
                }
            }
        });
    }
}
