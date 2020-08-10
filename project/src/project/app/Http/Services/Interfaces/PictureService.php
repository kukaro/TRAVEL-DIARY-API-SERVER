<?php

namespace App\Http\Services\Interfaces;

interface PictureService
{
    public function get(int $id);

    public function getWithUser(array $wheres);

    public function post(
        int $owner_id,
        string $location,
        string $path
    );

    public function patch(
        int $id,
        int $owner_id,
        ?string $location,
        ?string $path,
        ?string $created_date,
        ?string $updated_date
    );

    public function delete(int $id);

}
