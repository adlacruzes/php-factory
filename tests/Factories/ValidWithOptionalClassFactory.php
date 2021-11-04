<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidWithOptionalClass;

/**
 * @method static ValidWithOptionalClass create(array $values = null)
 * @method static ValidWithOptionalClass[] createArray(int $n = 1, array $values = null)
 */
class ValidWithOptionalClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidWithOptionalClass::class,
            [
                'id' => 42,
                'optional' => 'optional',
                'createdAt' => new \DateTime(),
            ]
        );
    }
}
