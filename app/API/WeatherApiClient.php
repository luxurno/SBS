<?php

declare(strict_types = 1);

namespace App\API;

use App\API\Exception\BadResponseException;
use App\API\Method\ForecastRequestMethod;
use App\Cache\WeatherApiCache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WeatherApiClient extends ApiClient
{
    private Client $client;
    private WeatherApiCache $weatherApiCache;
    protected static string $uri = 'http://api.openweathermap.org/data/2.5/%s&appid=%s';
    protected static string $token = 'fbce7343b4026095f2f32738a42b1bce';

    public function __construct(
        Client $client,
        WeatherApiCache $weatherApiCache
    )
    {
        $this->client = $client;
        $this->weatherApiCache = $weatherApiCache;
    }

    public function forecast(array $query): ?string
    {
        $method = new ForecastRequestMethod();
        $endpoint = $method->getEndpoint($query);

        try {
            $response = $this->client->request(
                $method->getMethod(),
                $this->getEndpoint($endpoint),
            );
        } catch (GuzzleException $e) {
            var_dump($e->getMessage());
            var_dump($e->getCode());
            return null;
        }

        if ($response->getStatusCode() !== 200) {
            var_dump($response->getStatusCode());
            var_dump($response->getBody());
            die;
            throw new BadResponseException('City not found');
        }

        return $response->getBody()->getContents();
    }

    public function getEndpoint(string $endpoint): string
    {
        return sprintf(
            self::$uri,
            $endpoint,
            self::$token,
        );
    }
}
