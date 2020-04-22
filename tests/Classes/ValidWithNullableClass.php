<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Classes;

use DateTime;

class ValidWithNullableClass
{
    /**
     * @var int|null
     */
    private $a;

    /**
     * @var string|null
     */
    private $b;

    /**
     * @var bool|null
     */
    private $c;

    /**
     * @var DateTime|null
     */
    private $d;

    /**
     * ValidWithNullableClass constructor.
     * @param int|null $a
     * @param string|null $b
     * @param bool|null $c
     * @param DateTime|null $d
     */
    public function __construct($a = null, $b = null, $c = null, $d = null)
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
     * @return string|null
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @return bool|null
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
