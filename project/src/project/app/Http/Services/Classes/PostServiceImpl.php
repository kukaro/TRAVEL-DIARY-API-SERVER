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

    public function get(int $id)
    {
        $data = $this->repository->read($id);
        return $data;
    }

    public function getWithPicture(int $id)
    {
        $data = $this->repository->readWithPicture($id);
        return $data;
    }

    public function post(
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id
    )
    {
        $data = $this->repository->create(
            $owner_id,
            $title,
            $contents,
            $parents_post_id
        );
        return $data;
    }

    public function patch(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $data = $this->repository->update(
            $id,
            $owner_id,
            $title,
            $contents,
            $parents_post_id,
            $created_date,
            $updated_date
        );
        return $data;
    }

    public function delete(int $id)
    {
        $data = $this->repository->delete($id);
        return $data;
    }

    public function getWithUser(array $wheres)
    {
        $data = $this->repository->readWithUser($wheres);
        return $data;
    }
}
