## Laravel Fathom

### Overview
Laravel package that integrates Fathom Analytics into Blade templates using `spatie/laravel-settings` for database-stored configuration. No config files -- all settings are managed via the `FathomSettings` class and stored in the `settings` database table.

### Key Concepts
- **Settings-driven**: All configuration lives in `FathomSettings` (group: `fathom`), not in config files
- **Blade view**: Include `fathom::script` in your layout to render the tracking script
- **Facade + Helper**: Access settings via `Fathom` facade or `fathom_settings()` helper
- **Auto-discovery**: Service provider is auto-discovered via `composer.json` extra.laravel.providers

### Settings (spatie/laravel-settings)

@verbatim
<code-snippet name="fathom-settings-class" lang="php">
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
</code-snippet>
@endverbatim

### Configuration

Settings migration path: `database/settings/2026_01_01_000000_create_fathom_settings.php`

Publish migrations:
@verbatim
<code-snippet name="publish-migrations" lang="bash">
php artisan vendor:publish --tag=fathom-settings-migrations
</code-snippet>
@endverbatim

### Usage

Include the tracking script in your Blade layout (typically before `</head>`):
@verbatim
<code-snippet name="blade-include" lang="blade">
@include('fathom::script')
</code-snippet>
@endverbatim

Access settings programmatically:
@verbatim
<code-snippet name="access-settings" lang="php">
// Via helper
$settings = fathom_settings();
$settings->website_id = 'ABCDEFGH';
$settings->save();

// Via Facade
use JeffersonGoncalves\Fathom\Facades\Fathom;
$siteId = app(Fathom::getFacadeAccessor())->website_id;

// Via container
$settings = app(\JeffersonGoncalves\Fathom\Settings\FathomSettings::class);
</code-snippet>
@endverbatim

### Conventions
- Namespace: `JeffersonGoncalves\Fathom`
- Service provider: `FathomServiceProvider` extends `PackageServiceProvider` (spatie/laravel-package-tools)
- Settings group name: `fathom`
- View namespace: `fathom` (e.g., `fathom::script`)
- The script tag only renders when `website_id` is not empty
- `data-canonical="false"` only renders when `canonical` is explicitly `false`
- `data-spa` only renders when `spa` is not null
- `data-honor-dnt="true"` only renders when `honor_dnt` is `true`
- `data-auto-track` always renders as `"true"` or `"false"`
- Tests use Pest with Orchestra Testbench and SQLite in-memory database
