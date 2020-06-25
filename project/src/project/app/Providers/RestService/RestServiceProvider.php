<?php

namespace App\Providers\RestService;

use App\Http\Controllers\UserController;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Services\Classes\UserServiceImpl;
use App\Http\Services\Interfaces\UserService;
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
        UserPart::run();
        PicturePart::run();

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
        //     "__construct" => true
        // ];
        // $controller_methods = (new \ReflectionClass(UserController::class))->getMethods();
        // foreach ($controller_methods as $method) {
        //     // echo $method;
        //     $method_name = $method->name;
        //     if (!array_key_exists($method_name, $ignore_methods)) {
        //         $this->app->call([$this->app->make(UserController::class), $method_name], [$this->app->make(UserRestRequest::class)]);
        //     }
        // }
        //END METHODS INJECTION

        $this->app->resolving(function ($obj, $app) {
            if ($obj instanceof RestRequest) {
                $obj->req_method = $app->request->method();
                $obj->req_query = $app->request->query();
                $obj->req_url = $app->request->url();
                $obj->req_path = $app->request->path();
                $obj->req_param = $app->request->route()->parameters();
                $obj->req_body = $app->request->input();
                foreach ($obj->req_param as $key => $value) {
                    if (isset($key, $obj)) {
                        $obj->$key = $value;
                    }
                }
                foreach ($obj->req_query as $key => $value) {
                    if (isset($key, $obj)) {
                        $obj->$key = $value;
                    }
                }
                foreach ($obj->req_body as $key => $value) {
                    if (isset($key, $obj)) {
                        $obj->$key = $value;
                    }
                }
            }
        });
    }
}
