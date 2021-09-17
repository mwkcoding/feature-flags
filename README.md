# Laravel Feature Flags &#128640;

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mwkcoding/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/mwkcoding/laravel-feature-flags)
[![Total Downloads](https://img.shields.io/packagist/dt/mwkcoding/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/mwkcoding/laravel-feature-flags)
![GitHub Actions](https://github.com/mwkcoding/feature-flags/actions/workflows/main.yml/badge.svg)

A Feature flag is at times referred to as a feature toggle or feature switch. Ultimately it's a coding strategy to be used along with source control to make it easier to continuously integrate and deploy. The idea of the flags works by essentially safe guarding sections of code from executing if a feature flag isn't in a switched on state.

This package aims to make implementing such flags across your application a great deal easier by providing solutions that work with not only your code but your routes, blade files, task scheduling and validations.



## Installation

You can install the package via composer:

```bash
composer require mwkcoding/feature-flags
```

Publish the config:

```bash
php artisan vendor:publish --provider="Mwk\FeatureFlags\FeatureFlagsServiceProvider" --tag="config"
```

## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mikkel@mwkcoding.com instead of using the issue tracker.

## Credits

-   [Mikkel Köhler](https://github.com/mwkcoding)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
