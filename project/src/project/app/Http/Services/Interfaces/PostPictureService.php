<?php

namespace App\Http\Services\Interfaces;

interface PostPictureService
{
    public function get(int $id);

    public function post(
        int $picture_id,
        int $post_id
    );
}
