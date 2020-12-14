<?php

declare(strict_types = 1);

namespace App\Services;

use App\API\WeatherApiClient;
use App\Builder\WeatherBuilder;
use App\Chain\ChainFacade;
use App\Core\Filter\UriFilter;
use App\Models\City;
use App\VO\Collection\WeatherVOCollection;
use Psr\Log\InvalidArgumentException;

class WeatherService
{
    private ChainFacade $chainFacade;
    private UriFilter $uriFilter;
    private WeatherApiClient $weatherApiClient;
    private WeatherBuilder $weatherBuilder;

    public function __construct(
        ChainFacade $chainFacade,
        UriFilter $uriFilter,
        WeatherApiClient $weatherApiClient,
        WeatherBuilder $weatherBuilder
    )
    {
        $this->chainFacade = $chainFacade;
        $this->uriFilter = $uriFilter;
        $this->weatherApiClient = $weatherApiClient;
        $this->weatherBuilder = $weatherBuilder;
    }

    public function getWeathersByCity(string $name): WeatherVOCollection
    {
        $name = $this->uriFilter->filter($name);
        $user = City::ofName($name)->get();

        if ($user->all() === []) {
            throw new InvalidArgumentException('City not found');
        }
        $response = $this->chainFacade->getForecastFor([
            'q' => $name,
        ]);

        return $this->weatherBuilder->build($response);
    }
}
