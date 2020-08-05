<?php

namespace App\Providers;

use App\Model\Post;
use App\Model\User;
use App\Policies\GeneralPolicy;
use App\Policies\PrimaryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => GeneralPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('travlediaryuser', function ($app, array $config) {
            return new TravleDiaryUserProvider($app['hash'], $config['model']);
        });
    }
}
