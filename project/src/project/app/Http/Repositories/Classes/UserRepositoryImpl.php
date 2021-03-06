<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\UserDto;
use App\Http\Repositories\Interfaces\UserRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\User;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl implements UserRepository
{
    public function read(string $email)
    {
        $data = User::where('email', $email)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new UserDto(
                $data['id'],
                $data['email'],
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

    public function readByEmailOrName(
        string $email,
        string $name
    )
    {
        $ret = [];
        $datas = User::where('email', 'like', "%" . $email . "%")->orWhere('name', 'like', "%" . $name . "%")->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new UserDto(
                    $data['id'],
                    $data['email'],
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

    public function create(
        string $email,
        string $name,
        ?int $age,
        ?string $birth_date,
        string $password,
        bool $is_hiworks,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $data = new User();
        $data->email = $email;
        $data->name = $name;
        $data->age = intval($age);
        $data->birth_date = $birth_date;
        $data->password = $password;
        $data->is_hiworks = $is_hiworks;
        $data->save();
        $data = $data->id;
        return $data;
    }

    public function update(
        ?string $email,
        ?string $name,
        ?int $age,
        ?string $birth_date,
        ?string $password
    )
    {
        $arr = [
            'email' => $email,
            'name' => $name,
            'age' => intval($age),
            'birth_date' => $birth_date,
            'password' => $password,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = User::where('email', $email)->update($arr);
        return $data;
    }

    public function delete(string $email)
    {
        $data = User::where('email', $email)->delete();
        return $data;
    }

    public function readLinkedFriend(array $wheres)
    {
        $ret = [];
        $datas = User::join('friend', 'friend.friend_id', '=', 'user.id');
        foreach ($wheres as $where) {
            $datas = $datas->where($where->getColumn(), $where->getOp(), $where->getValue());
        }
        $datas = $datas->select('friend.friend_id as id',
            'email',
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
                $data = new UserDto(
                    $data['id'],
                    $data['email'],
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

    public function readByPostcomment(
        int $id
    )
    {
        $ret = [];
        $data = User::join('post', 'post.owner_id', '=', 'user.id')
            ->where('post.id', $id)->get();
        if (count($data) != 1) {
            //TODO : Error 던지세요. 권한 없습니다.
        }

        $datas = User::join('postcomment', 'postcomment.owner_id', '=', 'user.id')
            ->where('post_id', $id);

        $datas = $datas->select('user.id as id',
            'email',
            'name',
            'age',
            'birth_date',
            'password',
            'is_hiworks',
            'user.created_date as created_date',
            'user.updated_date as updated_date'
        )->distinct('id')
            ->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new UserDto(
                    $data['id'],
                    $data['email'],
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
