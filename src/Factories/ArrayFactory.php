<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Factories;

final class ArrayFactory implements FactoryInterface
{
    /**
     * @var array<string, mixed>
     */
    private $defaultValues;

    /**
     * ArrayFactoryType constructor.
     * @param array<string, mixed> $defaultValues
     */
    public function __construct(array $defaultValues)
    {
        $this->defaultValues = $defaultValues;
    }

    /**
     * @return array{defaultValues: array<string, mixed>}
     */
    public function get(): array
    {
        return [
            'defaultValues' => $this->defaultValues,
        ];
    }
}
