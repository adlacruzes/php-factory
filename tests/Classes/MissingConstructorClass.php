<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests\Classes;

use DateTime;

class MissingConstructorClass
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $optional;

    /**
     * @var DateTime|null
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
