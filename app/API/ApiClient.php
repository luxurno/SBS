<?php

declare(strict_types = 1);

namespace App\API;

abstract class ApiClient implements ApiClientInterface
{
    protected static string $uri = '';
    protected static string $token = '';
}
