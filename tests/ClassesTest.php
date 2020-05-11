<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests;

use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Tests\Classes\ValidClass;
use Adlacruzes\Factory\Tests\Classes\ValidWithAllNullablePropertiesClass;
use Adlacruzes\Factory\Tests\Classes\ValidWithSomeNullablePropertiesClass;
use Adlacruzes\Factory\Tests\Factories\InvalidParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingConstructorClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithAllNullablePropertiesClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithOptionalClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithSomeNullablePropertiesClassFactory;
use DateTime;
use PHPUnit\Framework\TestCase;

class ClassesTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGivenNoValuesShouldReturnEntity(): void
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
    public function testGivenValidValueShouldReturnValue(): void
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
    public function testGivenAllValidValuesShouldReturnEntity(): void
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
    public function testGivenInValidValueShouldThrowException(): void
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
    public function testGivenValidTypeValueShouldReturnEntity(): void
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
    public function testGivenValidNullValueShouldReturnEntity(): void
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
    public function testCreateArrayShouldReturnArray(): void
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
    public function testCreateArrayShouldReturnArrayOfNElements(): void
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
    public function testCreateArrayShouldReturnArrayOf1Element(): void
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
    public function testCreateArrayWithValuesShouldReturnArrayOfNElements(): void
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
    public function testRequiredParametersShouldThrowException(): void
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: required fields: createdAt');

        MissingParameterClassFactory::create();
    }

    /**
     * @throws \Exception
     */
    public function testInvalidParametersShouldThrowException(): void
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: invalid fields: uuid something');

        InvalidParameterClassFactory::create();
    }

    /**
     * @throws \Exception
     */
    public function testNoConstructorShouldThrowException(): void
    {
        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage('Factory: constructor not found');

        MissingConstructorClassFactory::create();
    }

    /**
     * @throws \Exception
     */
    public function testGivenNullValuesShouldReturnClass(): void
    {
        $entity = ValidWithAllNullablePropertiesClassFactory::create();

        $this->assertInstanceOf(
            ValidWithAllNullablePropertiesClass::class,
            $entity
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenAllNullValuesShouldReturnClassWithNulls(): void
    {
        $entity = ValidWithAllNullablePropertiesClassFactory::createNullable();

        $this->assertInstanceOf(
            ValidWithAllNullablePropertiesClass::class,
            $entity
        );

        $this->assertNull($entity->getA());
        $this->assertNull($entity->getB());
        $this->assertNull($entity->getC());
        $this->assertNull($entity->getD());
    }

    /**
     * @throws \Exception
     */
    public function testGivenSomeNullValuesShouldReturnClassWithNulls(): void
    {
        $entity = ValidWithSomeNullablePropertiesClassFactory::createNullable([
            'c' => true,
        ]);

        $this->assertInstanceOf(
            ValidWithSomeNullablePropertiesClass::class,
            $entity
        );

        $this->assertNull($entity->getA());
        $this->assertNull($entity->getB());
        $this->assertNotNull($entity->getC());
        $this->assertNull($entity->getD());
    }
}
