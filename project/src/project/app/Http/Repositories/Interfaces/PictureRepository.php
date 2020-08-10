<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PictureRepository
{
    public function read(int $id);

    public function readWithUser(array $wheres);

    public function create(
        int $owner_id,
        string $location,
        string $path
    );

    public function update(
        int $id,
        int $owner_id,
        ?string $location,
        ?string $path,
        ?string $created_date,
        ?string $updated_date
    );

    public function delete(int $id);
}
