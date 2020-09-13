<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ArrayFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;

class ArraysFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ArrayFactory(
            [
                'one' => 42,
                'two' => 43,
                'three' => 44,
                'four' => 45,
            ]
        );
    }
}
