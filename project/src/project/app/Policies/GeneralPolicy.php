<?php

namespace App\Policies;

use App\Http\Dto\Where;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralPolicy
{
    private RestRequest $request;
    use HandlesAuthorization;


    public function __construct(RestRequest $request)
    {
        //
        $this->request = $request;
    }

    public function general(User $user)
    {
        $request = app()->make(RestRequest::class);
        array_push($request->wheres, new Where('owner_email', '=', $user->email));
        return true;
    }
}
