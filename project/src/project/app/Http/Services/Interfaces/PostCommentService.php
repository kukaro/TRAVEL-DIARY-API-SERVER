<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\RestRequests\RestRequest;

interface PostCommentService
{
    public function get(int $id);

    public function getWithPost(
        int $id,
        array $wheres
    );

    public function post(
        int $owner_id,
        int $post_id,
        string $contents,
        ?int $parents_comment_id
    );
}
