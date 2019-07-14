# PHP Factory
PHP Factory allows to generate classes and arrays with default values and reduce test bloatware.

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/adlacruzes/php-factory.svg?branch=travis)](https://travis-ci.org/adlacruzes/php-factory)

## Requirements
PHP needs to be a minimum version of PHP 7.2.

## Installing

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
composer require adlacruzes/php-factory
```
## Usage

### Array factory

Create a class that extends from Factory.

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

If you want to modify some information, you have to pass it as a parameter to override the default value:
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

Define a class to create a factory. For example:
```php
class ValidClass
{
    private $id;

    private $name;

    private $isEnabled;

    private $createdAt;

    public function __construct($id, $name, $isEnabled, DateTime $createdAt)
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
You can call `ValidClassFactory::create()` and obtain the defined class.

If you want to modify some information, you have to pass it as a parameter to override the default value:
```php
ValidClassFactory::create(
    [
        'isEnabled' => false
    ]
);
```
