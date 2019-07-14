<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Tests\Classes\MissingParameterClass;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Faker\Factory as Faker;

class MissingParameterClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ClassFactory(
            MissingParameterClass::class,
            [
                'id' => $faker->randomNumber(),
                'optional' => $faker->optional()->name,
            ]
        );
    }
}
