<?php
namespace App\Http\Repositories;

use App\Http\Dto\PostDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Post;

class PostRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = Post::where('id', $request->id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PostDto(intval($data['id']),
                $data['owner_email'],
                $data['title'],
                $data['contents'],
                $data['parents_post_id'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function create(RestRequest $request)
    {
        $data = new Post();
        $data->id = $request->id;
        $data->owner_email = $request->owner_email;
        $data->title = $request->title;
        $data->contents = $request->contents;
        $data->parents_post_id = $request->parents_post_id;
        $data->save();
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
