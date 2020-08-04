<?php
namespace App\Http\Repositories;

use App\Http\Dto\HiworksAuthDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\HiworksAuth;
use App\Model\Post;
use Illuminate\Support\Facades\DB;

class HiworksAuthRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = HiworksAuth::where('user_no', $request->user_no)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new HiworksAuthDto($data['user_no'],
                $data['owner_id'],
                $data['office_no'],
                $data['user_id'],
                $data['user_name'],
            null,
            null,
            );
        }
        return $data;
    }

    public function create(RestRequest $request)
    {
        $data = new HiworksAuth();
        $data->user_no = $request->user_no;
        $data->owner_id = $request->owner_id;
        $data->office_no = $request->office_no;
        $data->user_id = $request->user_id;
        $data->user_name = $request->user_name;
        $data->access_token = $request->access_token;
        $data->refresh_token = $request->refresh_token;
        $data->save();
        return $data->user_no;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'user_no' => $request->user_no,
            'owner_id' => $request->owner_id,
            'office_no' => $request->office_no,
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'access_token' => $request->access_token,
            'refresh_token' => $request->refresh_token,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = HiworksAuth::where('user_no', $request->user_no)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = null;
        return $data;
    }
}
