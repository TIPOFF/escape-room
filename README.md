# Laravel package for escape room models and logic

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tipoff/escape-room.svg?style=flat-square)](https://packagist.org/packages/tipoff/escape-room)
![Tests](https://github.com/tipoff/escape-room/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tipoff/escape-room.svg?style=flat-square)](https://packagist.org/packages/tipoff/escape-room)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require tipoff/escape-room
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Tipoff\EscapeRoom\EscapeRoomServiceProvider" --tag="escape-room-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Tipoff\EscapeRoom\EscapeRoomServiceProvider" --tag="escape-room-config"
```

This is the contents of the published config file:

```php
return [
];
```
## Models
We include the following models:

**List of Models**

- Participant
- Rate
- Room
- Supervision
- Theme

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tipoff](https://github.com/tipoff)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
