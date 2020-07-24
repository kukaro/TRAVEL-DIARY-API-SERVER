<?php

namespace App\Providers\RestService;

use App\Http\Requests\RestRequests\RestRequest;
use App\Util\Name;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
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

    }

    //TODO : 예외 나중에 config같은데 빼야함

    /**
     * 클래스를 동적으로 로딩합니다. 그래서 네이밍 룰에 맞지 않을경우 에러가 날 수있습니다.
     *
     * @return void
     */
    public function boot()
    {
        $exception_list = ["file" => "file", "login" => "login", "hiworks" => "hiworks", "signup"=>"signup"];
        $api = explode("/", request()->path())[1];
        if (!array_key_exists($api, $exception_list)) {
            $classname = "App\\Providers\\RestService\\" . Name::kebabToPascal($api) . "Part";
            $classname::run();
        }

        $this->app->resolving(function ($obj, $app) {
            if ($obj instanceof RestRequest) {
                $obj->req_method = $app->request->method();
                $obj->req_query = $app->request->query();
                $obj->req_url = $app->request->url();
                $obj->req_path = $app->request->path();
                $obj->req_param = [];
                $obj->wheres = [];
                if ($app->request->route()) {
                    $obj->req_param = $app->request->route()->parameters();
                }
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
