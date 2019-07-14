<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Factories;

final class ClassFactory implements FactoryInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var array
     */
    private $defaultValues;

    /**
     * ClassParser constructor.
     * @param string $class
     * @param array $defaultValues
     */
    public function __construct(string $class, array $defaultValues)
    {
        $this->class = $class;
        $this->defaultValues = $defaultValues;
    }

    public function get(): array
    {
        return [
            'class' => $this->class,
            'defaultValues' => $this->defaultValues,
        ];
    }
}
