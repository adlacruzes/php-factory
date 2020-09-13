<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithOptionalClass;

class ValidWithOptionalClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidWithOptionalClass::class,
            [
                'id' => 42,
                'optional' => 'optional',
                'createdAt' => new \DateTime(),
            ]
        );
    }
}
