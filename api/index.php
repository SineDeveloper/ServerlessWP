<?php
// Silence the driver log warnings
ini_set('display_errors', 0);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Determine the actual file path in the /wp directory
// If you are at root, use: $file = __DIR__ . '/..' . $uri;
$file = __DIR__ . '/../wp' . $uri;

// If the URL is just a directory, look for index.php
if (is_dir($file)) {
    $file = rtrim($file, '/') . '/index.php';
}

if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    // Crucial: Set the script name so WordPress knows where it is
    $_SERVER['SCRIPT_NAME'] = $uri;
    $_SERVER['PHP_SELF'] = $uri;
    $_SERVER['SCRIPT_FILENAME'] = $file;
    
    require $file;
    exit;
}

// Fallback to the main index
require __DIR__ . '/../wp/index.php';
