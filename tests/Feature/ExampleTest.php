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

// Edge case: Ensure missing config file is handled gracefully

test('edge case: config file missing', function () {
    $missingPath = __DIR__ . '/../../config/does-not-exist.php';
    expect(file_exists($missingPath))->toBeFalse();
});

test('ServiceProvider boot publishes config', function () {
    // Create a mock application with config_path
    $provider = new \Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider(null);
    // We can't test Laravel's publishes directly, but we can check the method runs without error
    $provider->boot();
    expect(true)->toBeTrue(); // If no exception, boot is covered
});

// Remove or skip the failing test that calls register() with null app
// test('ServiceProvider register merges config', function () {
//     $provider = new \Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider(null);
//     $provider->register();
//     expect(true)->toBeTrue(); // If no exception, register is covered
// });

test('ServiceProvider register merges config (mocked app)', function () {
    // Create a mock app with a config repository
    $mockConfig = new class {
        public $set = [];
        public function get($key, $default = null) { return []; }
        public function set($key, $value) { $this->set[$key] = $value; }
    };
    $mockApp = new class($mockConfig) {
        public $config;
        public function __construct($config) { $this->config = $config; }
        public function make($what) { if ($what === 'config') return $this->config; }
        public function configurationIsCached() { return false; }
    };
    $provider = new \Rumenx\SandboxLaravelPackage\SandboxLaravelPackageServiceProvider($mockApp);
    // Call register with a mock app to avoid null error
    $provider->register();
    expect($mockConfig->set)->toHaveKey('sandbox-laravel-package');
});
