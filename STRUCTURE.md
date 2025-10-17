# Package Structure

Complete directory structure and file organization of the Laravel Wizard Installer package.

```
laravel-wizard-installer/
│
├── config/
│   └── wizard-installer.php          # Main configuration file
│       ├── Route prefix settings
│       ├── Installation steps definition
│       ├── System requirements
│       ├── Lock file configuration
│       ├── Default admin settings
│       ├── Styling options
│       └── Storage path settings
│
├── src/
│   ├── Console/
│   │   └── Commands/
│   │       ├── InstallCommand.php     # Install wizard package
│   │       └── UninstallCommand.php   # Uninstall wizard package
│   │
│   ├── Helpers/
│   │   ├── DatabaseHelper.php         # Database operations
│   │   │   ├── testConnection()       # Test DB connection
│   │   │   ├── createAdminUser()      # Create admin user
│   │   │   ├── usersTableExists()     # Check if users table exists
│   │   │   └── getConnectionStatus()  # Get connection status
│   │   │
│   │   ├── EnvironmentHelper.php      # Environment management
│   │   │   ├── updateEnvironment()    # Update .env file
│   │   │   ├── createEnvFile()        # Create new .env
│   │   │   ├── createDefaultEnvFile() # Create default .env
│   │   │   ├── updateEnvValue()       # Update single value
│   │   │   └── generateAppKey()       # Generate APP_KEY
│   │   │
│   │   └── FileHelper.php             # File system operations
│   │       ├── createInstallationLock()    # Create lock file
│   │       ├── removeInstallationLock()    # Remove lock file
│   │       ├── isInstalled()               # Check installation status
│   │       ├── getInstallationInfo()       # Get install info
│   │       ├── ensureStorageDirectories()  # Create storage dirs
│   │       └── setStoragePermissions()     # Set permissions
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── InstallationController.php  # Main installer controller
│   │   │       ├── welcome()              # Welcome step
│   │   │       ├── environment()          # Environment setup
│   │   │       ├── processEnvironment()   # Process environment
│   │   │       ├── database()             # Database setup
│   │   │       ├── testDatabase()         # Test DB connection
│   │   │       ├── runMigrations()        # Run migrations
│   │   │       ├── admin()                # Admin user creation
│   │   │       ├── processAdmin()         # Process admin creation
│   │   │       ├── complete()             # Installation complete
│   │   │       └── checkRequirements()    # Check system requirements
│   │   │
│   │   └── Middleware/
│   │       └── InstallationMiddleware.php # Installation protection
│   │           └── handle()               # Check if installed
│   │
│   ├── Providers/
│   │   └── WizardServiceProvider.php      # Service provider
│   │       ├── register()                 # Register services
│   │       ├── boot()                     # Bootstrap services
│   │       └── registerRoutes()           # Register routes
│   │
│   └── routes/
│       └── web.php                        # Installation routes
│           ├── GET  /                     # Welcome step
│           ├── GET  /environment          # Environment form
│           ├── POST /environment          # Process environment
│           ├── GET  /database             # Database form
│           ├── POST /database/test        # Test connection
│           ├── POST /database/migrate     # Run migrations
│           ├── GET  /admin                # Admin form
│           ├── POST /admin                # Process admin
│           └── GET  /complete             # Complete step
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              # Main layout template
│       │       ├── Header section
│       │       ├── Progress bar
│       │       ├── Main content area
│       │       ├── Footer section
│       │       └── JavaScript section
│       │
│       └── steps/
│           ├── welcome.blade.php          # Welcome step view
│           │   ├── System requirements
│           │   ├── PHP version check
│           │   ├── Extensions check
│           │   └── Permissions check
│           │
│           ├── environment.blade.php      # Environment step view
│           │   ├── App settings form
│           │   ├── Database settings form
│           │   └── Form validation
│           │
│           ├── database.blade.php         # Database step view
│           │   ├── Connection test
│           │   ├── Migration runner
│           │   └── AJAX handlers
│           │
│           ├── admin.blade.php            # Admin step view
│           │   ├── User creation form
│           │   ├── Password requirements
│           │   └── Security notice
│           │
│           └── complete.blade.php         # Complete step view
│               ├── Success message
│               ├── Installation summary
│               ├── Next steps
│               └── Security warnings
│
├── tests/
│   ├── TestCase.php                       # Base test class
│   │   ├── setUp()
│   │   ├── getPackageProviders()
│   │   └── getEnvironmentSetUp()
│   │
│   ├── Feature/
│   │   └── InstallationTest.php          # Feature tests
│   │       ├── test_can_access_welcome_page()
│   │       ├── test_can_access_environment_page()
│   │       ├── test_can_process_environment_setup()
│   │       ├── test_can_access_database_page()
│   │       ├── test_can_access_admin_page()
│   │       └── test_can_access_complete_page()
│   │
│   └── Unit/
│       └── HelpersTest.php                # Unit tests
│           ├── test_file_helper_can_check_installation_status()
│           ├── test_file_helper_can_create_installation_lock()
│           ├── test_file_helper_can_remove_installation_lock()
│           ├── test_environment_helper_can_update_environment()
│           └── test_database_helper_can_get_connection_status()
│
├── .gitignore                             # Git ignore file
├── CHANGELOG.md                           # Version changelog
├── composer.json                          # Composer configuration
├── EXAMPLE_USAGE.md                       # Usage examples
├── INSTALLATION_GUIDE.md                  # Installation guide
├── LICENSE                                # MIT License
├── phpunit.xml                            # PHPUnit configuration
├── README.md                              # Main documentation
└── STRUCTURE.md                           # This file
```

