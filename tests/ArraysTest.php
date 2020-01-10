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
    public function testGivenNoValuesShouldReturnArray()
    {
        $array = ArraysFactory::create();

        $this->assertIsArray(
            $array
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidValueShouldReturnValue()
    {
        $number = 'New number';

        $array = ArraysFactory::create(
            [
                'two' => $number,
            ]
        );

        $this->assertEquals(
            $number,
            $array['two']
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenInValidValueShouldThrowException()
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
    public function testGivenAllValidValuesShouldReturnArray()
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

        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws \Exception
     */
    public function testGivenValidNullValueShouldReturnEntity()
    {
        $array = ArraysFactory::create(
            [
                'two' => null,
            ]
        );

        $this->assertNull(
            $array['two']
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArray()
    {
        $arrays = ArraysFactory::createArray();

        $this->assertIsArray(
            $arrays
        );

        foreach ($arrays as $array) {
            $this->assertIsArray(
                $array
            );
        }
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOfNElements()
    {
        $n = 9;
        $arrays = ArraysFactory::createArray($n);

        $this->assertCount(
            $n,
            $arrays
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayShouldReturnArrayOf1Element()
    {
        $arrays = ArraysFactory::createArray();

        $this->assertCount(
            1,
            $arrays
        );
    }

    /**
     * @throws \Exception
     */
    public function testCreateArrayWithValuesShouldReturnArrayOfNElements()
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

        $this->assertCount(
            $n,
            $arrays
        );

        foreach ($arrays as $array) {
            $this->assertEquals($two, $array['two']);
            $this->assertEquals($four, $array['four']);
        }
    }
}
