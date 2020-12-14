<?php

declare(strict_types = 1);

namespace App\API\Method;

use PHPUnit\Framework\Assert;
use InvalidArgumentException;

class ForecastRequestMethod implements MethodInterface
{
    private const ENDPOINT = 'forecast?q=%s';

    public function getEndpoint(array $params = []): string
    {
        $this->validate($params);

        return sprintf(
            self::ENDPOINT,
            $params['q'],
        );
    }

    public function validate(array $params): void
    {
        try {
            Assert::arrayHasKey('q');
        } catch (\AssertionError $e) {
            var_dump(get_class($e));die;
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function getMethod(): string
    {
        return 'GET';
    }

}
