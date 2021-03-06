<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Builders;

use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Factories\ArrayFactory;

final class ArrayFactoryBuilder implements FactoryBuilderInterface
{
    /**
     * @var ArrayFactory
     */
    private $factoryType;

    /**
     * @var array<mixed>|null
     */
    private $valuesToMerge;

    /**
     * ClassFactoryBuilder constructor.
     * @param ArrayFactory $factoryType
     * @param array<mixed>|null $valuesToMerge
     */
    public function __construct(ArrayFactory $factoryType, array $valuesToMerge = null)
    {
        $this->factoryType = $factoryType;
        $this->valuesToMerge = $valuesToMerge;
    }

    /**
     * @throws FactoryException
     * @throws \ReflectionException
     */
    public function check(): void
    {
        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $invalidMerge = array_diff(array_keys($this->valuesToMerge), array_keys($parameters));

            if (0 !== count(($invalidMerge))) {
                throw new FactoryException(sprintf('invalid fields: %s', implode(' ', $invalidMerge)));
            }
        }
    }

    /**
     * @return array<mixed>
     */
    public function create()
    {
        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $this->valuesToMerge);
        }

        return $parameters;
    }

    public function createNullable()
    {
        $parameters = $this->factoryType->get()['defaultValues'];

        $nullableParameters = [];
        foreach ($parameters as $key => $value) {
            $nullableParameters[$key] = null;
        }

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $nullableParameters, $this->valuesToMerge);
        } else {
            $parameters = array_merge($parameters, $nullableParameters);
        }

        return $parameters;
    }
}
