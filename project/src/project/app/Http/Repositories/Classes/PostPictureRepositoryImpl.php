<?php
namespace App\Http\Repositories\Classes;

use App\Http\Dto\PostPictureDto;
use App\Http\Repositories\Interfaces\PostPictureRepository;
use App\Model\PostPicture;

class PostPictureRepositoryImpl implements PostPictureRepository
{
    public function read(int $id)
    {
        $data = PostPicture::where('id', $id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PostPictureDto(intval($data['id']),
                intval($data['post_id']),
                intval($data['picture_id'])
            );
        }
        return $data;
    }

    public function create(
        int $picture_id,
        int $post_id
    )
    {
        $data = new PostPicture();
        $data->picture_id = $picture_id;
        $data->post_id = $post_id;
        $data->save();
        $data = $data->id;
        return $data;
    }
}
