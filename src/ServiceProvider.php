<?php

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/zibal.php' => config_path('zibal.php'),
        ]);
    }

    public function register(): void
    {

    }
}
