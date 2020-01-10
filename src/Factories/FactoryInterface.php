<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Factories;

interface FactoryInterface
{
    /**
     * @return array<mixed>
     */
    public function get(): array;
}
