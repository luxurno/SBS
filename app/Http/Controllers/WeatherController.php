<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\API\Exception\BadResponseException;
use App\Services\WeatherService;
use Illuminate\Http\Response;
use Psr\Log\InvalidArgumentException;

class WeatherController extends Controller
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeatherByCity(string $name): Response
    {
        $response = new Response();

        try {
            $weathers = $this->weatherService->getWeathersByCity($name);
            $response->setStatusCode(Response::HTTP_OK);
            $response->setContent(json_encode($weathers->toArray()));
        } catch (InvalidArgumentException $e) {
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
        } catch (BadResponseException $e) {
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        return $response;
    }
}
