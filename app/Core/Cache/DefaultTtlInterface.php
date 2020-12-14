<?php

declare(strict_types = 1);

namespace App\Core\Cache;

interface DefaultTtlInterface
{
    public function getDefaultTtl(): int;
}
