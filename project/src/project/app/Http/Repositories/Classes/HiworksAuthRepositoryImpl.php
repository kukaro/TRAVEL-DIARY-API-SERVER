<?php
namespace App\Http\Repositories\Classes;

use App\Http\Dto\HiworksAuthDto;
use App\Http\Repositories\Interfaces\HiworksAuthRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\HiworksAuth;

class HiworksAuthRepositoryImpl implements HiworksAuthRepository
{
    public function read(int $user_no)
    {
        $data = HiworksAuth::where('user_no', $user_no)->get();
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

    public function create(
        int $user_no,
        int $owner_id,
        int $office_no,
        string $user_id,
        string $user_name,
        string $access_token,
        string $refresh_token
    )
    {
        $data = new HiworksAuth();
        $data->user_no = $user_no;
        $data->owner_id = $owner_id;
        $data->office_no = $office_no;
        $data->user_id = $user_id;
        $data->user_name = $user_name;
        $data->access_token = $access_token;
        $data->refresh_token = $refresh_token;
        $data->save();
        return $data->user_no;
    }

    public function update(
        int $user_no,
        string $access_token,
        string $refresh_token
    )
    {
        $arr = [
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = HiworksAuth::where('user_no', $user_no)->update($arr);
        return $data;
    }
}
