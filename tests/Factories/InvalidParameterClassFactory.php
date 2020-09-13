<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\InvalidParameterClass;

class InvalidParameterClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            InvalidParameterClass::class,
            [
                'uuid' => false,
                'id' => 42,
                'optional' => 'optional',
                'something' => 'nevermind',
                'createdAt' => new \DateTime(),
            ]
        );
    }
}
