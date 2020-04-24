<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithNullableClass;

/**
 * @method static ValidWithNullableClass create(array $values = null)
 * @method static ValidWithNullableClass createNullable(array $values = null)
 * @method static ValidWithNullableClass[] createArray(int $n = 1, array $values = null)
 */
class ValidWithNullableClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidWithNullableClass::class,
            [
                'a' => 1,
                'b' => 'b',
                'c' => true,
                'd' => '1970-01-01 00:00:00',
            ]
        );
    }
}
