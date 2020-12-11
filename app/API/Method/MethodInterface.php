<?php

declare(strict_types = 1);

namespace App\API\Method;

interface MethodInterface
{
    public function getEndpoint(array $params = []): string;
    public function validate(array $params): void;
    public function getMethod(): string;
}
