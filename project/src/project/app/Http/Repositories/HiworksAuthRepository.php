<?php
namespace App\Http\Repositories;

use App\Http\Dto\HiworksAuthDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\HiworksAuth;
<<<<<<< HEAD
use App\Model\Post;
use Illuminate\Support\Facades\DB;
=======
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b

class HiworksAuthRepository implements Repository
{
    public function read(RestRequest $request)
    {
<<<<<<< HEAD
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
=======
        $data = null;
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
        return $data;
    }

    public function create(RestRequest $request)
    {
<<<<<<< HEAD
        $data = new HiworksAuth();
        $data->user_no = $request->user_no;
        $data->owner_email = $request->owner_email;
        $data->office_no = $request->office_no;
        $data->user_id = $request->user_id;
        $data->user_name = $request->user_name;
        $data->save();
        return $data->user_no;
=======
        $data = null;
        return $data;
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
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
