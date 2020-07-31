<?php

namespace App\Http\Repositories;

use App\Http\Dto\UserDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = User::where('email', $request->email)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new UserDto($data['email'],
                $data['name'],
                intval($data['age']),
                $data['birth_date'],
                $data['password'],
                $data['is_hiworks'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readByEmailOrName(RestRequest $request)
    {
        $ret = [];
        $datas = User::where('email', 'like', "%" . $request->email . "%")->orWhere('name', 'like', "%" . $request->name . "%")->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new UserDto($data['email'],
                    $data['name'],
                    intval($data['age']),
                    $data['birth_date'],
                    '********',
                    $data['is_hiworks'],
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
        $data = new User();
        $data->email = $request->email;
        $data->name = $request->name;
        $data->age = intval($request->age);
        $data->birth_date = $request->birth_date;
        $data->password = $request->password;
        $data->is_hiworks = $request->is_hiworks;
        $data->save();
        return $data->email;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'email' => $request->email,
            'name' => $request->name,
            'age' => intval($request->age),
            'birth_date' => $request->birth_date,
            'password' => $request->password,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = User::where('email', $request->email)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = User::where('email', $request->email)->delete();
        return $data;
    }

    public function readLinkedFriend(RestRequest $request)
    {
        $ret = [];
        $datas = User::join('friend', 'friend.friend_email', '=', 'user.email');
        foreach ($request->wheres as $where) {
            $datas = $datas->where($where->getColumn(), $where->getOp(), $where->getValue());
        }
        $datas = $datas->select('friend.friend_email as email',
            'name',
            'age',
            'birth_date',
            'password',
            'is_hiworks',
            'created_date',
            'updated_date'
        )->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new UserDto($data['email'],
                    $data['name'],
                    intval($data['age']),
                    $data['birth_date'],
                    $data['password'],
                    $data['is_hiworks'],
                    $data['created_date'],
                    $data['updated_date']
                );
                array_push($ret, $data);
            }
        }
        return $ret;
    }
}
