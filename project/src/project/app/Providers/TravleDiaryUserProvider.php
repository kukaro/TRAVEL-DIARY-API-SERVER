<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class TravleDiaryUserProvider extends EloquentUserProvider
{
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        if ($user->is_hiworks == 0) {
            return $plain == $user->getAuthPassword();
        } else {
            return $user->is_hiworks == 1 && is_null($plain);
        }
    }
}
