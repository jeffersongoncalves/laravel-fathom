<div class="filament-hidden">

![Laravel Fathom](https://raw.githubusercontent.com/jeffersongoncalves/laravel-fathom/master/art/jeffersongoncalves-laravel-fathom.png)

</div>

# Laravel Fathom

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-fathom.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-fathom)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-fathom/fix-php-code-style-issues.yml?branch=master&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/laravel-fathom/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-fathom.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-fathom)

This Laravel package seamlessly integrates Fathom analytics into your Blade templates. Easily track website visits and user engagement directly within your Laravel application, providing valuable insights into your website's performance. This package simplifies the integration process, saving you time and effort. With minimal configuration, you can leverage Fathom's powerful analytics features to gain a clearer understanding of your audience and website usage.

Settings are stored in the database using [spatie/laravel-settings](https://github.com/spatie/laravel-settings), allowing you to manage them dynamically (e.g., via an admin panel) without relying on `.env` files.

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/laravel-fathom
```

Publish and run the settings migration:

```bash
php artisan vendor:publish --tag=fathom-settings-migrations
php artisan migrate
```

## Configuration

All settings are managed exclusively from the database after running the migration. You can update them programmatically:

```php
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

$settings = app(FathomSettings::class);
$settings->website_id = 'NEW_SITE_ID';
$settings->spa = 'history';
$settings->save();
```

Or use the helper function:

```php
$settings = fathom_settings();
$settings->website_id = 'NEW_SITE_ID';
$settings->save();
```

Or use the Facade. The facade resolves the underlying `FathomSettings` instance, so read or write properties through `getFacadeRoot()`:

```php
use JeffersonGoncalves\Fathom\Facades\Fathom;

// Read a value
$websiteId = Fathom::getFacadeRoot()->website_id;

// Update and persist
$settings = Fathom::getFacadeRoot();
$settings->website_id = 'NEW_SITE_ID';
$settings->save();
```

### Available settings

| Setting | Type | Default | Description |
|---------|------|---------|-------------|
| `website_id` | `?string` | `null` | Your Fathom site ID. The script only renders when this is set. |
| `canonical` | `bool` | `true` | When `false`, sends `data-canonical="false"` to ignore canonical URLs. |
| `auto` | `bool` | `true` | Controls `data-auto-track` (automatic pageview tracking). |
| `spa` | `?string` | `null` | SPA tracking mode (e.g. `history`, `hash`, `auto`). |
| `honor_dnt` | `?bool` | `null` | When truthy, sends `data-honor-dnt="true"` to respect Do Not Track. |

## Usage

Add the Fathom script to your Blade layout (typically in `<head>`):

```php
@include('fathom::script')
```

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

- [Jefferson Goncalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
