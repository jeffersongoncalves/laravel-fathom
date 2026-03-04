---
name: fathom-development
description: Development skill for the laravel-fathom package -- Fathom Analytics integration for Laravel using spatie/laravel-settings
---

## When to use this skill

- Adding or modifying Fathom Analytics tracking behavior
- Working with the `FathomSettings` class or its properties
- Updating the Blade script view (`fathom::script`)
- Writing tests for the laravel-fathom package
- Adding new Fathom tracking options or data attributes

## Setup

### Requirements
- PHP 8.2+
- Laravel 11, 12, or 13
- `spatie/laravel-settings` ^3.0
- `spatie/laravel-package-tools` ^1.14.0

### Installation
```bash
composer require jeffersongoncalves/laravel-fathom
php artisan vendor:publish --tag=fathom-settings-migrations
php artisan migrate
```

### Package structure
```
laravel-fathom/
├── src/
│   ├── FathomServiceProvider.php    # Package service provider
│   ├── Facades/Fathom.php          # Facade for FathomSettings
│   ├── Settings/FathomSettings.php  # Settings class (spatie/laravel-settings)
│   └── helpers.php                  # fathom_settings() helper function
├── database/
│   └── settings/
│       └── 2026_01_01_000000_create_fathom_settings.php
├── resources/
│   └── views/
│       └── script.blade.php         # Fathom tracking script template
└── tests/
    ├── TestCase.php                 # Base test case with SQLite setup
    ├── Pest.php                     # Pest configuration
    ├── FathomSettingsTest.php       # Settings unit tests
    └── BladeViewTest.php            # Blade view rendering tests
```

## Features

### FathomSettings class

The core settings class extends `Spatie\LaravelSettings\Settings` with group `fathom`:

```php
namespace JeffersonGoncalves\Fathom\Settings;

use Spatie\LaravelSettings\Settings;

class FathomSettings extends Settings
{
    public ?string $website_id;  // Fathom site ID (e.g., 'ABCDEFGH')
    public bool $canonical;       // Use canonical URLs (default: true)
    public bool $auto;            // Auto-track page views (default: true)
    public ?string $spa;          // SPA mode: 'auto', 'history', 'hash', or null
    public ?bool $honor_dnt;      // Honor Do Not Track header

    public static function group(): string
    {
        return 'fathom';
    }
}
```

### Settings defaults (from migration)

| Property     | Default | Description                        |
|--------------|---------|------------------------------------|
| `website_id` | `null`  | Fathom site tracking ID            |
| `canonical`  | `true`  | Use canonical URLs for tracking    |
| `auto`       | `true`  | Automatically track page views     |
| `spa`        | `null`  | SPA tracking mode                  |
| `honor_dnt`  | `null`  | Respect Do Not Track browser flag  |

### Accessing settings

```php
// Helper function (globally available)
$settings = fathom_settings();

// Via Laravel container
$settings = app(\JeffersonGoncalves\Fathom\Settings\FathomSettings::class);

// Update and persist
$settings->website_id = 'ABCDEFGH';
$settings->spa = 'history';
$settings->save();
```

### Blade view rendering

Include in your layout's `<head>`:

```blade
@include('fathom::script')
```

The view renders a `<script>` tag with conditional data attributes:

```html
<script src="https://cdn.usefathom.com/script.js" defer
        data-site="ABCDEFGH"
        data-spa="history"
        data-honor-dnt="true"
        data-auto-track="true">
</script>
```

Rendering rules:
- Script only renders when `website_id` is not empty
- `data-canonical="false"` only appears when `canonical` is explicitly `false`
- `data-spa` only appears when `spa` is not null (values: `auto`, `history`, `hash`)
- `data-honor-dnt="true"` only appears when `honor_dnt` is `true`
- `data-auto-track` always renders as `"true"` or `"false"`

### Service provider

`FathomServiceProvider` extends `PackageServiceProvider` from spatie/laravel-package-tools:

```php
// Registers the package with views
$package->name('laravel-fathom')->hasViews();

// Automatically registers FathomSettings in spatie/laravel-settings config
Config::set('settings.settings', array_merge(
    Config::get('settings.settings', []),
    [FathomSettings::class]
));

// Publishes settings migrations with tag 'fathom-settings-migrations'
$this->publishes([
    $settingsMigrationsPath => database_path('settings'),
], 'fathom-settings-migrations');
```

### Facade

The `Fathom` facade resolves to `FathomSettings::class`:

```php
use JeffersonGoncalves\Fathom\Facades\Fathom;

// The facade accessor returns the FathomSettings class string
Fathom::getFacadeRoot(); // returns FathomSettings instance
```

## Configuration

This package uses **no config files**. All configuration is stored in the database via `spatie/laravel-settings`.

The settings migration creates entries in the `settings` table under the `fathom` group. Publish and run:

```bash
php artisan vendor:publish --tag=fathom-settings-migrations
php artisan migrate
```

## Testing patterns

Tests use **Pest** with **Orchestra Testbench**. The base `TestCase` sets up:
- SQLite in-memory database
- `settings` table schema (id, group, name, locked, payload, timestamps)
- Default seed values matching the migration defaults

### Settings test pattern

```php
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

it('can resolve FathomSettings from the container', function () {
    $settings = app(FathomSettings::class);
    expect($settings)->toBeInstanceOf(FathomSettings::class);
});

it('has correct default values', function () {
    $settings = app(FathomSettings::class);
    expect($settings->website_id)->toBeNull()
        ->and($settings->canonical)->toBeTrue()
        ->and($settings->auto)->toBeTrue()
        ->and($settings->spa)->toBeNull()
        ->and($settings->honor_dnt)->toBeNull();
});

it('can update and persist settings', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'ABCDEFGH';
    $settings->save();

    $fresh = app(FathomSettings::class);
    expect($fresh->website_id)->toBe('ABCDEFGH');
});
```

### Blade view test pattern

```php
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

it('renders the script tag when website_id is set', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = 'TESTSITE';
    $settings->save();

    $view = $this->blade('@include("fathom::script")');
    $view->assertSee('https://cdn.usefathom.com/script.js', false)
        ->assertSee('data-site="TESTSITE"', false);
});

it('does not render the script tag when website_id is empty', function () {
    $settings = app(FathomSettings::class);
    $settings->website_id = null;
    $settings->save();

    $view = $this->blade('@include("fathom::script")');
    $view->assertDontSee('cdn.usefathom.com', false);
});
```

### Running tests

```bash
# Run all tests
vendor/bin/pest

# Run with coverage
vendor/bin/pest --coverage

# Run static analysis
vendor/bin/phpstan analyse

# Format code
vendor/bin/pint
```

### TestCase setup reference

```php
namespace JeffersonGoncalves\Fathom\Tests;

use JeffersonGoncalves\Fathom\FathomServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelSettingsServiceProvider::class,
            FathomServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
```
