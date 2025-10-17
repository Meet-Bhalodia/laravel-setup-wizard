# Changelog

All notable changes to the Laravel Wizard Installer package will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-10-17

### Added
- Initial release of Laravel Wizard Installer
- Step-by-step installation wizard with 5 steps:
  - Welcome screen with system requirements check
  - Environment configuration (.env writer)
  - Database connection test and migration runner
  - Admin user creation
  - Installation completion screen
- Service Provider with Laravel auto-discovery
- Configurable route prefix (default: `/install`)
- Installation middleware to prevent access after setup
- Helper classes for environment, database, and file operations
- Artisan commands: `wizard:install` and `wizard:uninstall`
- Publish tags: `wizard-views` and `wizard-config`
- TailwindCSS-based responsive UI
- AJAX-powered database testing
- Comprehensive test suite (PHPUnit)
- PSR-12 compliant code
- PHP 8.2+ typed properties and return types
- Laravel 9+, 10, 11 compatibility
- Security features:
  - Installation lock file
  - CSRF protection
  - Middleware-based access control
- Comprehensive documentation

### Security
- Installation lock file prevents re-installation
- Middleware redirects authenticated requests after installation
- Secure password requirements for admin user
- CSRF token validation on all forms

## [Unreleased]

### Planned Features
- Livewire integration option
- Multi-language support
- Custom theme support
- Email configuration step
- Cache configuration step
- Queue configuration step

