# PHP Factory

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/adlacruzes/php-factory.svg?branch=master)](https://travis-ci.org/adlacruzes/php-factory)

PHP Factory allows generating classes and arrays with default values and reduce test bloatware.

The main purpose of this library is help with the creation of tests and fixtures.

# Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Factories](#factories)
	- [Array factory](#array-factory)
	- [Class factory](#class-factory)
- [Methods](#methods)
    - [create](#create)
    - [createArray](#create-array)
- [Exceptions](#exceptions)

## Requirements

PHP needs to be a minimum version of PHP 7.2.

## Installation

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
composer require adlacruzes/php-factory
```

## Factories

Every factory has to extend `Adlacruzes\Factory\Factory` to obtain the required methods.

### Array factory

The array factory allows generating an array with predefined values. 

```php
use Adlacruzes\Factory\Factory;
use Adlacruzes\Factory\Factories\ArrayFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;

class ArraysFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ArrayFactory(
            [
                'one' => 'one',
                'two' => 'two',
                'three' => 'three',
                'four' => 'four',
            ]
        );
    }
}
```
You can call `ArraysFactory::create()` and obtain the defined array:

```php
[
    'one' => 'one',
    'two' => 'two',
    'three' => 'three',
    'four' => 'four',
]
```

If you want to change some information, you can override the values with a new partial array:

```php
ArraysFactory::create(
    [
        'four' => 'another number'
    ]
);
```

The returned array will be:
```php
[
    'one' => 'one',
    'two' => 'two',
    'three' => 'three',
    'four' => 'another number',
]
```

### Class factory

The class factory allows generating a concrete class with default constructor parameters.

```php
class ValidClass
{
    private $id;

    private $name;

    private $isEnabled;

    private $createdAt;

    public function __construct($id, $name, $isEnabled, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isEnabled = $isEnabled;
        $this->createdAt = $createdAt;
    }

```

Create a class that extends from Factory.

```php
use Adlacruzes\Factory\Factories\ClassFactory;
use Adlacruzes\Factory\Factories\FactoryInterface;
use Adlacruzes\Factory\Factory;

class ValidClassFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ClassFactory(
            ValidClass::class,
            [
                'id' => 1,
                'name' => 'name',
                'isEnabled' => true,
                'createdAt' => new \DateTime(),
            ]
        );
    }
}
```
You can call `ValidClassFactory::create()` and obtain the defined class:

```php
class ValidClass (4) {
  private $id =>
  int(1)
  private $name =>
  string(4) "name"
  private $isEnabled =>
  bool(true)
  private $createdAt =>
  class DateTime (3) {
    public $date =>
    string(26) "2019-01-01 00:00:00.000000"
    public $timezone_type =>
    int(3)
    public $timezone =>
    string(3) "UTC"
  }
}

```

If you want to change some information, you can override default values with a new partial array:

```php
ValidClassFactory::create(
    [
        'name' => 'other',
        'isEnabled' => false
    ]
);
```

The returned class will be:
```php
class ValidClass (4) {
  private $id =>
  int(1)
  private $name =>
  string(4) "other"
  private $isEnabled =>
  bool(false)
  private $createdAt =>
  class DateTime (3) {
    public $date =>
    string(26) "2019-01-01 00:00:00.000000"
    public $timezone_type =>
    int(3)
    public $timezone =>
    string(3) "UTC"
  }
}

```

## Methods

There are two methods for every factory. They can be called with no arguments or can receive an array of values to override the defaults parameters.

### create

Create returns an instance of the factory.

#### `create()`

Returns the predefined factory.

```php
SampleFactory::create();
```

#### `create(array)`

Returns the predefined factory with the new specified values.

```php
SampleFactory::create(
    [
        'field' => 'value'
    ]
);
```

### create array

CreateArray returns an array of instances of the factory. The number of instances can be specified as first argument. The default number is one.

#### `createArray()`

Returns an array of one predefined factory.

```php
SampleFactory::createArray();
```

#### `createArray(n)`

Returns an array of `n` predefined factories.

```php
SampleFactory::createArray(n);
```

#### `createArray(n, array)`

Returns an array of `n` predefined factories with the new specified values.

```php
SampleFactory::create(
    n,
    [
        'field' => 'value'
    ]
);
```

## Exceptions

An `FactoryException` is thrown when the parameters to override the default values are not part of the original factory.

For example:

```php
class ArraysFactory extends Factory
{
    protected static function setFactory(): FactoryInterface
    {
        return new ArrayFactory(
            [
                'one' => 'one',
                'two' => 'two',
                'three' => 'three',
                'four' => 'four',
            ]
        );
    }
}

ArraysFactory::create(
    [
        'five' => 'five'
    ]
);
```

```php
Factory: invalid fields: five
```
