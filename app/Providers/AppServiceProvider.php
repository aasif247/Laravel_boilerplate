<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Default String Length
        Schema::defaultStringLength(191);

        // Version Code
        $version = env('app_env') == 'local' || env('app_env') == 'demo' ? time() : config('app.version', '1.0.0');

        // Gives a list of all timezone
        $datetime = new \DateTimeZone("Asia/Dhaka");
        $timezones = $datetime->listIdentifiers();
        $timezone_list = [];
        foreach ($timezones as $timezone)
        {
            $timezone_list[$timezone] = $timezone;
        }

        view()->share(compact('version', 'timezone_list'));
    }
}
