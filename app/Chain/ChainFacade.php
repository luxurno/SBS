<?php

declare(strict_types = 1);

namespace App\Chain;

use App\Handlers\ForecastCacheApiHandler;

class ChainFacade
{
    private ForecastCacheApiHandler $forecastApiChain;

    public function __construct(ForecastCacheApiHandler $forecastApiChain)
    {
        $this->forecastApiChain = $forecastApiChain;
    }

    public function getForecastFor(array $query): ?array
    {
        return $this->forecastApiChain->handle($query);
    }
}
