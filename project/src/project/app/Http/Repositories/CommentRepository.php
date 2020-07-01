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
        $data = new Comment();
        $data->id = $request->id;
        $data->owner_email = $request->owner_email;
        $data->contents = $request->contents;
        $data->parents_comment_id = $request->parents_comment_id;
        $data->save();
        return $data;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'id' => $request->id,
            'owner_email' => $request->owner_email,
            'contents' => $request->contents,
            'parents_comment_id' => $request->parents_comment_id,
            'created_date' => $request->created_date,
            'updated_date' => $request->updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Comment::where('id', $request->id)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = Comment::where('id', $request->id)->delete();
        return $data;
    }
}
