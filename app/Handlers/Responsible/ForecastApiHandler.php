<?php

declare(strict_types = 1);

namespace App\Handlers\Responsible;

use App\API\Exception\BadResponseException;
use App\API\WeatherApiClient;
use App\Cache\WeatherApiCache;
use App\Handlers\ApiHandler;

class ForecastApiHandler extends ApiHandler
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
        try {
            $response = $this->weatherApiClient->forecast($query);
            $this->weatherApiCache->registerWeather(
                $query['q'],
                $response,
            );
            return json_decode($response, true);
        } catch (BadResponseException $e) {
            return null;
        }
    }
}
