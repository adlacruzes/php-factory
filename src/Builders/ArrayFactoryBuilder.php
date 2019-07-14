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
     * @var array|null
     */
    private $valuesToMerge;

    /**
     * ClassFactoryBuilder constructor.
     * @param ArrayFactory $factoryType
     * @param array|null $valuesToMerge
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
    public function check()
    {
        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $invalidMerge = array_diff(array_keys($this->valuesToMerge), array_keys($parameters));

            if (!empty($invalidMerge)) {
                throw new FactoryException('invalid values: ' . implode(' ', $invalidMerge));
            }
        }
    }

    public function build(array $values = null)
    {
        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $this->valuesToMerge);
        }

        return $parameters;
    }
}
