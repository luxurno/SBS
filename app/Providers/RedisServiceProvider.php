<?php

declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Redis\RedisServiceProvider as SourceRedisServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class RedisServiceProvider
 * @package App\Providers
 */
class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->withFacades();
        $this->app->withEloquent();
        $this->app->register(SourceRedisServiceProvider::class);
        $this->app->configure('database');
    }
}
