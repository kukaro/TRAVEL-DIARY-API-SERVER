<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostRepository
{
    public function read(int $id);

    public function readWithPicture(int $id);

    public function create(
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id
    );

    public function update(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        ?string $created_date,
        ?string $updated_date
    );

    public function delete(int $id);

    public function readWithUser(array $wheres);
}
