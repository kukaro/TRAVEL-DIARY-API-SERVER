<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\PostCommentDto;
use App\Http\Repositories\Interfaces\PostCommentRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\PostComment;
use Illuminate\Support\Facades\DB;

class PostCommentRepositoryImpl implements PostCommentRepository
{
    public function read($id)
    {
        $data = PostComment::where('id', $id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PostCommentDto(intval($data['id']),
                $data['owner_id'],
                $data['post_id'],
                $data['contents'],
                $data['parents_comment_id'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readWithPost(
        int $id,
        array $wheres
    )
    {
        $ret = [];
        $datas = PostComment::join('post', 'post.id', '=', 'postcomment.post_id')
            ->where('post.id', $id);
        foreach ($wheres as $where) {
            $datas = $datas->where('post.' . $where->getColumn(), $where->getOp(), $where->getValue());
        }
        $datas = $datas->
        select('postcomment.id as id',
            'postcomment.owner_id as owner_id',
            'post_id',
            'postcomment.contents as contents',
            'parents_comment_id',
            'post.created_date as created_date',
            'post.updated_date as updated_date'
        )->get();
        if (count($datas) == 0) {
            $datas = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new PostCommentDto(intval($data['id']),
                    $data['owner_id'],
                    $data['post_id'],
                    $data['contents'],
                    $data['parents_comment_id'],
                    $data['created_date'],
                    $data['updated_date']
                );
                array_push($ret, $data);
            }
        }
        return $ret;
    }

    public function create(
        int $owner_id,
        int $post_id,
        string $contents,
        ?int $parents_comment_id
    )
    {
        $data = new PostComment();
        $data->owner_id = $owner_id;
        $data->post_id = $post_id;
        $data->contents = $contents;
        $data->parents_comment_id = $parents_comment_id;
        $data->save();
        $data = $data->id;
        return ["id" => $data];
    }
}
