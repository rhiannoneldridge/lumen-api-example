<?php

namespace App\Providers;

use App\Models\User;

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
        /** @var \Illuminate\Support\Facades\Auth $auth */
        $auth = $this->app['auth'];

        $auth->viaRequest('api', function ($request) {
            /** @var \Illuminate\Http\Request $request */

            if ($request->input('api_token')) {
                return User::query()
                    ->where('api_token', $request->input('api_token'))
                    ->first();
            }
        });
    }
}
