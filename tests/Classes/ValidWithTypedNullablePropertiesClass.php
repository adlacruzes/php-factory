<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Classes;

use DateTime;

class ValidWithTypedNullablePropertiesClass
{
    /**
     * @var int|null
     */
    private $a;

    /**
     * @var mixed
     */
    private $b;

    /**
     * @var bool
     */
    private $c;

    /**
     * @var DateTime|null
     */
    private $d;

    /**
     * ValidWithTypedNullablePropertiesClass constructor.
     * @param int|null $a
     * @param mixed $b
     * @param bool $c
     * @param DateTime|null $d
     */
    public function __construct(?int $a, $b, bool $c, ?DateTime $d)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
    }

    public function getA(): ?int
    {
        return $this->a;
    }

    /**
     * @return mixed
     */
    public function getB()
    {
        return $this->b;
    }

    public function getC(): bool
    {
        return $this->c;
    }

    public function getD(): ?DateTime
    {
        return $this->d;
    }
}
