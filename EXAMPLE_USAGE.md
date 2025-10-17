# Example Usage

This document provides practical examples of using the Laravel Wizard Installer package.

## Basic Installation Flow

### Step 1: Welcome Screen

When you first visit `/install`, you'll see the welcome screen with system requirements:

**What it checks:**
- PHP version (8.2+)
- Required PHP extensions
- Directory permissions

**User action:** Click "Continue to Environment Setup"

---

### Step 2: Environment Setup

Configure your application settings:

**Fields to fill:**
- Application Name: `My Laravel App`
- Application URL: `http://localhost`
- Database Connection: `mysql`
- Database Host: `127.0.0.1`
- Database Port: `3306`
- Database Name: `my_database`
- Database Username: `root`
- Database Password: `password`

**What happens:**
- Creates or updates `.env` file
- Sets application configuration
- Stores database credentials

**User action:** Click "Continue to Database Setup"

---

### Step 3: Database Setup

Test and migrate your database:

**Actions:**
1. Click "Test Connection" to verify database credentials
2. Once successful, click "Run Migrations" to create tables
3. Wait for migrations to complete

**What happens:**
- Tests database connection
- Runs `php artisan migrate --force`
- Creates all application tables

**User action:** Click "Continue to Admin Setup"

---

### Step 4: Admin User Creation

Create your administrator account:

**Fields to fill:**
- Full Name: `Admin User`
- Email: `admin@example.com`
- Password: `SecurePass123!`
- Confirm Password: `SecurePass123!`

**Password requirements:**
- Minimum 8 characters
- At least one letter
- At least one number

**What happens:**
- Creates admin user in database
- Hashes password securely
- Sets email as verified
- Creates installation lock file

**User action:** Click "Complete Installation"

---

### Step 5: Installation Complete

Success! Your application is installed.

**What's shown:**
- Installation summary
- Security recommendations
- Next steps

**User action:** Click "Launch Your Application"

---

## Programmatic Usage

### Checking Installation Status

```php
use YourName\WizardInstaller\Helpers\FileHelper;

$fileHelper = new FileHelper();

if ($fileHelper->isInstalled()) {
    echo "Application is installed";
} else {
    echo "Application needs installation";
}
```

### Getting Installation Information

```php
use YourName\WizardInstaller\Helpers\FileHelper;

$fileHelper = new FileHelper();
$info = $fileHelper->getInstallationInfo();

// Returns:
// [
//     'installed_at' => '2025-10-17T10:30:00.000000Z',
//     'version' => '1.0.0',
//     'app_name' => 'My Laravel App'
// ]
```

### Manually Updating Environment

```php
use YourName\WizardInstaller\Helpers\EnvironmentHelper;

$envHelper = new EnvironmentHelper();

$envHelper->updateEnvironment([
    'APP_NAME' => 'My App',
    'APP_URL' => 'https://myapp.com',
    'DB_HOST' => 'localhost',
    'DB_DATABASE' => 'mydb',
]);
```

### Testing Database Connection

```php
use YourName\WizardInstaller\Helpers\DatabaseHelper;

$dbHelper = new DatabaseHelper();

try {
    $dbHelper->testConnection([
        'db_connection' => 'mysql',
        'db_host' => 'localhost',
        'db_port' => 3306,
        'db_database' => 'mydb',
        'db_username' => 'root',
        'db_password' => 'password',
    ]);
    
    echo "Connection successful!";
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
```

### Creating Users Programmatically

```php
use YourName\WizardInstaller\Helpers\DatabaseHelper;

$dbHelper = new DatabaseHelper();

$user = $dbHelper->createAdminUser([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'SecurePassword123',
]);

echo "User created with ID: " . $user->id;
```

---

## Customization Examples

### Custom Installation Steps

Add a custom step to the wizard:

**1. Update config/wizard-installer.php:**

```php
'steps' => [
    'welcome' => [...],
    'environment' => [...],
    'database' => [...],
    'email' => [ // New custom step
        'title' => 'Email Configuration',
        'description' => 'Configure email settings',
        'view' => 'wizard-installer::steps.email',
    ],
    'admin' => [...],
    'complete' => [...],
],
```

**2. Create the view:**

```bash
# Create: resources/views/vendor/wizard-installer/steps/email.blade.php
```

**3. Add controller method:**

