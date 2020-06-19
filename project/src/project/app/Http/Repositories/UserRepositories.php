<?php
namespace App\Http\Repositories;

use App\Http\Dto\UserDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\User;

class UserRepositories implements Repositories
{
    public function get(RestRequest $request)
    {
        $data = User::where('email', $request->email)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new UserDto($data['email'],
                $data['name'],
                $data['age'],
                $data['birth_date'],
                $data['password'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }
}
