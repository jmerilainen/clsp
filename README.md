# clsp

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jmerilainen/clsp.svg?style=flat-square)](https://packagist.org/packages/jmerilainen/clsp)
[![Tests](https://github.com/jmerilainen/clsp/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/jmerilainen/clsp/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jmerilainen/clsp.svg?style=flat-square)](https://packagist.org/packages/jmerilainen/clsp)

Composing components with classes and especially with utility libraries like Tailwind CSS can get messy.

`clsp` provides an API to map the component properties to classes with variants and compound variants.

---

**Acknowledgements**

Variant and compound variant API is inspired by [Stitches](https://stitches.dev) and [peduarte](https://github.com/peduarte). Read more about variant-driven components from the [post by Pedro Duarte](https://ped.ro/writing/variant-driven-components).

The name is clsp (class names for php) is inspired by the similar utility tool for JavaScrpt [clsx](https://github.com/lukeed/clsxhttps://github.com/lukeed/clsx).

## Installation

You can install the package via composer:

```bash
composer require jmerilainen/clsp
```

## Usage

Basic example:

```php
$classes = clsp('base-classes')
    ->variants([
        'size' => [
            'sm' => 'text-sm',
            'lg' => 'text-lg',
        ],
        'color' => [
            'primary' => 'bg-blue-500 text-white',
            'secondary' => 'bg-blue-500 text-white',
        ],
        'shape' => [
            'rounded' => 'rounded',
            'pill' => 'rounded-full',
        ],
    ])
    ->props([
        'size' => 'lg',
        'color' => 'primary',
        'shape' => 'rounded',
    ]);

// casting $classes to string outputs: 'base-classes text-lg bg-blue-500 text-white rounded'
```

Example with compound variants:

```php
$classes = clsp('base-classes')
    ->variants([
        'size' => [
            'sm' => 'text-sm',
            'lg' => 'text-lg',
        ],
        'color' => [
            'primary' => 'bg-blue-500 text-white',
            'secondary' => 'bg-blue-500 text-white',
        ],
        'shape' => [
            'rounded' => 'rounded',
            'pill' => 'rounded-full',
        ],
    ])
    ->compoundVariants([
        [
            ['color' => 'primary', 'shape' => 'rounded'], // criteria
            'shadow', // if props matches to criteria include this
        ],
        [
            ['color' => 'primary', 'shape' => 'rounded' 'size' => 'lg' ],
            'cursor-pointer'
        ],
    )]
    ->props([
        'size' => 'lg',
        'color' => 'primary',
        'shape' => 'rounded',
    ]);

// casting $classes to string outputs: 'base-classes text-lg bg-blue-500 text-white rounded shadow cursor-pointer'
```

### API

> TODO

`cslp` function is wrapper for `Clsp::make(...)`.

`Clsp::make(string $defaults)`

Method: `variants(array $data): self`

Method: `compoundVariants(array $data): self`

Method: `props(array $data): self`

Method: `get(): string`

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Roadmap

- [ ] Make the default API similar as the clsx's API. E.g. support arrays with boolean data.
- [ ] Improve documentation.
- [ ] Iterate the API.
- [ ] Publish to packagist.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Joonas Meriläinen](https://github.com/jmerilainen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
