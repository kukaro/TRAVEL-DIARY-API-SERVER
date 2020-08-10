<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface PictureService
{
    public function get(int $id);

    public function getWithUser(array $wheres);

    public function post(
        int $owner_id,
        string $location,
        string $path,
        UploadedFile $file
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
