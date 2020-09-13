<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\MissingConstructorClass;

class MissingConstructorClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            MissingConstructorClass::class,
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
