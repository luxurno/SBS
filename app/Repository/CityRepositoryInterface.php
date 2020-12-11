<?php
namespace App\Repository;

use Illuminate\Support\Collection;

interface CityRepositoryInterface
{
    public function all(): Collection;
}
