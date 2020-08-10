<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\FriendDto;
use App\Http\Repositories\Interfaces\FriendRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Friend;

class FriendRepositoryImpl implements FriendRepository
{
    public function read(array $wheres)
    {
        $ret = [];
        $datas = Friend::class;
        $is_init = false;
        foreach ($wheres as $where) {
            if ($is_init) {
                $datas = $datas->where($where->getColumn(), $where->getOp(), $where->getValue());
            } else {
                $datas = $datas::where($where->getColumn(), $where->getOp(), $where->getValue());
                $is_init = true;
            }
        }
        $datas = $datas->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new FriendDto(intval($data['id']),
                    $data['owner_id'],
                    $data['friend_id'],
                );
                array_push($ret, $data);
            }
        }
        return $ret;
    }

    public function create(
        int $owner_id,
        int $friend_id
    )
    {
        $data = new Friend();
        $data->owner_id = $owner_id;
        $data->friend_id = $friend_id;
        $data->save();
        $data = $data->id;
        return $data;
    }

}
