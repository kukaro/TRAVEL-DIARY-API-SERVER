<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\FriendDto;
use App\Http\Repositories\Interfaces\FriendRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Friend;

class FriendRepositoryImpl implements FriendRepository
{
    public function read(RestRequest $request)
    {
        $ret = [];
        $datas = Friend::class;
        $is_init = false;
        foreach ($request->wheres as $where) {
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

    public function create(RestRequest $request)
    {
        $data = new Friend();
        $data->owner_id = $request->owner_id;
        $data->friend_id = $request->friend_id;
        $data->save();
        $data = $data->id;
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
