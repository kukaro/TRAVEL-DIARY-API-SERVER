<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostService;
use App\Http\Repositories\Interfaces\PostRepository;

class PostServiceImpl implements PostService
{

    private PostRepository $repository;

    /**
     * Class constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(RestRequest $request)
    {
        $data = $this->repository->read($request);
        return $data;
    }

    public function getWithPicture(RestRequest $request)
    {
        $data = $this->repository->readWithPicture($request);
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
        $data = null;
        return $data;
    }

    public function getWithUser(RestRequest $request)
    {
        $data = $this->repository->readWithUser($request);
        return $data;
    }
}
