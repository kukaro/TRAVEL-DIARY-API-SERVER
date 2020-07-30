<?php

namespace App\Http\Repositories;

use App\Http\Dto\FriendDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Friend;

class FriendRepository implements Repository
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
                    $data['owner_email'],
                    $data['friend_email'],
                );
                array_push($ret, $data);
            }
        }
        return $ret;
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
