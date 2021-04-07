<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests;

use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Tests\Classes\ValidClass;
use Adlacruzes\Factory\Tests\Classes\ValidWithAllNullablePropertiesClass;
use Adlacruzes\Factory\Tests\Classes\ValidWithSomeNullablePropertiesClass;
use Adlacruzes\Factory\Tests\Classes\ValidWithTypedNullablePropertiesClass;
use Adlacruzes\Factory\Tests\Factories\InvalidParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingConstructorClassFactory;
use Adlacruzes\Factory\Tests\Factories\MissingParameterClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithAllNullablePropertiesClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithOptionalClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithSomeNullablePropertiesClassFactory;
use Adlacruzes\Factory\Tests\Factories\ValidWithTypedNullablePropertiesClassFactory;
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

        self::assertInstanceOf(
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

        self::assertEquals(
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

        self::assertEquals(
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

        self::assertEquals(
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

        self::assertEquals(
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

        self::assertIsArray(
            $entities
        );

        self::assertContainsOnlyInstancesOf(
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

        self::assertCount(
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

        self::assertCount(
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

        self::assertCount(
            $n,
            $entities
        );

        foreach ($entities as $entity) {
            self::assertEquals($name, $entity->getName());
            self::assertEquals($createdAt, $entity->getCreatedAt());
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

        self::assertInstanceOf(
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

        self::assertInstanceOf(
            ValidWithAllNullablePropertiesClass::class,
            $entity
        );

        self::assertNull($entity->getA());
        self::assertNull($entity->getB());
        self::assertNull($entity->getC());
        self::assertNull($entity->getD());
    }

    /**
     * @throws \Exception
     */
    public function testGivenSomeNullValuesShouldReturnClassWithNulls(): void
    {
        $entity = ValidWithSomeNullablePropertiesClassFactory::createNullable([
            'c' => true,
        ]);

        self::assertInstanceOf(
            ValidWithSomeNullablePropertiesClass::class,
            $entity
        );

        self::assertNull($entity->getA());
        self::assertNull($entity->getB());
        self::assertNotNull($entity->getC());
        self::assertNull($entity->getD());
    }

    /**
     * @throws \Exception
     */
    public function testGivenTypedNullValuesShouldReturnClassWithNulls(): void
    {
        $entity = ValidWithTypedNullablePropertiesClassFactory::createNullable([
            'c' => true,
        ]);

        self::assertInstanceOf(
            ValidWithTypedNullablePropertiesClass::class,
            $entity
        );

        self::assertNull($entity->getA());
        self::assertNull($entity->getB());
        self::assertNotNull($entity->getC());
        self::assertNull($entity->getD());
    }
}
