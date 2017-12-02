[![Build Status](https://travis-ci.org/danielsdeboer/optionally.svg?branch=master)](https://travis-ci.org/danielsdeboer/optionally)
[![Latest Stable Version](https://poser.pugx.org/aviator/optionally/v/stable)](https://packagist.org/packages/aviator/optionally)
[![License](https://poser.pugx.org/aviator/optionally/license)](https://packagist.org/packages/aviator/optionally)

## Overview

Optionally is a keyed store of booleans. It can be used for anything but usually to store options.

### Installation

Via Composer:

```
composer require aviator/optionally
```

### Testing

Via Composer:

```
composer test
```

### Usage

Create a new instance with an array. The array should have string keys and boolean values. It's important to note that any integer keys will be silently discarded without raising an exception or error: 

```php
$options = Optionally::make(['option1' => true, 'option2' => false, 0 => false]);

// [0 => false] will be discarded.
```

Get the underlying array with `all()`:

```php
$options->all();

// ['option1' => true, 'option2' => false]
```

Get the keys of the underlying array with `keys()`:

```php
$options->keys();

// ['option1', 'option2']
```

Get the value of a key if it exists (or null if it doesn't) with `get()`:

```php
$options->get('option1');

// true

$options->get('someOptionThatDoesntExist');

// null
```

Find whether or not a key exists with `has()`:

```php
$options->has('option2');

// true

$options->has('someOptionThatDoesntExist');

// false
```

Trash the existing options and replace them with `replaceWith()`:

```php
$options->replaceWith(['option3' => true, 'option4' => false]);

$options->all();

// ['option3' => true, 'option4' => false]
```

Add a new array to the existing options array, overwriting existing keys with `add()`:

```php
$options->add(['option1' => false, 'option3' => true]);

$options->all();

// ['option1' => false, 'option2' => false, 'option3' => true]
```

Set a single key value pair with `set()`:

```php
$options->set('option3', false);

$options->all();

// ['option1' => true, 'option2' => false, 'option3' => false]
```

Trash a single key value pair with `remove()`:

```php
$options->remove('option1');

$options->all();

// ['option2' => true]
```

An instance of `Optionally` is iterable:

```php
foreach ($options as $key => $value) {
    /* ... */
}
```

It's also countable:

```php
count($foreach);

// 2
```

## Other

### License

This package is licensed with the [MIT License (MIT)](LICENSE).

