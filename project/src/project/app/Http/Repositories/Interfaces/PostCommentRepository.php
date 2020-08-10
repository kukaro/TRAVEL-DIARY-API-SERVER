<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostCommentRepository
{
    public function read(int $id);

    public function readWithPost(
        int $id,
        array $wheres
    );

    public function create(
        int $owner_id,
        int $post_id,
        string $contents,
        ?int $parents_comment_id
    );
}
