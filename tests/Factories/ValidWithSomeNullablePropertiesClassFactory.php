<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithSomeNullablePropertiesClass;

/**
 * @method static ValidWithSomeNullablePropertiesClass create(array $values = null)
 * @method static ValidWithSomeNullablePropertiesClass createNullable(array $values = null)
 * @method static ValidWithSomeNullablePropertiesClass[] createArray(int $n = 1, array $values = null)
 */
class ValidWithSomeNullablePropertiesClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidWithSomeNullablePropertiesClass::class,
            [
                'a' => 1,
                'b' => 'b',
                'c' => true,
                'd' => '1970-01-01 00:00:00',
            ]
        );
    }
}
