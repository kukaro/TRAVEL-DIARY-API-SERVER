<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostService
{
    public function get(int $id);

    public function getWithPicture(int $id);

    public function post(
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id
    );

    public function patch(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        ?string $created_date,
        ?string $updated_date
    );

    public function delete(int $id);

    public function getWithUser(array $wheres);
}
