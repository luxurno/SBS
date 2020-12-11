<?php

declare(strict_types = 1);

namespace App\Services;

use App\API\ApiClient;
use App\API\Exception\BadResponseException;
use App\Builder\WeatherBuilder;
use App\Core\Filter\UriFilter;
use App\Models\City;
use App\VO\Collection\WeatherVOCollection;
use Psr\Log\InvalidArgumentException;

class WeatherService
{
    private ApiClient $apiClient;
    private UriFilter $uriFilter;
    private WeatherBuilder $weatherBuilder;

    public function __construct(
        ApiClient $apiClient,
        UriFilter $uriFilter,
        WeatherBuilder $weatherBuilder
    )
    {
        $this->apiClient = $apiClient;
        $this->uriFilter = $uriFilter;
        $this->weatherBuilder = $weatherBuilder;
    }

    public function getWeathersByCity(string $name): WeatherVOCollection
    {
        $name = $this->uriFilter->filter($name);
        $user = City::ofName($name)->get();

        if ($user->all() === []) {
            throw new InvalidArgumentException('City not found');
        }

        try {
            $response = $this->apiClient->forecast($name);
        } catch (BadResponseException $e) {
            throw $e;
        }

        return $this->weatherBuilder->build($response);
    }
}
