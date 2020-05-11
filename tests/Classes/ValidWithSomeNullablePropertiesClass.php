<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Classes;

use DateTime;

class ValidWithSomeNullablePropertiesClass
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
     * ValidWithSomeNullablePropertiesClass constructor.
     * @param int|null $a
     * @param mixed $b
     * @param bool $c
     * @param DateTime|null $d
     */
    public function __construct($a = null, $b, $c, $d = null)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
    }

    /**
     * @return int|null
     */
    public function getA()
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

    /**
     * @return bool
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * @return DateTime|null
     */
    public function getD()
    {
        return $this->d;
    }
}
