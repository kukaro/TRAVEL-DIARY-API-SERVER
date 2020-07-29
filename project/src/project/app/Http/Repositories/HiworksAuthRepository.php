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
                $data['owner_email'],
                $data['office_no'],
                $data['user_id'],
                $data['user_name'],
            );
        }
        return $data;
    }

    public function create(RestRequest $request)
    {
        $data = new HiworksAuth();
        $data->user_no = $request->user_no;
        $data->owner_email = $request->owner_email;
        $data->office_no = $request->office_no;
        $data->user_id = $request->user_id;
        $data->user_name = $request->user_name;
        $data->save();
        return $data->user_no;
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
