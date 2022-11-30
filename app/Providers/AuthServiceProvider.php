<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Extensions\RiakUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//
//        Auth::extend('guard_second_driver', function ($app, $name, array $config) {
//            // Return an instance of Illuminate\Contracts\Auth\Guard...
//
//            return new guard_admin(Auth::createUserProvider($config['provider']));
//        });
//        Auth::viaRequest('guard_admin', function ($request) {
//            return Admin::where('token', $request->token)->first();
//        });
//        Auth::provider('guard_admin', function ($app, array $config) {
//            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
//
//            return new RiakUserProvider($app->make('guard_admin.connection'));
//        });
    }
}
