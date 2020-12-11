<?php

declare(strict_types = 1);

namespace App\Core\Filter;

class UriFilter
{
    public function filter(string $string): string
    {
        return rawurlencode(strtolower($string));
    }
}
