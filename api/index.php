<?php
// Silencing errors for the Postgres driver
ini_set('display_errors', 0);

$uri = $_SERVER['REQUEST_URI'];

// Check if we are requesting a file that exists in the /wp directory
$path = __DIR__ . '/../wp' . parse_url($uri, PHP_URL_PATH);

if (file_exists($path) && !is_dir($path)) {
    // Serve static files (if PHP) or let Vercel handle assets
    if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
        require $path;
        exit;
    }
}

// Default to the main WordPress entry point
// This ensures /wp-admin/ requests are handled by /wp/wp-admin/
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../wp/index.php';
