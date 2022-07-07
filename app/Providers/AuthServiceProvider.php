<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function (Request $request) {
            if ($request->hasHeader('authorization')) {
                $token = str_replace('Bearer ', '', $request->header('authorization'));
                return User::where('api_token', $token)->first();
            }

            return null;
        });
    }
}
