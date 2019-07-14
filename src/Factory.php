<?php

declare(strict_types=1);

namespace Adlacruzes\Factory;

use Adlacruzes\Factory\Builders\FactoryBuilderInterface;
use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Factories\FactoryInterface;

abstract class Factory
{
    abstract protected static function setFactory(): FactoryInterface;

    /**
     * @param array|null $values
     * @return mixed
     * @throws FactoryException
     * @throws \ReflectionException
     */
    public static function create(array $values = null)
    {
        $factory = (new static())::setFactory();

        $builder = self::getBuilder($factory, $values);

        $builder->check();

        return $builder->build();
    }

    /**
     * @param int $n
     * @param array|null $values
     * @return mixed
     * @throws FactoryException
     * @throws \ReflectionException
     */
    public static function createArray(int $n = 1, array $values = null)
    {
        $array = [];
        for ($i = $n; $i > 0; --$i) {
            $array[] = (new static())::create($values);
        }

        return $array;
    }

    /**
     * @param FactoryInterface $factory
     * @param array|null $values
     * @return FactoryBuilderInterface
     * @throws \ReflectionException
     */
    private static function getBuilder(FactoryInterface $factory, array $values = null): FactoryBuilderInterface
    {
        $name = (new \ReflectionClass($factory))->getShortName();
        $builder = 'Adlacruzes\\Factory\\Builders\\' . $name . 'Builder';

        return new $builder($factory, $values);
    }
}
