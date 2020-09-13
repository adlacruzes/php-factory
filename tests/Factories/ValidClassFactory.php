<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Factories;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Tests\Classes\ValidClass;

/**
 * @method static ValidClass create(array $values = null)
 * @method static ValidClass[] createArray(int $n = 1, array $values = null)
 */
class ValidClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidClass::class,
            [
                'id' => 42,
                'name' => 'name',
                'isEnabled' => true,
                'createdAt' => new \DateTime(),
            ]
        );
    }
}
