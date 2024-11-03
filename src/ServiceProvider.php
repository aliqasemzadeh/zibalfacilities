<?php
namespace AliQasemzadeh\ZibalFacilities;

use Illuminate\Support\ServiceProvider;
class ZibalFacilitiesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Config Files
        $this->publishes([
            __DIR__.'/../config/zibal.php' => config_path('zibal.php'),
        ]);

        // Translate Files
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'zibal');
        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/zibal'),
        ]);
    }

    public function register(): void
    {

    }
}
