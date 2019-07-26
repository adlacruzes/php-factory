<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests;

use DateTime;
use Adlacruzes\Factory\Tests\Classes\ValidClass;
use Adlacruzes\Factory\Tests\Factories\ValidClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithOptionalClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\InvalidParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingConstructorClassFactory;
use Adlacruzes\Factory\Exceptions\FactoryException;
use PHPUnit\Framework\TestCase;

class ClassesTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGivenNoValuesShouldReturnEntity()
    {
        $entity = ValidClassFactory::create();

        $this->assertInstanceOf(
            ValidClass::class,
            $entity
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidValueShouldReturnValue()
    {
        $name = 'New name';

        $entity = ValidClassFactory::create(
            [
                'name' => $name,
            ]
        );

        $this->assertEquals(
            $name,
            $entity->getName()
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenAllValidValuesShouldReturnEntity()
    {
        $id = 1;
        $name = 'New name';
        $isEnabled = true;
        $createdAt = new DateTime();

        $expected = new ValidClass(
            $id,
            $name,
            $isEnabled,
            $createdAt
        );

        $actual = ValidClassFactory::create(
            [
                'id' => $id,
                'name' => $name,
                'isEnabled' => $isEnabled,
                'createdAt' => $createdAt,
            ]
        );

        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenInValidValueShouldThrowException()
    {
        $this->expectException(FactoryException::class);

        ValidClassFactory::create(
            [
                'invalid' => 'argument',
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidTypeValueShouldReturnEntity()
    {
        $datetime = new DateTime();
        $entity = ValidWithOptionalClassFactory::create(
            [
                'createdAt' => $datetime,
            ]
        );

        $this->assertEquals(
            $datetime,
            $entity->getCreatedAt()
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidNullValueShouldReturnEntity()
    {
        $optional = null;
        $entity = ValidWithOptionalClassFactory::create(
            [
                'optional' => $optional,
            ]
        );

        $this->assertEquals(
            $optional,
            $entity->getOptional()
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArray()
    {
        $entities = ValidClassFactory::createArray();

        $this->assertIsArray(
            $entities
        );

        $this->assertContainsOnlyInstancesOf(
            ValidClass::class,
            $entities
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOfNElements()
    {
        $n = 9;
        $entities = ValidClassFactory::createArray($n);

        $this->assertCount(
            $n,
            $entities
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOf1Element()
    {
        $entities = ValidClassFactory::createArray();

        $this->assertCount(
            1,
            $entities
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayWithValuesShouldReturnArrayOfNElements()
    {
        $n = 9;
        $name = 'fixed';
        $createdAt = new DateTime('1970-01-01 00:00:00');

        $entities = ValidClassFactory::createArray(
            $n,
            [
                'name' => $name,
                'createdAt' => $createdAt,
            ]
        );

        $this->assertCount(
            $n,
            $entities
        );

        foreach ($entities as $entity) {
            $this->assertEquals($name, $entity->getName());
            $this->assertEquals($createdAt, $entity->getCreatedAt());
        }
    }

    /**
     * @throws \Exception
     */
    public function testRequiredParametersShouldThrowException()
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: required fields: createdAt');

        MissingParameterClassFactory::create();
    }

    /**
     * @throws \Exception
     */
    public function testInvalidParametersShouldThrowException()
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: invalid fields: uuid something');

        InvalidParameterClassFactory::create();
    }

    /**
     * @throws \Exception
     */
    public function testNoConstructorShouldThrowException()
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: constructor not found');

        MissingConstructorClassFactory::create();
    }
}
