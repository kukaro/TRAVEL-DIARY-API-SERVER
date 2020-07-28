<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\UserService;
use App\Http\Repositories\Repository;

class UserServiceImpl implements UserService
{

    private $repository;

    /**
     * Class constructor.
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function get(RestRequest $request)
    {
        $data = $this->repository->read($request);
        return $data;
    }

    public function post(RestRequest $request)
    {
        $data = $this->repository->create($request);
        return $data;
    }

    public function patch(RestRequest $request){
        $data = $this->repository->update($request);
        return $data;
    }

    public function delete(RestRequest $request){
        $data = $this->repository->delete($request);
        return $data;
    }

    public function put(RestRequest $request){
    }
}
