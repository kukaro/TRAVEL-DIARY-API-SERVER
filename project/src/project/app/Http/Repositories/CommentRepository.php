<?php
namespace App\Http\Repositories;

use App\Http\Dto\CommentDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Comment;

class CommentRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = Comment::where('id', $request->id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new CommentDto(intval($data['id']),
                $data['owner_email'],
                $data['contents'],
                $data['parents_comment_id'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function create(RestRequest $request)
    {
        $data = null;
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
