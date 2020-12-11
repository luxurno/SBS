<?php

declare(strict_types = 1);

namespace App\API;

use App\API\Exception\BadResponseException;
use App\API\Method\ForecastRequestMethod;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private const URI = 'http://api.openweathermap.org/data/2.5/%s&appid=%s';
    private const TOKEN = 'fbce7343b4026095f2f32738a42b1bce';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function forecast(string $name): array
    {
        $method = new ForecastRequestMethod();

        $endpoint = $method->getEndpoint([
            'q' => $name,
        ]);

        $response = $this->client->request(
            $method->getMethod(),
            $this->getEndpoint($endpoint),
        );

        if ($response->getStatusCode() !== 200) {
            throw new BadResponseException('City not found');
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getEndpoint(string $endpoint): string
    {
        return sprintf(
            self::URI,
            $endpoint,
            self::TOKEN,
        );
    }
}
