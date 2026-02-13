<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. If it's a static asset, stop and let Vercel handle it
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2)$/', $uri)) {
    return false;
}

// 2. Map the request to the /wp directory
$file = __DIR__ . '/../wp' . $uri;

// 3. Handle directory index (e.g., /wp-admin/ -> /wp-admin/index.php)
if (is_dir($file)) {
    $file = rtrim($file, '/') . '/index.php';
}

// 4. If the PHP file exists, execute it
if (file_exists($file)) {
    $_SERVER['SCRIPT_NAME'] = $uri;
    require $file;
    exit;
}

// 5. Fallback for permalinks
require __DIR__ . '/../wp/index.php';
