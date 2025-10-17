# Installation Guide

This guide walks you through installing and setting up the Laravel Wizard Installer package.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Local Testing](#local-testing)
- [Troubleshooting](#troubleshooting)

## Requirements

Before installing the Laravel Wizard Installer, ensure your system meets the following requirements:

### Server Requirements

- **PHP:** 8.2 or higher
- **Laravel:** 9.0, 10.0, 11.0, or higher
- **Composer:** Latest stable version

### Required PHP Extensions

- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath

### Directory Permissions

The following directories must be writable:

- `storage/` (all subdirectories)
- `bootstrap/cache/`

## Installation

### Step 1: Install via Composer

```bash
composer require yourname/laravel-wizard-installer
```

The package will be auto-discovered by Laravel thanks to the service provider configuration.

### Step 2: Publish Assets

Publish the configuration file:

```bash
php artisan vendor:publish --tag=wizard-config
```

This creates: `config/wizard-installer.php`

Publish the views (optional):

```bash
php artisan vendor:publish --tag=wizard-views
```

This creates: `resources/views/vendor/wizard-installer/`

### Step 3: Access the Installer

Navigate to the installation wizard in your browser:

```
http://your-domain.com/install
```

The default route prefix is `/install`, but you can customize this in the configuration file.

## Configuration

Edit `config/wizard-installer.php` to customize the installer:

### Route Prefix

```php
'route_prefix' => 'install', // Change to 'setup', 'wizard', etc.
```

### Lock File Location

```php
'lock_file' => storage_path('app/installed.lock'),
```

### Styling Options

```php
'styling' => [
    'primary_color' => '#3b82f6',
    'success_color' => '#10b981',
    'error_color' => '#ef4444',
    'warning_color' => '#f59e0b',
],
```

### Default Admin Credentials

```php
'default_admin' => [
    'name' => 'Administrator',
    'email' => 'admin@example.com',
],
```

## Local Testing

For local development and testing:

### Setup

1. **Create a test Laravel application:**
   ```bash
   laravel new my-test-app
   cd my-test-app
   ```

2. **Add local package to composer.json:**
   ```json
   {
       "repositories": [
           {
               "type": "path",
               "url": "../laravel-wizard-installer"
           }
       ]
   }
   ```

3. **Install the package:**
   ```bash
   composer require yourname/laravel-wizard-installer @dev
   ```

4. **Publish configuration:**
   ```bash
   php artisan vendor:publish --tag=wizard-config
   php artisan vendor:publish --tag=wizard-views
   ```

5. **Remove existing .env (to simulate fresh installation):**
   ```bash
   mv .env .env.backup
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```

7. **Access the installer:**
   ```
   http://localhost:8000/install
   ```

### Resetting Installation

To test the installer again:

```bash
# Remove the lock file
rm storage/app/installed.lock

# Reset database (if needed)
php artisan migrate:fresh

# Remove .env
mv .env .env.backup
```

## Troubleshooting

### "Class not found" errors

**Solution:** Run Composer autoload dump:
```bash
composer dump-autoload
```

### "View not found" errors

**Solution:** Publish views and clear cache:
```bash
php artisan vendor:publish --tag=wizard-views --force
php artisan view:clear
```

### "Configuration not found" errors

**Solution:** Publish config and clear cache:
```bash
php artisan vendor:publish --tag=wizard-config --force
php artisan config:clear
```

### Cannot access installer (redirects to home)

**Cause:** Installation is already complete.

**Solution:** Remove the lock file:
```bash
rm storage/app/installed.lock
```

### Permission denied errors

**Solution:** Set proper permissions:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Database connection fails

**Checklist:**
- Verify database credentials in the environment step
- Ensure database server is running
- Check if database exists
- Verify user has proper permissions

### Migrations fail

**Common causes:**
- Database user lacks CREATE TABLE permission
- Database charset/collation mismatch
- Previous migration artifacts exist

**Solution:**
```bash
# Drop all tables and retry
php artisan db:wipe
# Then run installer again
```

## Post-Installation

### Security Steps

1. **Remove the installer package (recommended):**
   ```bash
   composer remove yourname/laravel-wizard-installer
   ```

2. **Or keep it but ensure lock file exists:**
   ```bash
   # The lock file prevents access to installer
   # Located at: storage/app/installed.lock
   ```

3. **Set proper environment:**
   ```bash
   # In .env
   APP_ENV=production
   APP_DEBUG=false
   ```

### Next Steps

1. Configure additional services (email, cache, queue)
2. Set up scheduled tasks
3. Configure file storage
4. Set up SSL certificate
5. Deploy to production

## Uninstallation

To completely remove the installer:

```bash
# Remove lock file
php artisan wizard:uninstall

# Remove package
composer remove yourname/laravel-wizard-installer

# Remove published files (optional)
rm config/wizard-installer.php
rm -rf resources/views/vendor/wizard-installer
```

## Support

If you encounter issues:

1. Check this troubleshooting guide
2. Review the [README.md](README.md)
3. Check [CHANGELOG.md](CHANGELOG.md) for known issues
4. Open an issue on GitHub

---

**Happy Installing! 🚀**

