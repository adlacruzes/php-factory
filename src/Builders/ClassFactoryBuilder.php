<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Builders;

use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Exceptions\FactoryException;

final class ClassFactoryBuilder implements FactoryBuilderInterface
{
    /**
     * @var ClassFactory
     */
    private $factoryType;

    /**
     * @var array|null
     */
    private $valuesToMerge;

    /**
     * ClassFactoryBuilder constructor.
     * @param ClassFactory $factoryType
     * @param array|null $valuesToMerge
     */
    public function __construct(ClassFactory $factoryType, array $valuesToMerge = null)
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
        $class = $this->factoryType->get()['class'];

        $parameters = $this->factoryType->get()['defaultValues'];

        if (!class_exists($class)) {
            throw new FactoryException('class not found');
        }

        $parametersFromConstructor = $this->getParametersFromConstructor($class);

        $requiredFields = array_diff($parametersFromConstructor, array_keys($parameters));

        if (!empty($requiredFields)) {
            throw new FactoryException(
                sprintf(
                    'required fields: %s',
                    implode(' ', $requiredFields)
                )
            );
        }

        $invalidValues = array_diff(array_keys($parameters), $parametersFromConstructor);

        if (!empty($invalidValues)) {
            throw new FactoryException(
                sprintf(
                    'invalid fields: %s',
                    implode(' ', $invalidValues)
                )
            );
        }

        if (null !== $this->valuesToMerge) {
            $invalidMerge = array_diff(array_keys($this->valuesToMerge), $parametersFromConstructor);

            if (!empty($invalidMerge)) {
                throw new FactoryException('invalid fields: ' . implode(' ', $invalidMerge));
            }
        }
    }

    public function build(array $values = null)
    {
        $class = $this->factoryType->get()['class'];

        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $this->valuesToMerge);
        }

        return new $class(...array_values($parameters));
    }

    /**
     * @param string $class
     * @return array
     * @throws FactoryException
     * @throws \ReflectionException
     */
    private static function getParametersFromConstructor(string $class)
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (null === $constructor) {
            throw new FactoryException('constructor not found for class ' . $class);
        }

        $params = [];
        foreach ($constructor->getParameters() as $param) {
            $params[] = $param->getName();
        }

        return $params;
    }
}
