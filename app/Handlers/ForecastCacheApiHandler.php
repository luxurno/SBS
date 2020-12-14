<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\API\WeatherApiClient;
use App\Cache\WeatherApiCache;

class ForecastCacheApiHandler extends ApiHandler
{
    private WeatherApiCache $weatherApiCache;
    private WeatherApiClient $weatherApiClient;

    public function __construct(
        WeatherApiCache $weatherApiCache,
        WeatherApiClient $weatherApiClient,
        ?ApiHandler $successor = null
    )
    {
        $this->weatherApiCache = $weatherApiCache;
        $this->weatherApiClient = $weatherApiClient;

        parent::__construct($successor);
    }

    protected function processing(array $query): ?array
    {
        if (array_key_exists('q', $query)) {
            return $this->weatherApiCache->findWeather($query['q']);
        }

        return null;
    }

}
