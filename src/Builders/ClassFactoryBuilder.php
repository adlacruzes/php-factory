<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Builders;

use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Factories\ClassFactory;

final class ClassFactoryBuilder implements FactoryBuilderInterface
{
    /**
     * @var ClassFactory
     */
    private $factoryType;

    /**
     * @var array<mixed>|null
     */
    private $valuesToMerge;

    /**
     * ClassFactoryBuilder constructor.
     * @param ClassFactory $factoryType
     * @param array<mixed>|null $valuesToMerge
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
    public function check(): void
    {
        $class = $this->factoryType->get()['class'];

        $parameters = $this->factoryType->get()['defaultValues'];

        if (!class_exists($class)) {
            throw new FactoryException('class not found');
        }

        $parametersFromConstructor = self::getParametersFromConstructor($class);

        $requiredFields = array_diff($parametersFromConstructor, array_keys($parameters));

        if (0 !== count($requiredFields)) {
            throw new FactoryException(sprintf('required fields: %s', implode(' ', $requiredFields)));
        }

        $invalidValues = array_diff(array_keys($parameters), $parametersFromConstructor);

        if (0 !== count($invalidValues)) {
            throw new FactoryException(sprintf('invalid fields: %s', implode(' ', $invalidValues)));
        }

        if (null !== $this->valuesToMerge) {
            $invalidMerge = array_diff(array_keys($this->valuesToMerge), $parametersFromConstructor);

            if (0 !== count($invalidMerge)) {
                throw new FactoryException('invalid fields: ' . implode(' ', $invalidMerge));
            }
        }
    }

    /**
     * @return \stdclass
     */
    public function create()
    {
        $class = $this->factoryType->get()['class'];

        $parameters = $this->factoryType->get()['defaultValues'];

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $this->valuesToMerge);
        }

        return new $class(...array_values($parameters));
    }

    /**
     * @return \stdclass
     */
    public function createNullable()
    {
        $class = $this->factoryType->get()['class'];

        $parameters = $this->factoryType->get()['defaultValues'];

        $nullableParameters = self::getNullableParametersFromConstructor($class);

        $parameters = array_merge($parameters, $nullableParameters);

        if (null !== $this->valuesToMerge) {
            $parameters = array_merge($parameters, $this->valuesToMerge);
        }

        return new $class(...array_values($parameters));
    }

    /**
     * @param class-string $class
     * @return array<mixed>
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
            $params[$param->getName()] = $param->getName();
        }

        return $params;
    }

    /**
     * @param class-string $class
     * @return array<mixed>
     * @throws FactoryException
     * @throws \ReflectionException
     */
    private static function getNullableParametersFromConstructor(string $class)
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (null === $constructor) {
            throw new FactoryException('constructor not found for class ' . $class);
        }

        $params = [];
        foreach ($constructor->getParameters() as $param) {
            if ($param->allowsNull()) {
                $params[$param->getName()] = null;
            }
        }

        return $params;
    }
}
