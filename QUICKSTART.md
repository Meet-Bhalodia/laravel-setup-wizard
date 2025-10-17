# Quick Start Guide

Get up and running with Laravel Wizard Installer in 5 minutes!

## 🚀 Installation (2 minutes)

### Step 1: Install the Package

```bash
composer require yourname/laravel-wizard-installer
```

### Step 2: Publish Assets

```bash
# Publish configuration
php artisan vendor:publish --tag=wizard-config

# Publish views (optional - for customization)
php artisan vendor:publish --tag=wizard-views
```

## 🎯 Local Testing (3 minutes)

### Step 1: Setup Test Environment

```bash
# Create a fresh Laravel app
laravel new test-app
cd test-app
```

### Step 2: Add Local Package

Edit `composer.json`:

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

### Step 3: Install Package

```bash
composer require yourname/laravel-wizard-installer @dev
```

### Step 4: Prepare for Installation

```bash
# Backup or remove .env
mv .env .env.backup

# Start development server
php artisan serve
```

### Step 5: Run the Installer

Visit: `http://localhost:8000/install`

## 📝 Installation Steps

### 1. Welcome Screen
- ✅ Check PHP version
- ✅ Check required extensions
- ✅ Check directory permissions
- Click: **Continue to Environment Setup**

### 2. Environment Setup
Fill in:
- **App Name:** My Laravel App
- **App URL:** http://localhost
- **DB Connection:** mysql
- **DB Host:** 127.0.0.1
- **DB Port:** 3306
- **DB Name:** my_database
- **DB Username:** root
- **DB Password:** (your password)

Click: **Continue to Database Setup**

### 3. Database Setup
- Click: **Test Connection** ✅
- Click: **Run Migrations** ✅
- Click: **Continue to Admin Setup**

### 4. Admin User
Fill in:
- **Name:** Admin User
- **Email:** admin@example.com
- **Password:** SecurePass123!
- **Confirm Password:** SecurePass123!

Click: **Complete Installation**

### 5. Complete
🎉 **Installation Complete!**

Click: **Launch Your Application**

## ⚙️ Configuration

Edit `config/wizard-installer.php`:

```php
return [
    // Change route prefix from /install to /setup
    'route_prefix' => 'setup',
    
    // Customize colors
    'styling' => [
        'primary_color' => '#6366f1',
        'success_color' => '#059669',
    ],
    
    // Change lock file location
    'lock_file' => storage_path('installed'),
];
```

## 🔒 Post-Installation

### Remove the Installer (Recommended)

```bash
composer remove yourname/laravel-wizard-installer
```

### Or Keep It (Secure)

The installer is automatically locked after installation:
- Lock file: `storage/app/installed.lock`
- Middleware prevents access
- Safe to keep installed

## 🧪 Testing Installation Again

To test the installer multiple times:

```bash
# Remove lock file
rm storage/app/installed.lock

# Reset database
php artisan migrate:fresh

# Remove .env
mv .env .env.backup

# Run installer again
php artisan serve
# Visit: http://localhost:8000/install
```

## 🔧 Troubleshooting

### "Class not found"
```bash
composer dump-autoload
```

### "View not found"
```bash
php artisan vendor:publish --tag=wizard-views --force
php artisan view:clear
```

### "Cannot access installer"
```bash
# Remove lock file
rm storage/app/installed.lock
```

### "Permission denied"
```bash
chmod -R 775 storage bootstrap/cache
```

## 📚 Next Steps

- [Full Documentation](README.md)
- [Installation Guide](INSTALLATION_GUIDE.md)
- [Usage Examples](EXAMPLE_USAGE.md)
- [Package Structure](STRUCTURE.md)

---

**Happy Installing! 🚀**

