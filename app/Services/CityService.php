<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repository\Eloquent\CityRepository;
use Illuminate\Support\Collection;

class CityService
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCities(): Collection
    {
        return $this->cityRepository->all();
    }
}
