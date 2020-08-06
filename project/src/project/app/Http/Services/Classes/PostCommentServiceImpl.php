<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostCommentService;
use App\Http\Repositories\Interfaces\PostCommentRepository;

class PostCommentServiceImpl implements PostCommentService
{

    private PostCommentRepository $repository;

    /**
     * Class constructor.
     * @param PostCommentRepository $repository
     */
    public function __construct(PostCommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(RestRequest $request)
    {
        $data = $this->repository->read($request);
        return $data;
    }

    public function getWithPost(RestRequest $request)
    {
        $data = $this->repository->readWithPost($request);
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
}
