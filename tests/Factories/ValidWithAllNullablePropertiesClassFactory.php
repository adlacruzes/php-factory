<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithAllNullablePropertiesClass;

/**
 * @method static ValidWithAllNullablePropertiesClass create(array $values = null)
 * @method static ValidWithAllNullablePropertiesClass createNullable(array $values = null)
 * @method static ValidWithAllNullablePropertiesClass[] createArray(int $n = 1, array $values = null)
 */
class ValidWithAllNullablePropertiesClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidWithAllNullablePropertiesClass::class,
            [
                'a' => 1,
                'b' => 'b',
                'c' => true,
                'd' => '1970-01-01 00:00:00',
            ]
        );
    }
}
