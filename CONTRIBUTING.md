# Contributing to Laravel Wizard Installer

Thank you for considering contributing to Laravel Wizard Installer! This document outlines the process for contributing to this project.

## Table of Contents

- [Code of Conduct](#code-of-conduct)
- [Getting Started](#getting-started)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Testing](#testing)
- [Pull Request Process](#pull-request-process)

## Code of Conduct

By participating in this project, you agree to:

- Be respectful and inclusive
- Accept constructive criticism gracefully
- Focus on what is best for the community
- Show empathy towards other community members

## Getting Started

### Ways to Contribute

- 🐛 **Bug Reports:** Found a bug? Open an issue
- ✨ **Feature Requests:** Have an idea? Suggest it
- 📝 **Documentation:** Improve or fix documentation
- 🔧 **Code:** Fix bugs or implement features
- 🧪 **Tests:** Add or improve test coverage

## Development Setup

### Prerequisites

- PHP 8.2+
- Composer
- Git
- A Laravel application for testing

### Setup Steps

1. **Fork the repository**
   ```bash
   # On GitHub, click "Fork"
   ```

2. **Clone your fork**
   ```bash
   git clone https://github.com/YOUR-USERNAME/laravel-setup-wizard.git
   cd laravel-setup-wizard
   ```

3. **Install dependencies**
   ```bash
   composer install
   ```

4. **Create a test Laravel app**
   ```bash
   cd ..
   laravel new test-app
   cd test-app
   ```

5. **Link the package**
   
   Edit `test-app/composer.json`:
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
   
   Then install:
   ```bash
   composer require meet-bhalodia/laravel-setup-wizard @dev
   ```

6. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

## Coding Standards

### PSR-12

This project follows [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards.

```php
<?php

namespace meet-bhalodia\WizardInstaller\Example;

use Illuminate\Support\Facades\File;
use meet-bhalodia\WizardInstaller\Helpers\FileHelper;

/**
 * Example Class
 * 
 * Brief description of the class purpose.
 */
class ExampleClass
{
    /**
     * Property description.
     */
    protected string $property;

    /**
     * Constructor description.
     */
    public function __construct(string $property)
    {
        $this->property = $property;
    }

    /**
     * Method description.
     * 
     * @param string $param Parameter description
     * @return bool Return value description
     */
    public function exampleMethod(string $param): bool
    {
        // Implementation
        return true;
    }
}
```

### PHP 8.2+ Features

Use modern PHP syntax:

```php
// ✅ Good - Use typed properties
protected string $name;
protected ?int $count = null;

// ✅ Good - Use return types
public function getName(): string
{
    return $this->name;
}

// ✅ Good - Use constructor property promotion
public function __construct(
    protected string $name,
    protected int $age,
) {
}

// ✅ Good - Use readonly properties (PHP 8.1+)
public function __construct(
    protected readonly string $id,
) {
}
```

### Laravel Conventions

Follow Laravel best practices:

```php
// ✅ Good - Use facades
use Illuminate\Support\Facades\File;
File::exists($path);

// ✅ Good - Use helper functions
config('wizard-installer.route_prefix');
storage_path('app/installed.lock');

// ✅ Good - Use route names
return redirect()->route('install.welcome');

// ✅ Good - Use validation
$request->validate([
    'email' => 'required|email',
]);
```

### Naming Conventions

| Type | Convention | Example |
|------|------------|---------|
| Classes | PascalCase | `InstallationController` |
| Methods | camelCase | `checkRequirements()` |
| Variables | camelCase | `$lockFile` |
| Constants | UPPER_SNAKE | `MAX_ATTEMPTS` |
| Config keys | snake_case | `route_prefix` |
| Routes | dot.notation | `install.welcome` |

## Testing

### Running Tests

```bash
# Run all tests
composer test

# Run with coverage
composer test-coverage

# Run specific test
./vendor/bin/phpunit tests/Unit/HelpersTest.php
```

### Writing Tests

#### Feature Tests

```php
namespace meet-bhalodia\WizardInstaller\Tests\Feature;

use meet-bhalodia\WizardInstaller\Tests\TestCase;

class NewFeatureTest extends TestCase
{
    /** @test */
    public function it_can_do_something()
    {
        $response = $this->get('/install/new-feature');
        
        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.new-feature');
    }
}
```

#### Unit Tests

```php
namespace meet-bhalodia\WizardInstaller\Tests\Unit;

use meet-bhalodia\WizardInstaller\Tests\TestCase;
use meet-bhalodia\WizardInstaller\Helpers\NewHelper;

class NewHelperTest extends TestCase
{
    /** @test */
    public function it_can_perform_action()
    {
        $helper = new NewHelper();
        
        $result = $helper->performAction();
        
        $this->assertTrue($result);
    }
}
```

### Test Coverage

Aim for:
- **Minimum:** 70% code coverage
- **Target:** 80%+ code coverage
- **Critical paths:** 100% coverage

## Pull Request Process

### Before Submitting

1. **Update your fork**
   ```bash
   git fetch upstream
   git rebase upstream/main
   ```

2. **Run tests**
   ```bash
   composer test
   ```

3. **Check code style**
   ```bash
   # If you have PHP CS Fixer installed
   php-cs-fixer fix
   ```

4. **Update documentation**
   - Update README.md if needed
   - Update CHANGELOG.md
   - Add examples if applicable

### Commit Messages

Use clear, descriptive commit messages:

```bash
# ✅ Good
git commit -m "Add email configuration step to wizard"
git commit -m "Fix database connection test on PostgreSQL"
git commit -m "Update README with new configuration options"

# ❌ Bad
git commit -m "Fix stuff"
git commit -m "Update"
git commit -m "Changes"
```

### Creating a Pull Request

1. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

2. **Create PR on GitHub**
   - Go to the original repository
   - Click "New Pull Request"
   - Select your fork and branch
   - Fill in the PR template

3. **PR Title Format**
   ```
   [Type] Brief description
   
   Types:
   - [Feature] New functionality
   - [Fix] Bug fix
   - [Docs] Documentation update
   - [Test] Test improvements
   - [Refactor] Code refactoring
   ```

4. **PR Description Template**
   ```markdown
   ## Description
   Brief description of changes
   
   ## Type of Change
   - [ ] Bug fix
   - [ ] New feature
   - [ ] Documentation update
   - [ ] Breaking change
   
   ## Testing
   - [ ] Tests added/updated
   - [ ] All tests passing
   
   ## Checklist
   - [ ] Code follows PSR-12
   - [ ] Documentation updated
   - [ ] CHANGELOG.md updated
   ```

### Review Process

1. **Automated checks** will run (tests, code style)
2. **Maintainers will review** your code
3. **Address feedback** if requested
4. **Merge** when approved

## Release Process

Only maintainers can create releases:

1. Update version in `composer.json`
2. Update `CHANGELOG.md`
3. Create git tag
4. Push to Packagist

## Questions?

- 📧 **Email:** your.email@example.com
- 💬 **Issues:** [GitHub Issues](https://github.com/meet-bhalodia/laravel-setup-wizard/issues)
- 📖 **Docs:** [README.md](README.md)

---

**Thank you for contributing! 🎉**

