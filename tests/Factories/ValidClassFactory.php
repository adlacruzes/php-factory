<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Tests\Classes\ValidClass;
use Adlacruzes\Factory\Factory;
use Faker\Factory as Faker;

/**
 * @method static ValidClass create(array $values = null)
 * @method static ValidClass[] createArray(int $n = 1, array $values = null)
 */
class ValidClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        $faker = Faker::create();

        return new ClassFactory(
            ValidClass::class,
            [
                'id' => $faker->randomNumber(),
                'name' => $faker->name,
                'isEnabled' => $faker->boolean,
                'createdAt' => $faker->dateTime,
            ]
        );
    }
}
