<?php

namespace App\Http\Repositories;

use App\Http\Dto\FriendDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Friend;
use App\Model\Post;
use App\Util\DB\ErrorType;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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
        try {
            DB::beginTransaction();
            $data = new Friend();
            $data->owner_email = $request->owner_email;
            $data->friend_email = $request->friend_email;
            $data->save();
            $data = DB::select('select last_insert_id() as id')[0];
            DB::commit();
            return $data;
        } catch (\Illuminate\Database\QueryException $e) {
            return new ErrorType($e->getPrevious()->errorInfo[1],
                $e->getPrevious()->errorInfo[0]);
        }
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
