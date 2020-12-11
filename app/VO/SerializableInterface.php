<?php

declare(strict_types = 1);

namespace App\VO;

use JsonSerializable;

interface SerializableInterface extends JsonSerializable
{
    public function toArray();
}
