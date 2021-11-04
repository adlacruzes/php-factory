<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Factories;

final class ClassFactory implements FactoryInterface
{
    /**
     * @var class-string
     */
    private $class;

    /**
     * @var array<string, mixed>
     */
    private $defaultValues;

    /**
     * ClassParser constructor.
     * @param class-string $class
     * @param array<string, mixed> $defaultValues
     */
    public function __construct(string $class, array $defaultValues)
    {
        $this->class = $class;
        $this->defaultValues = $defaultValues;
    }

    /**
     * @return array{defaultValues: array<string, mixed>, class: class-string}
     */
    public function get(): array
    {
        return [
            'class' => $this->class,
            'defaultValues' => $this->defaultValues,
        ];
    }
}
