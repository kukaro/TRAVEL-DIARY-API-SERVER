<?php

namespace App\Http\Repositories\Classes;

use App\Http\Dto\PictureDto;
use App\Http\Repositories\Interfaces\PictureRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Picture;
use Illuminate\Support\Facades\DB;

class PictureRepositoryImpl implements PictureRepository
{
    public function read(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->get();
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

    public function readWithPicture(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->get();
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

    public function readWithUser(RestRequest $request)
    {
        $ret = [];
        $datas = Picture::join('user', 'user.id', '=', 'picture.owner_id');
        foreach ($request->wheres as $where) {
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

    public function create(RestRequest $request)
    {
        $data = new Picture();
        $data->owner_id = $request->owner_id;
        $data->location = $request->location;
        $data->path = $request->path;
        $data->save();
        $data = $data->id;
        return $data;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'id' => $request->id,
            'owner_id' => $request->owner_id,
            'location' => $request->location,
            'path' => $request->path,
            'created_date' => $request->created_date,
            'updated_date' => $request->updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Picture::where('id', $request->id)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->delete();
        return $data;
    }
}
