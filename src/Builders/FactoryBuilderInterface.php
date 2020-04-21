<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Builders;

interface FactoryBuilderInterface
{
    public function check(): void;

    /**
     * @return mixed
     */
    public function create();
}
