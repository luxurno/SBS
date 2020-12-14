<?php

declare(strict_types = 1);

namespace App\Cache;

use App\Core\Cache\Enum\CacheKeyEnum;
use App\Core\Cache\RedisClient;

class WeatherApiCache
{
    private RedisClient $redisClient;

    public function __construct(RedisClient $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    public function registerWeather(string $city, string $response): void
    {
        $key = sprintf(CacheKeyEnum::WEATHER_KEY, $city);
        $this->redisClient->set(
            $key,
            $response,
            $this->redisClient->getDefaultTtl()
        );
    }

    public function findWeather(string $city): ?array
    {
        $key = sprintf(CacheKeyEnum::WEATHER_KEY, $city);
        $cachedWeather = $this->redisClient->get($key);

        return $cachedWeather ? json_decode($cachedWeather, true) : null;
    }
}
