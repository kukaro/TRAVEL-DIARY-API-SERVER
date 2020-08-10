<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\PictureDto;
use App\Http\Repositories\Interfaces\PictureRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Picture;
use Illuminate\Support\Facades\DB;

class PictureRepositoryImpl implements PictureRepository
{
    public function read(int $id)
    {
        $data = Picture::where('id', $id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PictureDto(intval($data['id']),
                $data['owner_id'],
                $data['location'],
                $data['path'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readWithUser(array $wheres)
    {
        $ret = [];
        $datas = Picture::join('user', 'user.id', '=', 'picture.owner_id');
        foreach ($wheres as $where) {
            $datas = $datas->where($where->getColumn(), $where->getOp(), $where->getValue());
        };
        $datas = $datas->select('picture.id as id',
            'owner_id',
            'location',
            'path',
            'picture.created_date as created_date',
            'picture.updated_date as updated_date'
        )->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new PictureDto(intval($data['id']),
                    $data['owner_id'],
                    $data['location'],
                    $data['path'],
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
        string $location,
        string $path
    )
    {
        $data = new Picture();
        $data->owner_id = $owner_id;
        $data->location = $location;
        $data->path = $path;
        $data->save();
        $data = $data->id;
        return $data;
    }

    public function update(
        int $id,
        int $owner_id,
        ?string $location,
        ?string $path,
        ?string $created_date,
        ?string $updated_date
    )
    {
        $arr = [
            'id' => $id,
            'owner_id' => $owner_id,
            'location' => $location,
            'path' => $path,
            'created_date' => $created_date,
            'updated_date' => $updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Picture::where('id', $id)->update($arr);
        return $data;
    }

    public function delete(int $id)
    {
        $data = Picture::where('id', $id)->delete();
        return $data;
    }
}
