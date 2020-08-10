<?php

namespace App\Http\Services\Classes;

use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\PostPictureService;
use App\Http\Repositories\Interfaces\PostPictureRepository;

class PostPictureServiceImpl implements PostPictureService
{

    private PostPictureRepository $repository;

    /**
     * Class constructor.
     * @param PostPictureRepository $repository
     */
    public function __construct(PostPictureRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $id)
    {
        $data = $this->repository->read($id);
        return $data;
    }

    public function post(
        int $picture_id,
        int $post_id
    )
    {
        $data = $this->repository->create(
            $picture_id,
            $post_id
        );
        return $data;
    }
}
