<?php
// Helper for config_path to support non-Laravel environments (e.g., during testing)
if (!function_exists('config_path')) {
    function config_path($path = '') {
        return __DIR__ . '/../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
