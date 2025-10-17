# Laravel Wizard Installer

A modern, browser-based installation wizard for Laravel applications. This package provides a beautiful, step-by-step installation process that guides users through setting up their Laravel application.

## Features

- 🎯 **Step-by-step Installation**: Guided wizard with progress indicators
- 🎨 **Modern UI**: Beautiful TailwindCSS-based interface
- 🔧 **Environment Setup**: Automatic .env file configuration
- 🗄️ **Database Management**: Connection testing and migration running
- 👤 **Admin User Creation**: Secure administrator account setup
- 🔒 **Security**: Installation lock file and middleware protection
- 📱 **Responsive Design**: Works on all devices
- ⚡ **AJAX-powered**: Smooth user experience with real-time feedback

## Requirements

- PHP 8.2 or higher
- Laravel 9.0, 10.0, 11.0, or higher
- Required PHP extensions: openssl, pdo, mbstring, tokenizer, xml, ctype, json, bcmath

## Installation

### From Packagist (Production)

1. **Install the package via Composer:**
   ```bash
   composer require meet-bhalodia/laravel-setup-wizard
   ```

2. **Publish the configuration and views:**
   ```bash
   # Publish configuration
   php artisan vendor:publish --tag=wizard-config
   
   # Publish views
   php artisan vendor:publish --tag=wizard-views
   ```

3. **Configure the package (optional):**
   ```bash
   # Edit config/wizard-installer.php to customize settings
   ```

### Local Development/Testing

To test the package locally before publishing:

1. **Clone or place the package in a local directory:**
   ```bash
   # Example structure:
   # /home/user/projects/
   #   ├── laravel-setup-wizard/  (this package)
   #   └── my-laravel-app/            (test application)
   ```

2. **In your Laravel test application, add the local repository to `composer.json`:**
   ```json
   {
       "repositories": [
           {
               "type": "path",
               "url": "../laravel-setup-wizard"
           }
       ]
   }
   ```

3. **Require the package with `@dev` flag:**
   ```bash
   composer require meet-bhalodia/laravel-setup-wizard @dev
   ```

4. **The package will be symlinked, allowing real-time development:**
   ```bash
   # Any changes in the package directory are immediately reflected
   ```

5. **Publish assets for testing:**
   ```bash
   php artisan vendor:publish --tag=wizard-config
   php artisan vendor:publish --tag=wizard-views
   ```

6. **Visit the installer:**
   ```
   http://your-app.test/install
   ```

## Usage

### Basic Usage

Once installed, the wizard will be available at `/install` (or your configured route prefix).

The installation process includes these steps:

1. **Welcome** - System requirements check
2. **Environment Setup** - Application and database configuration
3. **Database Setup** - Connection testing and migrations
4. **Admin User** - Administrator account creation
5. **Complete** - Installation finished

### Customization

#### Configuration

Edit `config/wizard-installer.php` to customize:

- Route prefix (default: `install`)
- Installation steps
- System requirements
- Default admin user settings

#### Views

The package publishes views to `resources/views/vendor/wizard-installer/`. You can customize these views to match your application's design.

#### Routes

The installer routes are automatically registered with the prefix you configure. Default routes:

- `GET /install` - Welcome step
- `GET /install/environment` - Environment setup
- `POST /install/environment` - Process environment
- `GET /install/database` - Database setup
- `POST /install/database/test` - Test database connection
- `POST /install/database/migrate` - Run migrations
- `GET /install/admin` - Admin user creation
- `POST /install/admin` - Process admin user
- `GET /install/complete` - Installation complete

### Artisan Commands

```bash
# Install the wizard installer
php artisan wizard:install

# Uninstall the wizard installer
php artisan wizard:uninstall
```

## Security

### Installation Lock

The package creates a lock file (`storage/app/installed.lock`) after successful installation. This prevents the installer from being accessed again.

### Middleware Protection

The `InstallationMiddleware` automatically redirects users away from the installer if installation is already complete.

### Post-Installation Security

**Important**: After installation, you should remove the installer package for security:

```bash
composer remove meet-bhalodia/laravel-setup-wizard
```

## Customization Examples

### Custom Installation Steps

```php
// config/wizard-installer.php
'steps' => [
    'welcome' => [
        'title' => 'Welcome',
        'description' => 'Welcome to the installation wizard',
        'view' => 'wizard-installer::steps.welcome',
    ],
    'custom-step' => [
        'title' => 'Custom Step',
        'description' => 'Your custom installation step',
        'view' => 'wizard-installer::steps.custom',
    ],
    // ... other steps
],
```

### Custom Requirements

```php
// config/wizard-installer.php
'requirements' => [
    'php_version' => '8.2.0',
    'extensions' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'xml',
        'ctype',
        'json',
        'bcmath',
        'gd', // Add custom extension
    ],
    'permissions' => [
        'storage' => 'storage/',
        'bootstrap/cache' => 'bootstrap/cache/',
        'public/uploads' => 'public/uploads/', // Add custom directory
    ],
],
```

## API Reference

### Helpers

#### EnvironmentHelper

```php
use meet-bhalodia\WizardInstaller\Helpers\EnvironmentHelper;

$helper = new EnvironmentHelper();

// Update environment variables
$helper->updateEnvironment([
    'APP_NAME' => 'My App',
    'DB_HOST' => 'localhost',
    // ... other variables
]);

// Generate application key
$helper->generateAppKey();
```

#### DatabaseHelper

```php
use meet-bhalodia\WizardInstaller\Helpers\DatabaseHelper;

$helper = new DatabaseHelper();

// Test database connection
$helper->testConnection([
    'db_connection' => 'mysql',
    'db_host' => 'localhost',
    'db_port' => 3306,
    'db_database' => 'myapp',
    'db_username' => 'root',
    'db_password' => 'password',
]);

// Create admin user
$user = $helper->createAdminUser([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => 'password',
]);
```

#### FileHelper

```php
use meet-bhalodia\WizardInstaller\Helpers\FileHelper;

$helper = new FileHelper();

// Check if installed
$isInstalled = $helper->isInstalled();

// Get installation info
$info = $helper->getInstallationInfo();

// Create installation lock
$helper->createInstallationLock();

// Remove installation lock
$helper->removeInstallationLock();
```

## Testing

```bash
# Run the test suite
composer test

# Run with coverage
composer test-coverage
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Changelog

### v1.0.0
- Initial release
- Step-by-step installation wizard
- Environment configuration
- Database setup and migrations
- Admin user creation
- Security features
- Responsive design
- AJAX-powered interface

## Support

If you encounter any issues or have questions, please open an issue on GitHub.

---

Made with ❤️ for Laravel
