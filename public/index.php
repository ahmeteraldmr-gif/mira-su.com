<?php

session_start();

// Basic PSR-4 Autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize Database Connection & Tables
\App\Database\Database::getConnection();

// Global Asset Helper for Subfolder Deployments
function asset(string $path): string {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $base = rtrim($scriptDir, '/');
    return $base . '/' . ltrim($path, '/');
}

// Robust URI Normalization for Subfolder & cPanel Deployments
$requestMethod = $_SERVER['REQUEST_METHOD'];
$rawUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$scriptName = urldecode($_SERVER['SCRIPT_NAME']);
$scriptDir = dirname($scriptName);

// Clean up scriptDir for windows backslashes
$scriptDir = str_replace('\\', '/', $scriptDir);

$requestUri = $rawUri;

// If request Uri starts with scriptDir, strip it
if ($scriptDir !== '/' && $scriptDir !== '.' && strpos($requestUri, $scriptDir) === 0) {
    $requestUri = substr($requestUri, strlen($scriptDir));
}

// Strip trailing /public if scriptDir didn't include it
if (strpos($requestUri, '/public') === 0) {
    $requestUri = substr($requestUri, 7);
}

// Normalize trailing slashes
if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
    $requestUri = rtrim($requestUri, '/');
}

if (empty($requestUri)) {
    $requestUri = '/';
}

$routes = require __DIR__ . '/../routes/web.php';
$routeKey = "$requestMethod $requestUri";

if (isset($routes[$routeKey])) {
    [$controllerClass, $method] = $routes[$routeKey];
    $controller = new $controllerClass();
    $controller->$method();
} else {
    http_response_code(404);
    $title = "404 Sayfa Bulunamadı - Miraç Su";
    $settings = \App\Models\Setting::getAll();
    require __DIR__ . '/../resources/views/layouts/app.php';
    echo '<div class="container py-5 text-center my-5"><h1 class="display-3 font-weight-bold text-primary mb-3"><i class="fa-solid fa-water-ladder text-info"></i> 404</h1><p class="lead">Aradığınız sayfa bulunamadı veya kaldırılmış olabilir.</p><a href="/" class="btn btn-primary mt-3"><i class="fa-solid fa-house"></i> Ana Sayfaya Dön</a></div>';
}
