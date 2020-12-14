<?php

declare(strict_types = 1);

namespace App\Core\Validator;

use Carbon\Carbon;

class DaysValidator
{
    public function validate(string $date, int $days): bool
    {
        $now = Carbon::now();
        $date = Carbon::parse($date);

        return $days >= $date->diffInDays($now);
    }
}
