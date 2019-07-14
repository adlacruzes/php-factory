<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Factories;

final class ArrayFactory implements FactoryInterface
{
    /**
     * @var array
     */
    private $defaultValues;

    /**
     * ArrayFactoryType constructor.
     * @param array $defaultValues
     */
    public function __construct(array $defaultValues)
    {
        $this->defaultValues = $defaultValues;
    }

    public function get(): array
    {
        return [
            'defaultValues' => $this->defaultValues,
        ];
    }
}
