<?php
namespace App\Http\Repositories\Classes;

use App\Http\Dto\PostPictureDto;
use App\Http\Repositories\Interfaces\PostPictureRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\PostPicture;
use Illuminate\Support\Facades\DB;

class PostPictureRepositoryImpl implements PostPictureRepository
{
    public function read(RestRequest $request)
    {
        $data = PostPicture::where('id', $request->id)->get();
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

    public function create(RestRequest $request)
    {
        DB::beginTransaction();
        $data = new PostPicture();
        $data->picture_id = $request->picture_id;
        $data->post_id = $request->post_id;
        $data->save();
        $data = DB::select('select last_insert_id() as id')[0];
        DB::commit();
        return $data;
    }

    public function update(RestRequest $request)
    {
        $data = null;
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = null;
        return $data;
    }
}
