<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\UserRestRequest;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;
use App\Model\User;
use App\Http\Repositories\Repositories;

class UserServiceImpl implements UserService
{

    private $repositories;

    /**
     * Class constructor.
     */
    public function __construct(Repositories $repositories)
    {
        $this->repositories = $repositories;
    }

    public function get(RestRequest $request)
    {
        $data = $this->repositories->read($request);
        return $data;
    }

    public function post(RestRequest $request)
    {
        $data = $this->repositories->create($request);
        return $data;
    }

    public function patch(RestRequest $request){
        $data = $this->repositories->update($request);
        return $data;
    }

    public function delete(RestRequest $request){
        $data = $this->repositories->delete($request);
        return $data;
    }

    public function put(RestRequest $request){
    }
}
