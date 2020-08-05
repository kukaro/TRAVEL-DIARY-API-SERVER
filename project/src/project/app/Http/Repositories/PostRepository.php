<?php

namespace App\Http\Repositories;

use App\Http\Dto\PostDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Post;
use Illuminate\Support\Facades\DB;

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
                $data['owner_id'],
                $data['title'],
                $data['contents'],
                $data['parents_post_id'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readWithPicture(RestRequest $request)
    {
        $ret = [];
        $datas = Post::join('post_picture', 'post_picture.post_id', '=', 'post.id')
            ->join('picture', 'picture.id', '=', 'picture_id')
            ->where('picture.id', $request->id)
            ->select('post.id as id',
                'post.owner_id as owner_id',
                'title',
                'contents',
                'parents_post_id',
                'post.created_date as created_date',
                'post.updated_date as updated_date'
            )->get();
        if (count($datas) == 0) {
            $datas = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new PostDto(intval($data['id']),
                    $data['owner_id'],
                    $data['title'],
                    $data['contents'],
                    $data['parents_post_id'],
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
        $data = new Post();
        $data->id = $request->id;
        $data->owner_id = $request->owner_id;
        $data->title = $request->title;
        $data->contents = $request->contents;
        $data->parents_post_id = $request->parents_post_id;
        $data->save();
        $data = DB::select('select last_insert_id() as id')[0];
        DB::commit();
        return $data;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'id' => $request->id,
            'owner_id' => $request->owner_id,
            'title' => $request->title,
            'contents' => $request->contents,
            'parents_post_id' => $request->parents_post_id,
            'created_date' => $request->created_date,
            'updated_date' => $request->updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Post::where('id', $request->id)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = Post::where('id', $request->id)->delete();
        return $data;
    }

    /*
     * TODO : POST와 USER를 JOIN을 하긴했는데 POST에 USER정보를 넣어야할지 말아야할지 솔직히 고민이다. 나중에 엄청 중요해질거 같으니까 일단은 POSTDTO에는 USERDTO를 않넣고(개념상은 필요없음)진행하자.
     */
    public function readWithUser(RestRequest $request)
    {
        $ret = [];
        $datas = Post::join('user', 'user.id', '=', 'post.owner_id');
        foreach ($request->wheres as $where) {
            $datas = $datas->where($where->getColumn(), $where->getOp(), $where->getValue());
        }
        $datas = $datas->
        select('post.id as id',
            'owner_id',
            'title',
            'contents',
            'parents_post_id',
            'post.created_date as created_date',
            'post.updated_date as updated_date'
        )->get();
        if (count($datas) == 0) {
            $datas = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new PostDto(intval($data['id']),
                    $data['owner_id'],
                    $data['title'],
                    $data['contents'],
                    $data['parents_post_id'],
                    $data['created_date'],
                    $data['updated_date']
                );
                array_push($ret, $data);
            }
        }
        return $ret;
    }
}
