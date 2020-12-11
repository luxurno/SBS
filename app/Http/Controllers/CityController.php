<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\CityService;
use Illuminate\Http\Response;

class CityController extends Controller
{
    protected CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function getCities(): Response
    {
        $cities = $this->cityService->getCities();
        $cities = json_encode($cities);

        return new Response($cities);
    }
}