## File Purposes

### Core Files

| File | Purpose |
|------|---------|
| `composer.json` | Package metadata, dependencies, autoloading |
| `config/wizard-installer.php` | Configuration options |
| `src/Providers/WizardServiceProvider.php` | Service provider with auto-discovery |

### Controllers & Routes

| File | Purpose |
|------|---------|
| `src/Http/Controllers/InstallationController.php` | Main installer logic |
| `src/routes/web.php` | Installation routes |
| `src/Http/Middleware/InstallationMiddleware.php` | Installation protection |

### Helper Classes

| File | Purpose |
|------|---------|
| `src/Helpers/EnvironmentHelper.php` | Manages .env file |
| `src/Helpers/DatabaseHelper.php` | Database operations |
| `src/Helpers/FileHelper.php` | File system operations |

### Views

| File | Purpose |
|------|---------|
| `resources/views/layouts/app.blade.php` | Base layout with TailwindCSS |
| `resources/views/steps/welcome.blade.php` | Requirements check |
| `resources/views/steps/environment.blade.php` | Environment configuration |
| `resources/views/steps/database.blade.php` | Database setup |
| `resources/views/steps/admin.blade.php` | Admin user creation |
| `resources/views/steps/complete.blade.php` | Installation complete |

### Documentation

| File | Purpose |
|------|---------|
| `README.md` | Main package documentation |
| `INSTALLATION_GUIDE.md` | Detailed installation steps |
| `EXAMPLE_USAGE.md` | Code examples |
| `STRUCTURE.md` | This file - package structure |
| `CHANGELOG.md` | Version history |

### Testing

| File | Purpose |
|------|---------|
| `phpunit.xml` | PHPUnit configuration |
| `tests/TestCase.php` | Base test class |
| `tests/Feature/InstallationTest.php` | Feature tests |
| `tests/Unit/HelpersTest.php` | Unit tests |

## Data Flow

### Installation Process

```
1. User visits /install
   ↓
2. InstallationMiddleware checks lock file
   ↓
3. If not installed → Continue
   If installed → Redirect to /
   ↓
4. InstallationController::welcome()
   ↓
5. Check system requirements
   ↓
6. Display welcome view with results
   ↓
7. User clicks "Continue"
   ↓
8. Environment setup form
   ↓
9. User submits → processEnvironment()
   ↓
10. EnvironmentHelper::updateEnvironment()
    ↓
11. .env file updated
    ↓
12. Redirect to database setup
    ↓
13. User tests connection (AJAX)
    ↓
14. DatabaseHelper::testConnection()
    ↓
15. User runs migrations
    ↓
16. Artisan::call('migrate')
    ↓
17. Redirect to admin creation
    ↓
18. User creates admin account
    ↓
19. DatabaseHelper::createAdminUser()
    ↓
20. FileHelper::createInstallationLock()
    ↓
21. Redirect to complete
    ↓
22. Display success message
```

### Middleware Protection

```
Request to /install
   ↓
InstallationMiddleware
   ↓
Check: File::exists(lock_file)
   ↓
   ├─ Yes → Redirect to /
   └─ No  → Continue to route
```

## Dependencies

### Required Packages

```json
{
    "php": "^8.2",
    "illuminate/support": "^9.0|^10.0|^11.0",
    "illuminate/routing": "^9.0|^10.0|^11.0",
    "illuminate/view": "^9.0|^10.0|^11.0",
    "illuminate/http": "^9.0|^10.0|^11.0",
    "illuminate/database": "^9.0|^10.0|^11.0",
    "illuminate/console": "^9.0|^10.0|^11.0",
    "illuminate/filesystem": "^9.0|^10.0|^11.0"
}
```

### Dev Dependencies

```json
{
    "phpunit/phpunit": "^9.0|^10.0",
    "orchestra/testbench": "^7.0|^8.0|^9.0"
}
```

## Autoloading

### PSR-4 Autoloading

```json
{
    "autoload": {
        "psr-4": {
            "YourName\\WizardInstaller\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "YourName\\WizardInstaller\\Tests\\": "tests/"
        }
    }
}
```

## Laravel Auto-discovery

```json
{
    "extra": {
        "laravel": {
            "providers": [
                "YourName\\WizardInstaller\\Providers\\WizardServiceProvider"
            ]
        }
    }
}
```

---

**For usage examples, see [EXAMPLE_USAGE.md](EXAMPLE_USAGE.md)**  
**For installation help, see [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md)**

