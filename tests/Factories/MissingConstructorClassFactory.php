<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\MissingConstructorClass;
use Faker\Factory as Faker;

class MissingConstructorClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ClassFactory(
            MissingConstructorClass::class,
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
