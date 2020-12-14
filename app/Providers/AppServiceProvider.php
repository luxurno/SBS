<?php

namespace App\Providers;

use App\API\ApiClient;
use App\API\ApiClientInterface;
use App\API\Method\ForecastRequestMethod;
use App\API\Method\MethodInterface;
use App\API\WeatherApiClient;
use App\Cache\WeatherApiCache;
use App\Core\Cache\DefaultTtlInterface;
use App\Core\Cache\RedisClient;
use App\Handlers\ForecastCacheApiHandler;
use App\Handlers\Responsible\ForecastApiHandler;
use App\VO\AbstractVOModel;
use App\VO\SerializableInterface;
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


        $this->app->bind(ApiClientInterface::class, ApiClient::class);
        $this->app->bind(MethodInterface::class, ForecastRequestMethod::class);
        $this->app->bind(DefaultTtlInterface::class, RedisClient::class);
        $this->app->bind(SerializableInterface::class, AbstractVOModel::class);

        $this->app->bind(ForecastApiHandler::class, function ($app) {
            return new ForecastApiHandler(
                $app->make(WeatherApiCache::class),
                $app->make(WeatherApiClient::class),
                null
            );
        });
        $this->app->bind(ForecastCacheApiHandler::class, function ($app) {
            return new ForecastCacheApiHandler(
                $app->make(WeatherApiCache::class),
                $app->make(WeatherApiClient::class),
                $app->make(ForecastApiHandler::class),
            );
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
