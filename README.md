# Sandbox Laravel Package

[![CI](https://github.com/rumenx/sandbox-laravel-package/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/rumenx/sandbox-laravel-package/actions/workflows/ci.yml)
[![PHPStan](https://github.com/rumenx/sandbox-laravel-package/actions/workflows/phpstan.yml/badge.svg?branch=master)](https://github.com/rumenx/sandbox-laravel-package/actions/workflows/phpstan.yml)
[![codecov](https://codecov.io/gh/rumenx/sandbox-laravel-package/branch/master/graph/badge.svg?token=YOUR_CODECOV_TOKEN)](https://codecov.io/gh/rumenx/sandbox-laravel-package)

A modern, well-tested, and fully-featured example Laravel package for demonstration, experimentation, and as a starting point for your own packages. This project follows best practices for Laravel package development, including advanced testing, static analysis, and CI integration.

---

## Features

- **Laravel ServiceProvider** for easy integration
- **Config publishing** for user customization
- **PSR-4 autoloading** (src/)
- **Pest** for expressive and modern testing
- **PHPStan** for static analysis
- **Composer scripts** for test, analyze, and coverage
- **GitHub Actions** for CI and static analysis
- **Codecov** for code coverage reporting
- Example advanced and edge-case tests

---

## Installation

```bash
composer require rumenx/sandbox-laravel-package
```

## Usage

Register the service provider in your Laravel application's `config/app.php` (for Laravel <5.5):

```php
'providers' => [
    // ...
    Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider::class,
],
```

Publish the config file:

```bash
php artisan vendor:publish --tag=config
```

---

## Testing & Quality

- **Run tests:**

  ```bash
  composer test
  ```

- **Static analysis:**

  ```bash
  composer analyze
  ```

- **Coverage report:**

  ```bash
  composer coverage
  ```

---

## Contributing

Contributions, issues, and feature requests are welcome! Please open an issue or submit a pull request.

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
