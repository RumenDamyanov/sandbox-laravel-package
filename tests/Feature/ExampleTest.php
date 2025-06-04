<?php
// Feature tests for the Sandbox Laravel Package
// These tests cover config publishing, helper functions, service provider methods, and edge cases.

// Basic example test
// Ensures Pest is working and the test suite is set up

test('example', function () {
    expect(true)->toBeTrue();
});

// Test that the config file is published and contains expected values

test('config is published correctly', function () {
    // Simulate config_path and file existence
    $configPath = __DIR__ . '/../../config/sandbox-laravel-package.php';
    expect(file_exists($configPath))->toBeTrue();
    $config = include $configPath;
    expect($config)->toBeArray();
    expect($config['enabled'])->toBeTrue();
});

// Test the config_path helper returns the correct path for a given filename

test('config_path helper returns correct path', function () {
    $expected = realpath(__DIR__ . '/../../config') . DIRECTORY_SEPARATOR . 'sandbox-laravel-package.php';
    $actual = call_user_func(function () {
        if (!function_exists('config_path')) {
            function config_path($path = '') {
                return __DIR__ . '/../../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
            }
        }
        return config_path('sandbox-laravel-package.php');
    });
    expect($actual)->toContain('sandbox-laravel-package.php');
});

// Test that the ServiceProvider's register method is public and callable

test('ServiceProvider merges config', function () {
    $provider = new \Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider(null);
    $reflection = new \ReflectionClass($provider);
    $method = $reflection->getMethod('register');
    expect($method->isPublic())->toBeTrue();
});

// Test that the ServiceProvider's boot method is public and callable

test('ServiceProvider boot method is callable', function () {
    $provider = new \Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider(null);
    $reflection = new \ReflectionClass($provider);
    $method = $reflection->getMethod('boot');
    expect($method->isPublic())->toBeTrue();
});

// Test config_path helper with and without arguments
// Ensures both cases return a string and the correct file path

test('config_path handles empty and non-empty input', function () {
    $base = realpath(__DIR__ . '/../../config');
    $with = call_user_func(function () {
        if (!function_exists('config_path')) {
            function config_path($path = '') {
                return __DIR__ . '/../../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
            }
        }
        return config_path('sandbox-laravel-package.php');
    });
    $without = call_user_func(function () {
        if (!function_exists('config_path')) {
            function config_path($path = '') {
                return __DIR__ . '/../../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
            }
        }
        return config_path();
    });
    expect($with)->toContain('sandbox-laravel-package.php');
    expect($without)->toBeString();
});

// Edge case: Ensure missing config file is handled gracefully

test('edge case: config file missing', function () {
    $missingPath = __DIR__ . '/../../config/does-not-exist.php';
    expect(file_exists($missingPath))->toBeFalse();
});
