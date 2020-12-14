<?php

declare(strict_types = 1);

namespace App\API;

interface ApiClientInterface
{
    public function getEndpoint(string $endpoint): string;
}
