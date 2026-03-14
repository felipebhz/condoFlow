# Laravel 12 & PHP 8.2+ Rules

## Stack
- Laravel 12.x (`composer require laravel/framework:^12.0`)
- PHP ≥8.2 (`"php": "^8.2"` in composer.json)
- Composer latest

## Code
- PHP 8.2+ features: readonly, nullsafe, enums, match
- Laravel 12 structure, native types, modern facades
- Drop legacy helpers (`array_*`, `str_*`) → `Arr` & `Str`
- `declare(strict_types=1)` in every file
- Format with Laravel Pint (Laravel 12 preset)

## Packages
- Require only PHP 8.2+ compatible libs
- `composer update` weekly
- Audit deps weekly

## CI
- Enforce PHP 8.2+ & Laravel 12
- Fail on deprecations or removed features

## Docs
- Keep this file as `RULES.md`
- Reference Laravel 12 & PHP 8.2 guides

## Tests
- PHPUnit (Laravel 12 compatible)
- Run on every push/PR
- Target ≥80 % coverage
