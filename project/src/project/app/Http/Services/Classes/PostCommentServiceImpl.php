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

    public function get(int $id)
    {
        $data = $this->repository->read($id);
        return $data;
    }

    public function getWithPost(
        int $id,
        array $wheres
    )
    {
        $data = $this->repository->readWithPost($id, $wheres);
        return $data;
    }

    public function post(
        int $owner_id,
        int $post_id,
        string $contents,
        ?int $parents_comment_id
    )
    {
        $data = $this->repository->create(
            $owner_id,
            $post_id,
            $contents,
            $parents_comment_id
        );
        return $data;
    }
}
