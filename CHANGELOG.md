# Changelog

All notable changes to this project will be documented in this file.

## 3.0.1 - 2026-02-24

### What's Changed

- Add Laravel 13.x support in composer.json
- Add orchestra/testbench ^11.0 for Laravel 13 testing

## 3.0.0 - 2026-02-20

### Breaking Changes

- Removed `config/fathom.php` — the config file no longer exists and is not publishable
- Removed `->hasConfigFile()` from `FathomServiceProvider`

### What changed

All settings are now managed exclusively through the database via **spatie/laravel-settings**. There is no longer a config file to publish or customize.

The settings migration seeds initial values using `env('FATHOM_SITE')` for `website_id` and hardcoded defaults for the remaining settings (`canonical: true`, `auto: true`, `spa: null`, `honor_dnt: null`).

### Upgrading from 2.x

If you previously published `config/fathom.php`, you can safely delete it. All configuration must now be managed through the `settings` table via `FathomSettings`.

## 2.0.0 - 2026-02-20

### What's Changed

* build(deps): bump dependabot/fetch-metadata from 2.3.0 to 2.4.0 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/1
* build(deps): bump stefanzweifel/git-auto-commit-action from 5 to 6 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/2
* chore: Configure Renovate by @renovate[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/3
* Delete .github/FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/laravel-fathom/pull/5
* Delete renovate.json by @jeffersongoncalves in https://github.com/jeffersongoncalves/laravel-fathom/pull/6
* build(deps): bump aglipanci/laravel-pint-action from 2.5 to 2.6 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/7
* build(deps): bump actions/checkout from 4 to 5 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/8
* build(deps): bump stefanzweifel/git-auto-commit-action from 6 to 7 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/9
* build(deps): bump actions/checkout from 5 to 6 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/10
* build(deps): bump dependabot/fetch-metadata from 2.4.0 to 2.5.0 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-fathom/pull/11

### New Contributors

* @dependabot[bot] made their first contribution in https://github.com/jeffersongoncalves/laravel-fathom/pull/1
* @renovate[bot] made their first contribution in https://github.com/jeffersongoncalves/laravel-fathom/pull/3
* @jeffersongoncalves made their first contribution in https://github.com/jeffersongoncalves/laravel-fathom/pull/5

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-fathom/compare/1.0.0...2.0.0

## 1.0.0 - 2025-05-01

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-fathom/commits/1.0.0
