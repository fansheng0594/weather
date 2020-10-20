<?php

/*
 * This file is part of the fan/weather.
 *
 * (c) fansheng <fansheng0594@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fan\Weather;

use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/weather.php' => config_path('weather.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(Weather::class, function () {
            return new Weather(config('weather.api_key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}
