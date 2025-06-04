<?php
// Unit tests for the Sandbox Laravel Package
// These tests cover basic assertions and edge cases for config and logic.

// Basic assertion test
// Ensures true is true
test('basic true assertion', function () {
    expect(true)->toBeTrue();
});

// Edge case: false is not true
test('edge: false is not true', function () {
    expect(false)->not->toBeTrue();
});

// Edge case: null is not true
test('edge: null is not true', function () {
    expect(null)->not->toBeTrue();
});

// Edge case: config array contains expected key
test('edge: array config returns expected keys', function () {
    $config = include __DIR__ . '/../../config/sandbox-laravel-package.php';
    expect($config)->toHaveKey('enabled');
});
