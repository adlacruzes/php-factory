<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Tests\Classes\InvalidParameterClass;
use Adlacruzes\Factory\Factory;
use Faker\Factory as Faker;

class InvalidParameterClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ClassFactory(
            InvalidParameterClass::class,
            [
                'uuid' => false,
                'id' => $faker->randomNumber(),
                'optional' => $faker->optional()->name,
                'something' => 'nevermind',
                'createdAt' => $faker->dateTime,
            ]
        );
    }
}
