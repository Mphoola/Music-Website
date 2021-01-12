<?php

namespace App\Providers;

use App\Services\AdvertManager;
use Illuminate\Support\ServiceProvider;

class AdvertServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('advert_manager', function() {
            return new AdvertManager();
        });
    }

    public function provides()
    {
        return ['advert_manager'];
    }
}
