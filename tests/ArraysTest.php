<?php

declare(strict_types=1);

namespace Adlacruzes\Factory\Tests;

use Adlacruzes\Factory\Exceptions\FactoryException;
use Adlacruzes\Factory\Tests\Factories\ArraysFactory;
use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGivenNoValuesShouldReturnArray(): void
    {
        $array = ArraysFactory::create();

        self::assertIsArray(
            $array
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidValueShouldReturnValue(): void
    {
        $number = 'New number';

        $array = ArraysFactory::create(
            [
                'two' => $number,
            ]
        );

        self::assertEquals(
            $number,
            $array['two']
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenInValidValueShouldThrowException(): void
    {
        $this->expectException(FactoryException::class);

        $number = 'New number';

        ArraysFactory::create(
            [
                'two' => $number,
                'zero' => 0,
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenAllValidValuesShouldReturnArray(): void
    {
        $expected = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
        ];

        $actual = ArraysFactory::create(
            [
                'one' => 1,
                'two' => 2,
                'three' => 3,
                'four' => 4,
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
    public function testGivenValidNullValueShouldReturnEntity(): void
    {
        $array = ArraysFactory::create(
            [
                'two' => null,
            ]
        );

        self::assertNull(
            $array['two']
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArray(): void
    {
        $arrays = ArraysFactory::createArray();

        self::assertIsArray(
            $arrays
        );

        foreach ($arrays as $array) {
            self::assertIsArray(
                $array
            );
        }
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOfNElements(): void
    {
        $n = 9;
        $arrays = ArraysFactory::createArray($n);

        self::assertCount(
            $n,
            $arrays
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOf1Element(): void
    {
        $arrays = ArraysFactory::createArray();

        self::assertCount(
            1,
            $arrays
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayWithValuesShouldReturnArrayOfNElements(): void
    {
        $n = 9;
        $two = 2;
        $four = 4;

        $arrays = ArraysFactory::createArray(
            $n,
            [
                'two' => $two,
                'four' => $four,
            ]
        );

        self::assertCount(
            $n,
            $arrays
        );

        foreach ($arrays as $array) {
            self::assertEquals($two, $array['two']);
            self::assertEquals($four, $array['four']);
        }
    }

    /**
     * @throws \Exception
     */
    public function testWhenCallingCreateNullableGivenNoValuesShouldReturnNullableArray(): void
    {
        $array = ArraysFactory::createNullable();

        foreach ($array as $key => $value) {
            self::assertNull($value);
        }
    }

    /**
     * @throws \Exception
     */
    public function testWhenCallingCreateNullableGivenSomeValuesShouldReturnNullableArray(): void
    {
        $array = ArraysFactory::createNullable([
            'one' => 'something',
            'four' => 'never mind',
        ]);

        self::assertEquals(
            [
                'one' => 'something',
                'two' => null,
                'three' => null,
                'four' => 'never mind',
            ],
            $array
        );
    }

    /**
     * @throws \Exception
     */
    public function testWhenCallingCreateNullableGivenAllValuesShouldReturnArray(): void
    {
        $values = [
            'one' => '1',
            'two' => '2',
            'three' => '3',
            'four' => '4',
        ];

        $array = ArraysFactory::createNullable($values);

        self::assertEquals(
            $values,
            $array
        );
    }
}
