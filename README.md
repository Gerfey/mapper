# Json/Array mapper

[![Source Code][badge-source]][source]
[![Software License][badge-license]][license]
[![Total Downloads][badge-downloads]][downloads]

gerfey/mapper is a PHP 7.1+ library for map nested Json/Array structures onto PHP classes.

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run
the following command to install the package and add it as a requirement to your
project's `composer.json`:

```bash
composer require gerfey/mapper @dev
```

## Usage

### Entity class

```php
<?php

namespace App\Entity;

use Gerfey\Mapper\Annotation\Field;
use Gerfey\Mapper\Annotation\Rule;

class User
{
    /**
     * @Field(type="int")
     * @Rule(name="limit", params={0,100})
     */
    public $id;

    /**
     * @Field(name="first_name", type="string")
     */
    public $name;

    /**
     * @Field(type="object", passIn="Address")
     */
    public $address;
}
```

```php
<?php

namespace App\Entity;

class Address
{
    public $street;

    public $city;
}
```

### Map an array of objects:

```php
use App\Entity\User;
use Gerfey\Mapper\Format\ArrayMapper;

$mapper = new ArrayMapper();
$entity = $mapper->map(User::class, [
    'id' => "1",
    'first_name' => "Александр",
    'address' => [
        'street' => 'просп. имени газеты Красноярский Рабочий',
        'city' => 'Красноярск'
    ]
]);
dd($entity);
```

### Result:

```php
User {#337 ▼
  +id: 1
  +name: "Александр"
  +address: Address {#344 ▼
    +street: "просп. имени газеты Красноярский Рабочий"
    +city: "Красноярск"
  }
}
```
 
## Copyright and License

The gerfey/mapper library is copyright © [Alexander Levchenkov](https://vk.com/gerfey) and
licensed for use under the MIT License (MIT). Please see [LICENSE][] for more
information.

[packagist]: https://packagist.org/packages/gerfey/mapper
[composer]: http://getcomposer.org/
[http-interop/http-factory-guzzle]: https://packagist.org/packages/http-interop/http-factory-guzzle
[guzzlehttp/guzzle]: https://packagist.org/packages/guzzlehttp/guzzle

[badge-source]: https://img.shields.io/badge/source-gerfey/mapper-blue.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-build]: https://img.shields.io/travis/gerfey/mapper/master.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/gerfey/mapper.svg?style=flat-square

[source]: https://github.com/gerfey/mapper
[release]: https://packagist.org/packages/gerfey/mapper
[license]: https://github.com/gerfey/mapper/blob/master/LICENSE
[build]: https://travis-ci.org/gerfey/mapper
[downloads]: https://packagist.org/packages/gerfey/mapper
