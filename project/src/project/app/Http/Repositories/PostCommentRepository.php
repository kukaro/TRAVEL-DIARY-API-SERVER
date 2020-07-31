<?php

namespace App\Http\Repositories;

use App\Http\Dto\PostCommentDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\PostComment;
use Illuminate\Support\Facades\DB;
use function Couchbase\defaultDecoder;

class PostCommentRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = PostComment::where('id', $request->id)->get();
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

    public function readWithPost(RestRequest $request)
    {
        $ret = [];
        $datas = PostComment::join('post', 'post.id', '=', 'postcomment.post_id')
            ->where('post.id', $request->id);
        foreach ($request->wheres as $where) {
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

    public function create(RestRequest $request)
    {
        DB::beginTransaction();
        $data = new PostComment();
        $data->owner_id = $request->owner_id;
        $data->post_id = $request->post_id;
        $data->contents = $request->contents;
        $data->parents_comment_id = $request->parents_comment_id;
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
