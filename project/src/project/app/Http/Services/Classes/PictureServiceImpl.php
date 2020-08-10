<?php

namespace App\Http\Services\Classes;

use App\Http\Services\Interfaces\PictureService;
use App\Http\Repositories\Interfaces\PictureRepository;

class PictureServiceImpl implements PictureService
{

    private PictureRepository $repository;

    /**
     * Class constructor.
     * @param PictureRepository $repository
     */
    public function __construct(PictureRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $id)
    {
        $data = $this->repository->read($id);
        return $data;
    }

    public function getWithUser(array $wheres)
    {
        $data = $this->repository->readWithUser($wheres);
        return $data;
    }

    public function post(
        int $owner_id,
        string $location,
        string $path
    )
    {
        $data = $this->repository->create(
            $owner_id,
            $location,
            $path
        );
        return $data;
    }

    public function patch(
        int $id,
        int $owner_id,
        ?string $location,
        ?string $path,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $data = $this->repository->update(
            $id,
            $owner_id,
            $location,
            $path,
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
}
