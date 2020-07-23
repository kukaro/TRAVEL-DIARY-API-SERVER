<?php

namespace App\Providers\RestService;

use App\Http\Requests\RestRequests\RestRequest;
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

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        UserPart::run();
        PicturePart::run();
        PostPart::run();
        CommentPart::run();
        PostPicturePart::run();

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
