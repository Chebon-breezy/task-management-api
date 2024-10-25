<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Set the database presence verifier
        $this->app->validator->setPresenceVerifier(
            $this->app['db.presence_verifier']
        );
    }
}
