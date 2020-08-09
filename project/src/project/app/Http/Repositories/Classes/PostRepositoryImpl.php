<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\PostDto;
use App\Http\Repositories\Interfaces\PostRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Post;
use Illuminate\Support\Facades\DB;

class PostRepositoryImpl implements PostRepository
{
    public function read(int $id)
    {
        $data = Post::where('id', $id)->get();
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

    public function readWithPicture(int $id)
    {
        $ret = [];
        $datas = Post::join('post_picture', 'post_picture.post_id', '=', 'post.id')
            ->join('picture', 'picture.id', '=', 'picture_id')
            ->where('picture.id', $id)
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

    public function create(
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id
    )
    {
        $data = new Post();
        $data->owner_id = $owner_id;
        $data->title = $title;
        $data->contents = $contents;
        $data->parents_post_id = $parents_post_id;
        $data->save();
        $data = $data->id;
        return $data;
    }

    public function update(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $arr = [
            'id' => $id,
            'owner_id' => $owner_id,
            'title' => $title,
            'contents' => $contents,
            'parents_post_id' => $parents_post_id,
            'created_date' => $created_date,
            'updated_date' => $updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Post::where('id', $id)->update($arr);
        return $data;
    }

    public function delete(int $id)
    {
        $data = Post::where('id', $id)->delete();
        return $data;
    }

    /*
     * TODO : POST와 USER를 JOIN을 하긴했는데 POST에 USER정보를 넣어야할지 말아야할지 솔직히 고민이다. 나중에 엄청 중요해질거 같으니까 일단은 POSTDTO에는 USERDTO를 않넣고(개념상은 필요없음)진행하자.
     */
    public function readWithUser(array $wheres)
    {
        $ret = [];
        $datas = Post::join('user', 'user.id', '=', 'post.owner_id');
        foreach ($wheres as $where) {
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
