<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithOptionalClass;
use Faker\Factory as Faker;

class ValidWithOptionalClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ClassFactory(
            ValidWithOptionalClass::class,
            [
                'id' => $faker->randomNumber(),
                'optional' => $faker->optional()->name,
                'createdAt' => $faker->dateTime,
            ]
        );
    }
}
