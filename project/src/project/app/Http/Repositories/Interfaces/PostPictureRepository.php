<?php

namespace App\Http\Repositories\Interfaces;

interface PostPictureRepository
{
    public function read(int $id);

    public function create(
        int $picture_id,
        int $post_id
    );
}
