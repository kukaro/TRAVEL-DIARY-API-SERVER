<?php

namespace App\Http\Services\Classes;

use App\Http\Dto\PostDto;
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


    /**
     * @param int $id
     * @return PostDto
     */
    public function get(int $id): PostDto
    {
        $data = $this->repository->read($id);
        return $data;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getWithPicture(int $id): array
    {
        $data = $this->repository->readWithPicture($id);
        return $data;
    }

    /**
     * @param int $owner_id
     * @param string $title
     * @param string $contents
     * @param int|null $parents_post_id
     * @return int
     */
    public function post(
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id
    ): int
    {
        $data = $this->repository->create(
            $owner_id,
            $title,
            $contents,
            $parents_post_id
        );
        return $data;
    }

    /**
     * @param int $id
     * @param int $owner_id
     * @param string $title
     * @param string $contents
     * @param int|null $parents_post_id
     * @param string|null $created_date
     * @param string|null $updated_date
     * @return int
     */
    public function patch(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        ?string $created_date,
        ?string $updated_date
    ) :int
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

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        $data = $this->repository->delete($id);
        return $data;
    }

    /**
     * @param array $wheres
     * @return array
     */
    public function getWithUser(array $wheres): array
    {
        $data = $this->repository->readWithUser($wheres);
        return $data;
    }
}
