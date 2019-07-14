<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Factories\ArrayFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Faker\Factory as Faker;

class ArraysFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ArrayFactory(
            [
                'one' => $faker->randomNumber(),
                'two' => $faker->randomNumber(),
                'three' => $faker->randomNumber(),
                'four' => $faker->randomNumber(),
            ]
        );
    }
}