```php
// In InstallationController.php
public function email(): View
{
    return view('wizard-installer::steps.email');
}

public function processEmail(Request $request): RedirectResponse
{
    // Process email configuration
    $this->environmentHelper->updateEnvironment([
        'MAIL_MAILER' => $request->mail_mailer,
        'MAIL_HOST' => $request->mail_host,
        'MAIL_PORT' => $request->mail_port,
        'MAIL_USERNAME' => $request->mail_username,
        'MAIL_PASSWORD' => $request->mail_password,
    ]);
    
    return redirect()->route('install.admin');
}
```

**4. Add routes:**

```php
// In routes/web.php
Route::get('/email', [InstallationController::class, 'email'])
    ->name('install.email');
Route::post('/email', [InstallationController::class, 'processEmail'])
    ->name('install.email.process');
```

### Custom Styling

**1. Update config/wizard-installer.php:**

```php
'styling' => [
    'primary_color' => '#6366f1', // Indigo
    'success_color' => '#059669', // Emerald
    'error_color' => '#dc2626',   // Red
    'warning_color' => '#d97706', // Orange
],
```

**2. Use in views:**

```blade
<button style="background-color: {{ config('wizard-installer.styling.primary_color') }}">
    Submit
</button>
```

### Custom Requirements

**Update config/wizard-installer.php:**

```php
'requirements' => [
    'php_version' => '8.3.0', // Require PHP 8.3
    'extensions' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'xml',
        'ctype',
        'json',
        'bcmath',
        'gd',        // Add GD
        'imagick',   // Add Imagick
        'redis',     // Add Redis
    ],
    'permissions' => [
        'storage' => 'storage/',
        'bootstrap/cache' => 'bootstrap/cache/',
        'public/uploads' => 'public/uploads/', // Add custom directory
    ],
],
```

---

## Integration Examples

### With Multi-tenancy (Tenancy for Laravel)

```php
// After installation, initialize tenant
use YourName\WizardInstaller\Helpers\FileHelper;

if ((new FileHelper())->isInstalled()) {
    // Setup tenant
    $tenant = Tenant::create([
        'name' => config('app.name'),
        'domain' => parse_url(config('app.url'), PHP_URL_HOST),
    ]);
}
```

### With Laravel Permissions (Spatie)

```php
// In DatabaseHelper::createAdminUser()
$user = new $userClass();
$user->name = $userData['name'];
$user->email = $userData['email'];
$user->password = Hash::make($userData['password']);
$user->email_verified_at = now();
$user->save();

// Assign admin role
$user->assignRole('admin');

return $user;
```

### With API Setup

```php
// Add API token generation to admin creation
use Laravel\Sanctum\HasApiTokens;

$user = $dbHelper->createAdminUser([...]);

// Generate API token
$token = $user->createToken('admin-token')->plainTextToken;

// Save token for user
session(['api_token' => $token]);
```

---

## Testing Scenarios

### Test Installation Flow

```php
// tests/Feature/InstallerTest.php
public function test_complete_installation_flow()
{
    // 1. Visit welcome page
    $this->get('/install')
        ->assertSee('Welcome');
    
    // 2. Submit environment form
    $this->post('/install/environment', [
        'app_name' => 'Test App',
        'app_url' => 'http://test.local',
        // ... other fields
    ])->assertRedirect('/install/database');
    
    // 3. Run migrations
    $this->post('/install/database/migrate')
        ->assertRedirect('/install/admin');
    
    // 4. Create admin user
    $this->post('/install/admin', [
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect('/install/complete');
    
    // 5. Verify installation
    $this->assertTrue(File::exists(config('wizard-installer.lock_file')));
}
```

### Test Middleware Protection

```php
public function test_installer_redirects_when_already_installed()
{
    // Create lock file
    File::put(config('wizard-installer.lock_file'), json_encode([
        'installed_at' => now()->toISOString(),
    ]));
    
    // Try to access installer
    $this->get('/install')
        ->assertRedirect('/');
}
```

---

## Common Use Cases

### 1. SaaS Application

Use the installer to set up each client's installation with:
- Custom branding
- Client-specific database
- Initial admin user
- Subscription setup

### 2. White-label Product

Customize the installer for each deployment:
- Custom logo and colors
- Pre-configured settings
- Client-specific requirements

### 3. Internal Tools

Simplify deployment for internal teams:
- Standardized setup process
- Environment-specific configurations
- Automated database seeding

---

**Need help? Check the [README.md](README.md) or [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md)**

