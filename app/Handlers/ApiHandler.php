<?php

declare(strict_types = 1);

namespace App\Handlers;

abstract class ApiHandler
{
    private ?ApiHandler $successor;

    public function __construct(?ApiHandler $handler = null)
    {
        $this->successor = $handler;
    }

    final public function handle(array $query): ?array
    {
        $processed = $this->processing($query);

        if ($processed === null && $this->successor !== null) {
            $processed = $this->successor->handle($query);
        }

        return $processed;
    }

    abstract protected function processing(array $query): ?array;
}
