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
     * @param array<mixed>|null $values
     * @return mixed
     * @throws FactoryException
     * @throws \ReflectionException
     */
    public static function create(array $values = null)
    {
        $factory = (new static())::setFactory();

        $builder = self::getBuilder($factory, $values);

        $builder->check();

        return $builder->create();
    }

    /**
     * @param array<mixed>|null $values
     * @return mixed
     * @throws FactoryException
     * @throws \ReflectionException
     */
    public static function createNullable(array $values = null)
    {
        $factory = (new static())::setFactory();

        $builder = self::getBuilder($factory, $values);

        $builder->check();

        return $builder->createNullable();
    }

    /**
     * @param int $n
     * @param array<mixed>|null $values
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
     * @param array<mixed>|null $values
     * @return FactoryBuilderInterface
     * @throws \ReflectionException
     * @throws FactoryException
     */
    private static function getBuilder(FactoryInterface $factory, array $values = null): FactoryBuilderInterface
    {
        $name = (new \ReflectionClass($factory))->getShortName();
        $builder = 'Adlacruzes\\Factory\\Builders\\' . $name . 'Builder';

        $factoryBuilder = new $builder($factory, $values);

        if (false === ($factoryBuilder instanceof FactoryBuilderInterface)) {
            throw new FactoryException('invalid factory builder: ' . $builder);
        }

        return $factoryBuilder;
    }
}
