<?php

namespace App\Policies;

use App\Http\Dto\Where;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class GeneralPolicy
 * 일반적인 상황에서의 Policy를 적용합니다.
 * @package App\Policies
 */
class GeneralPolicy
{
    private RestRequest $request;
    use HandlesAuthorization;


    public function __construct(RestRequest $request)
    {
        $this->request = $request;
    }

    /**
     * 일반적인 상황에서의 Policy를 지정합니다.
     * @param User $user
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function general(User $user)
    {
        $request = app()->make(RestRequest::class);
        array_push($request->wheres, new Where('owner_id', '=', $user->id));
        return true;
    }

    /**
     * 일반적인 상황에서 post controller를 사용할 때 적용합니다.
     * @param User $user
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function general_post(User $user)
    {
        $request = app()->make(RestRequest::class);
        array_push($request->wheres, new Where('post.owner_id', '=', $user->id));
        return true;
    }
}
