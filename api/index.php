<?php
// Enable PostgreSQL support for PG4WP
ini_set('extension', 'pgsql');
ini_set('extension', 'pdo_pgsql');

// Forward requests to the WordPress subfolder
$uri = $_SERVER['REQUEST_URI'];

// Handle static files if they somehow bypass rewrites
if (file_exists(__DIR__ . '/../wp' . $uri) && !is_dir(__DIR__ . '/../wp' . $uri)) {
    return false;
}

// Set up WordPress environment
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../wp/index.php';
