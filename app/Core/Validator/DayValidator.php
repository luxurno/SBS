<?php

declare(strict_types = 1);

namespace App\Core\Validator;

class DayValidator
{
    private const DAY = '09:00:00';

    public function validate(string $day): bool
    {
        return strpos($day, self::DAY) !== false;
    }
}
